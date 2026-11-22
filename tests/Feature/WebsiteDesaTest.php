<?php

namespace Tests\Feature;

use App\Models\BudgetItem;
use App\Models\BudgetYear;
use App\Models\Gallery;
use App\Models\Official;
use App\Models\Post;
use App\Models\Potential;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WebsiteDesaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_public_pages_and_detail_routes_load_successfully(): void
    {
        $this->get('/')->assertStatus(200)->assertSee('Desa Sukamundur');
        $this->get('/profil')->assertStatus(200)->assertSee('Visi Desa');
        $this->get('/potensi')->assertStatus(200)->assertSee('Agrowisata Bukit Pinang');
        $this->get('/informasi')->assertStatus(200)->assertSee('Musyawarah Desa Penyusunan RKPDes');
        $this->get('/galeri')->assertStatus(200);
        $this->get('/transparansi')->assertStatus(200)->assertSee('APBDes Tahun Anggaran 2026');
        $this->get('/transparansi?tahun=2025')->assertStatus(200)->assertSee('APBDes Tahun Anggaran 2025');

        $post = Post::firstOrFail();
        $this->get('/informasi/' . $post->slug)->assertStatus(200)->assertSee($post->title);

        $potential = Potential::firstOrFail();
        $this->get('/potensi/' . $potential->slug)->assertStatus(200)->assertSee($potential->title);
    }

    public function test_storage_fallback_route_serves_existing_file_and_blocks_traversal(): void
    {
        $this->get('/storage/profile/hero-kalisari.jpg')->assertStatus(200);
        $this->get('/storage/../../.env')->assertStatus(404);
        $this->get('/storage/tidak-ada-file.jpg')->assertStatus(404);
    }

    public function test_admin_auth_and_login_flow(): void
    {
        $this->get('/admin')->assertRedirect('/login');
        $this->get('/login')->assertStatus(200);

        $this->post('/login', [
            'email' => 'admin@desasukamundur.id',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('email');

        $this->post('/login', [
            'email' => 'admin@desasukamundur.id',
            'password' => 'password',
        ])->assertRedirect('/admin');

        $this->assertAuthenticated();

        $this->post('/logout')->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_admin_crud_create_update_delete_flows(): void
    {
        Storage::fake('public');
        $user = User::where('email', 'admin@desasukamundur.id')->firstOrFail();
        $this->actingAs($user);

        // 1. Access all admin GET pages
        foreach (['/admin', '/admin/profil', '/admin/perangkat', '/admin/potensi', '/admin/informasi', '/admin/galeri', '/admin/keuangan', '/admin/akun'] as $route) {
            $this->get($route)->assertStatus(200);
        }

        // 2. Update Profile
        $this->put('/admin/profil', [
            'name' => 'Desa Sukamundur Baru',
            'tagline' => 'Tagline Baru',
            'district' => 'Kecamatan Sukaharjo',
            'regency' => 'Kabupaten Nusantara',
            'province' => 'Jawa Contoh',
            'head_name' => 'H. Ahmad Contoh, S.Sos.',
            'head_title' => 'Kepala Desa',
            'address' => 'Jl. Raya No. 1',
            'population_total' => 5000,
            'families_total' => 1500,
            'male_total' => 2550,
            'female_total' => 2450,
            'area_km2' => 6.5,
            'dusun_count' => 4,
            'rw_count' => 12,
            'rt_count' => 38,
        ])->assertRedirect('/admin/profil');
        $this->assertDatabaseHas('village_profiles', ['name' => 'Desa Sukamundur Baru']);

        // 3. Official CRUD
        $this->post('/admin/perangkat', [
            'name' => 'Perangkat Test',
            'position' => 'Kasi Test',
            'order' => 10,
            'is_active' => 1,
        ])->assertRedirect('/admin/perangkat');
        $official = Official::where('name', 'Perangkat Test')->firstOrFail();
        $this->put('/admin/perangkat/' . $official->id, [
            'name' => 'Perangkat Test Updated',
            'position' => 'Kasi Test',
            'order' => 10,
        ])->assertRedirect('/admin/perangkat');
        $this->delete('/admin/perangkat/' . $official->id)->assertRedirect('/admin/perangkat');

        // 4. Potential CRUD
        $this->post('/admin/potensi', [
            'title' => 'Potensi Test',
            'category' => 'Wisata',
            'summary' => 'Ringkasan test',
            'description' => 'Deskripsi lengkap test',
        ])->assertRedirect('/admin/potensi');
        $potential = Potential::where('title', 'Potensi Test')->firstOrFail();
        $this->delete('/admin/potensi/' . $potential->id)->assertRedirect('/admin/potensi');

        // 5. Post CRUD
        $this->post('/admin/informasi', [
            'title' => 'Berita Test',
            'type' => 'Berita',
            'excerpt' => 'Ringkasan berita',
            'content' => 'Isi lengkap berita',
            'is_published' => 1,
        ])->assertRedirect('/admin/informasi');
        $post = Post::where('title', 'Berita Test')->firstOrFail();
        $this->delete('/admin/informasi/' . $post->id)->assertRedirect('/admin/informasi');

        // 6. Gallery CRUD with file upload
        $this->post('/admin/galeri', [
            'title' => 'Foto Test',
            'category' => 'Kegiatan',
            'image' => UploadedFile::fake()->image('foto.jpg'),
        ])->assertRedirect('/admin/galeri');
        $gallery = Gallery::where('title', 'Foto Test')->firstOrFail();
        $this->delete('/admin/galeri/' . $gallery->id)->assertRedirect('/admin/galeri');

        // 7. Budget Year & Item CRUD
        $this->post('/admin/keuangan/tahun', [
            'year' => 2028,
            'title' => 'APBDes 2028',
            'is_active' => 1,
        ])->assertRedirect();
        $budgetYear = BudgetYear::where('year', 2028)->firstOrFail();

        $this->post('/admin/keuangan/' . $budgetYear->id . '/item', [
            'type' => 'Belanja',
            'category' => 'Bidang Pembangunan',
            'description' => 'Jalan Desa',
            'budget_amount' => 100000000,
            'realized_amount' => 50000000,
        ])->assertRedirect('/admin/keuangan/' . $budgetYear->id);

        $item = BudgetItem::where('budget_year_id', $budgetYear->id)->firstOrFail();
        $this->put('/admin/keuangan/item/' . $item->id, [
            'type' => 'Belanja',
            'category' => 'Bidang Pembangunan',
            'description' => 'Jalan Desa Updated',
            'budget_amount' => 100000000,
            'realized_amount' => 90000000,
        ])->assertRedirect('/admin/keuangan/' . $budgetYear->id);

        $this->delete('/admin/keuangan/item/' . $item->id)->assertRedirect('/admin/keuangan/' . $budgetYear->id);
        $this->delete('/admin/keuangan/' . $budgetYear->id)->assertRedirect('/admin/keuangan');

        // 8. Account Update
        $this->put('/admin/akun', [
            'name' => 'Admin Updated',
            'email' => 'admin@desasukamundur.id',
        ])->assertRedirect('/admin/akun');
        $this->assertDatabaseHas('users', ['name' => 'Admin Updated']);
    }
}
