<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteDesaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_public_pages_load_successfully(): void
    {
        $this->get('/')->assertStatus(200)->assertSee('Desa Sukamundur');
        $this->get('/profil')->assertStatus(200)->assertSee('Visi Desa');
        $this->get('/potensi')->assertStatus(200)->assertSee('Agrowisata Bukit Pinang');
        $this->get('/informasi')->assertStatus(200)->assertSee('Musyawarah Desa Penyusunan RKPDes');
        $this->get('/galeri')->assertStatus(200);
        $this->get('/transparansi')->assertStatus(200)->assertSee('APBDes Tahun Anggaran 2026');
    }

    public function test_admin_requires_authentication(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_admin_can_login_and_access_crud_pages(): void
    {
        $user = User::where('email', 'admin@desasukamundur.id')->firstOrFail();

        $this->actingAs($user)->get('/admin')->assertStatus(200);
        $this->actingAs($user)->get('/admin/profil')->assertStatus(200);
        $this->actingAs($user)->get('/admin/perangkat')->assertStatus(200);
        $this->actingAs($user)->get('/admin/potensi')->assertStatus(200);
        $this->actingAs($user)->get('/admin/informasi')->assertStatus(200);
        $this->actingAs($user)->get('/admin/galeri')->assertStatus(200);
        $this->actingAs($user)->get('/admin/keuangan')->assertStatus(200);
        $this->actingAs($user)->get('/admin/akun')->assertStatus(200);
    }
}
