<?php

namespace Database\Seeders;

use App\Models\BudgetYear;
use App\Models\Gallery;
use App\Models\Official;
use App\Models\Post;
use App\Models\Potential;
use App\Models\User;
use App\Models\VillageProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@desasukamundur.id'],
            [
                'name' => 'Admin Desa Sukamundur',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Village Profile (Dummy Data Fiktif)
        VillageProfile::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Desa Sukamundur',
                'tagline' => 'Maju, Mandiri, Sejahtera & Transparan',
                'district' => 'Kecamatan Sukaharjo',
                'regency' => 'Kabupaten Nusantara',
                'province' => 'Jawa Contoh',
                'postal_code' => '99999',
                'head_name' => 'H. Ahmad Contoh, S.Sos.',
                'head_title' => 'Kepala Desa Sukamundur',
                'head_welcome' => 'Assalamu\'alaikum Warahmatullahi Wabarakatuh. Selamat datang di portal resmi Pemerintah Desa Sukamundur. Website ini hadir sebagai wujud komitmen kami dalam menghadirkan pelayanan informasi publik yang cepat, akurat, serta transparansi pengelolaan keuangan desa demi terwujudnya tata kelola pemerintahan yang bersih, akuntabel, dan partisipatif.',
                'vision' => 'Terwujudnya Desa Sukamundur yang Mandiri, Sejahtera, Berdaya Saing, dan Berakhlak Mulia Berbasis Potensi Lokal serta Tata Kelola Pemerintahan yang Transparan.',
                'mission' => "Meningkatkan kualitas pelayanan publik yang cepat, ramah, dan berbasis digital.\nMengoptimalkan potensi pertanian, wisata alam, dan UMKM lokal untuk kemandirian ekonomi warga.\nMewujudkan pengelolaan APBDes yang transparan, akuntabel, dan tepat sasaran.\nMeningkatkan kualitas infrastruktur dasar, pendidikan, dan kesehatan masyarakat desa.\nMemperkuat nilai gotong royong, kerukunan, dan pelestarian budaya lokal.",
                'history' => "Desa Sukamundur merupakan desa fiktif contoh untuk template portal desa. Sejarah singkat ini dapat Anda ubah langsung melalui Dashboard Admin pada menu Profil & Statistik Desa sesuai dengan catatan sejarah resmi desa Anda.",
                'address' => 'Jl. Raya Sukamundur No. 01, Kec. Sukaharjo, Kab. Nusantara 99999',
                'phone' => '(000) 0000-0000',
                'email' => 'pemdes@desasukamundur.id',
                'office_hours' => 'Senin - Jumat, 08:00 - 15:00 WIB',
                'population_total' => 4850,
                'families_total' => 1420,
                'male_total' => 2460,
                'female_total' => 2390,
                'area_km2' => 6.45,
                'dusun_count' => 4,
                'rw_count' => 12,
                'rt_count' => 38,
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.902975851184!2d107.61612631477276!3d-6.902481295012476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e64c5e8866e5%3A0x37be7ac9d575f7ed!2sGedung%20Sate!5e0!3m2!1sid!2sid!4v1610000000000!5m2!1sid!2sid',
                'hero_image' => 'profile/hero-kalisari.jpg',
            ]
        );

        // 3. Officials (Dummy Fiktif)
        $officials = [
            ['name' => 'H. Ahmad Contoh, S.Sos.', 'position' => 'Kepala Desa', 'nip' => '-', 'phone' => '0812-0000-0001', 'order' => 1, 'bio' => 'Memimpin penyelenggaraan pemerintahan, pembangunan, dan pemberdayaan masyarakat Desa Sukamundur.'],
            ['name' => 'Siti Contoh, S.AP.', 'position' => 'Sekretaris Desa', 'nip' => '-', 'phone' => '0812-0000-0002', 'order' => 2, 'bio' => 'Koordinator kesekretariatan, administrasi pemerintahan, dan penyusunan perencanaan program kerja desa.'],
            ['name' => 'Budi Contoh, S.E.', 'position' => 'Kaur Keuangan', 'nip' => '-', 'phone' => '0812-0000-0003', 'order' => 3, 'bio' => 'Mengelola penatausahaan keuangan desa, pelaporan realisasi APBDes, dan pertanggungjawaban anggaran.'],
            ['name' => 'Dewi Contoh, S.Kom.', 'position' => 'Kaur Perencanaan & Umum', 'nip' => '-', 'phone' => '0812-0000-0004', 'order' => 4, 'bio' => 'Menyusun RKPDes, RPJMDes, serta mengelola aset dan sistem informasi desa.'],
            ['name' => 'Agus Contoh', 'position' => 'Kasi Pemerintahan', 'nip' => '-', 'phone' => '0812-0000-0005', 'order' => 5, 'bio' => 'Menangani administrasi kependudukan, pertanahan, dan ketentraman ketertiban umum desa.'],
            ['name' => 'Rina Contoh, S.Pd.', 'position' => 'Kasi Kesejahteraan & Pelayanan', 'nip' => '-', 'phone' => '0812-0000-0006', 'order' => 6, 'bio' => 'Mengkoordinasikan program sosial, kesehatan posyandu, pendidikan, dan pelayanan warga.'],
        ];

        foreach ($officials as $item) {
            Official::updateOrCreate(['name' => $item['name']], $item);
        }

        // 4. Potentials (Dummy Fiktif)
        $potentials = [
            [
                'title' => 'Agrowisata Bukit Pinang & Air Terjun',
                'slug' => 'agrowisata-bukit-pinang-air-terjun',
                'category' => 'Wisata',
                'summary' => 'Destinasi wisata alam keluarga dengan panorama perbukitan, air terjun alami, dan area camping ground.',
                'description' => "Agrowisata Bukit Pinang terletak di Dusun II pada ketinggian 1.100 mdpl. Pengunjung dapat menikmati pemandangan hamparan sawah terasering, wisata air terjun alami, serta fasilitas gardu pandang dan bumi perkemahan.\n\nDikelola oleh BUMDes Sukamundur Sejahtera, destinasi ini menjadi salah satu penyumbang utama Pendapatan Asli Desa (PADes).",
                'location' => 'Dusun II Sukamundur',
                'contact' => '0813-0000-1122 (Pengelola BUMDes)',
                'image' => 'potentials/curug-arjuna.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'Sentra UMKM Anyaman Bambu & Olahan Lokal',
                'slug' => 'sentra-umkm-anyaman-bambu-olahan-lokal',
                'category' => 'UMKM',
                'summary' => 'Produk kerajinan tangan ramah lingkungan dan olahan pangan khas desa mulai dari besek, teh herbal, hingga jajanan tradisional.',
                'description' => "Sentra kerajinan dan UMKM di Dusun I menaungi para perajin serta pelaku usaha aktif. Dengan sentuhan desain kemasan modern, produk UMKM Desa Sukamundur dipasarkan ke berbagai daerah.\n\nPemerintah desa secara rutin memberikan pendampingan pemasaran digital dan fasilitasi pameran UMKM.",
                'location' => 'Dusun I RW 02',
                'contact' => '0857-0000-7766 (Paguyuban UMKM)',
                'image' => 'potentials/umkm-kalisari.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'Pertanian Organik & Hortikultura Sukamundur',
                'slug' => 'pertanian-organik-hortikultura-sukamundur',
                'category' => 'Pertanian',
                'summary' => 'Lahan pertanian yang menghasilkan sayuran dataran tinggi, padi organik, dan komoditas unggulan desa.',
                'description' => "Didukung oleh sistem irigasi teknis dari mata air pegunungan, kelompok tani Desa Sukamundur mengembangkan budidaya sayuran dan padi organik tanpa pestisida kimia.\n\nHasil panen dikemas secara higienis melalui koperasi tani dan menjadi produk unggulan ketahanan pangan desa.",
                'location' => 'Dusun III & IV',
                'contact' => '0821-0000-6677 (Gapoktan Harapan)',
                'image' => 'potentials/pertanian-kalisari.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'Sanggar Seni & Budaya Desa Sukamundur',
                'slug' => 'sanggar-seni-budaya-desa-sukamundur',
                'category' => 'Budaya',
                'summary' => 'Pelestarian kesenian tradisional, pencak silat, dan upacara adat panen raya tahunan.',
                'description' => "Sanggar Seni Desa menjadi wadah bagi generasi muda Desa Sukamundur untuk belajar kesenian tradisional, tari daerah, dan pencak silat.\n\nSetiap tahun setelah masa panen raya, masyarakat menggelar festival budaya desa.",
                'location' => 'Balai Budaya Desa Sukamundur',
                'contact' => '0812-0000-3344',
                'is_featured' => false,
            ],
        ];

        foreach ($potentials as $item) {
            Potential::updateOrCreate(['slug' => $item['slug']], $item);
        }

        // 5. Posts (Dummy Fiktif)
        $admin = User::where('email', 'admin@desasukamundur.id')->first();
        $posts = [
            [
                'title' => 'Musyawarah Desa Penyusunan RKPDes Tahun Anggaran 2026 Berjalan Lancar',
                'slug' => 'musyawarah-desa-penyusunan-rkpdes-2026',
                'type' => 'Berita',
                'excerpt' => 'Pemerintah Desa bersama BPD, tokoh masyarakat, dan perwakilan dusun menyepakati prioritas pembangunan infrastruktur dan pemberdayaan UMKM.',
                'content' => "Bertempat di Aula Balai Desa Sukamundur, Pemerintah Desa bersama Badan Permusyawaratan Desa (BPD) telah melaksanakan Musyawarah Desa (Musdes) dalam rangka penyusunan Rencana Kerja Pemerintah Desa (RKPDes) Tahun Anggaran 2026.\n\nDalam musyawarah tersebut, disepakati beberapa program prioritas antara lain lanjutan rabat beton jalan usaha tani di Dusun III, rehabilitasi saluran irigasi, serta pelatihan digital marketing bagi pelaku UMKM desa.",
                'image' => 'posts/musdes-kalisari.jpg',
                'published_at' => now()->subDays(2),
                'is_published' => true,
                'views' => 148,
                'user_id' => $admin?->id,
            ],
            [
                'title' => 'Kerja Bakti Massal & Pembangunan Jalan Usaha Tani Dusun III Rampung 100%',
                'slug' => 'kerja-bakti-jalan-usaha-tani-dusun-iii',
                'type' => 'Berita',
                'excerpt' => 'Akses pengangkutan hasil panen petani kini jauh lebih mudah setelah pengerjaan rabat beton dan kerja bakti lingkungan selesai tepat waktu.',
                'content' => "Pembangunan infrastruktur jalan usaha tani sepanjang 650 meter dengan lebar 2,5 meter di Dusun III serta kegiatan bersih lingkungan telah resmi selesai 100% dan dapat dimanfaatkan oleh seluruh warga.\n\nProyek ini didanai melalui Dana Desa dengan sistem padat karya tunai.",
                'image' => 'posts/kerja-bakti-kalisari.jpg',
                'published_at' => now()->subDays(7),
                'is_published' => true,
                'views' => 235,
                'user_id' => $admin?->id,
            ],
            [
                'title' => 'Pengumuman Jadwal Pelayanan Administrasi & Pembuatan KTP/KK Keliling',
                'slug' => 'pengumuman-pelayanan-ktp-kk-keliling',
                'type' => 'Pengumuman',
                'excerpt' => 'Layanan jemput bola perekaman e-KTP dan pembaruan KK akan dibuka di Balai Desa Sukamundur.',
                'content' => "Diberitahukan kepada seluruh warga Desa Sukamundur bahwa layanan administrasi kependudukan keliling akan dilaksanakan pada hari Rabu mendatang pukul 08.30 - 14.00 WIB di Pendopo Balai Desa.\n\nWarga diharapkan membawa dokumen persyaratan asli (Kartu Keluarga lama, Akta Kelahiran, atau Surat Pengantar RT/RW).",
                'published_at' => now()->subDays(4),
                'is_published' => true,
                'views' => 312,
                'user_id' => $admin?->id,
            ],
            [
                'title' => 'Agenda Kerja Bakti Massal & Penanaman 500 Bibit Pohon Produktif',
                'slug' => 'agenda-kerja-bakti-penanaman-500-bibit-pohon',
                'type' => 'Agenda',
                'excerpt' => 'Ayo ikuti gerakan bersih desa dan penghijauan daerah aliran sungai bersama Karang Taruna dan seluruh perangkat desa.',
                'content' => "Dalam rangka menjaga kelestarian lingkungan, Pemerintah Desa Sukamundur mengundang seluruh elemen masyarakat untuk berpartisipasi dalam kegiatan Kerja Bakti Massal dan Penanaman 500 Bibit Pohon.\n\nTitik kumpul: Lapangan Desa Sukamundur pukul 07.00 WIB.",
                'event_date' => now()->addDays(5)->toDateString(),
                'published_at' => now()->subDay(),
                'is_published' => true,
                'views' => 94,
                'user_id' => $admin?->id,
            ],
        ];

        foreach ($posts as $item) {
            Post::updateOrCreate(['slug' => $item['slug']], $item);
        }

        // 6. Budget Years & Items (Dummy APBDes 2025 & 2026)
        $year2026 = BudgetYear::updateOrCreate(
            ['year' => 2026],
            [
                'title' => 'APBDes Tahun Anggaran 2026',
                'description' => 'Anggaran Pendapatan dan Belanja Desa Sukamundur Tahun Anggaran 2026 (Data Contoh Simulasi).',
                'is_active' => true,
            ]
        );

        $items2026 = [
            ['type' => 'Pendapatan', 'category' => 'Pendapatan Asli Desa (PADes)', 'description' => 'Hasil Usaha BUMDes & Pengelolaan Agrowisata', 'budget_amount' => 145000000, 'realized_amount' => 132500000, 'notes' => 'Setoran bagi hasil BUMDes Sukamundur Sejahtera'],
            ['type' => 'Pendapatan', 'category' => 'Dana Desa (DD)', 'description' => 'Transfer Dana Desa dari APBN', 'budget_amount' => 1180000000, 'realized_amount' => 1180000000, 'notes' => 'Pencairan Tahap I, II, dan III selesai'],
            ['type' => 'Pendapatan', 'category' => 'Alokasi Dana Desa (ADD)', 'description' => 'Alokasi Dana Desa dari APBD Kabupaten', 'budget_amount' => 625000000, 'realized_amount' => 562500000, 'notes' => 'Pencairan hingga bulan November'],
            ['type' => 'Pendapatan', 'category' => 'Bagi Hasil Pajak & Retribusi', 'description' => 'Bagi Hasil Pajak Daerah dan Retribusi Daerah', 'budget_amount' => 85000000, 'realized_amount' => 76000000, 'notes' => 'Realisasi sesuai target triwulan'],
            ['type' => 'Belanja', 'category' => 'Bidang Penyelenggaraan Pemerintahan', 'description' => 'Penghasilan Tetap, Tunjangan Perangkat & Operasional Kantor Desa', 'budget_amount' => 585000000, 'realized_amount' => 520000000, 'notes' => 'Gaji perangkat, BPD, dan layanan administrasi'],
            ['type' => 'Belanja', 'category' => 'Bidang Pelaksanaan Pembangunan', 'description' => 'Rabat Beton Jalan Usaha Tani, Irigasi & Posyandu', 'budget_amount' => 820000000, 'realized_amount' => 775000000, 'notes' => 'Pembangunan fisik infrastruktur desa'],
            ['type' => 'Belanja', 'category' => 'Bidang Pembinaan Kemasyarakatan', 'description' => 'Pembinaan Karang Taruna, PKK, Linmas & Keagamaan', 'budget_amount' => 210000000, 'realized_amount' => 185000000, 'notes' => 'Kegiatan sosial kemasyarakatan dan keamanan'],
            ['type' => 'Belanja', 'category' => 'Bidang Pemberdayaan Masyarakat', 'description' => 'Pelatihan UMKM Bambu, Ketahanan Pangan & Pertanian Organik', 'budget_amount' => 290000000, 'realized_amount' => 248000000, 'notes' => 'Program peningkatan kapasitas ekonomi warga'],
            ['type' => 'Belanja', 'category' => 'Bidang Penanggulangan Bencana', 'description' => 'BLT Dana Desa & Tanggap Darurat Bencana Alam', 'budget_amount' => 130000000, 'realized_amount' => 118000000, 'notes' => 'Bantuan langsung tunai untuk 30 KPM'],
            ['type' => 'Pembiayaan', 'category' => 'Penerimaan Pembiayaan', 'description' => 'SILPA Tahun Anggaran Sebelumnya (2025)', 'budget_amount' => 65000000, 'realized_amount' => 65000000, 'notes' => 'Sisa lebih perhitungan anggaran 2025'],
            ['type' => 'Pembiayaan', 'category' => 'Pengeluaran Pembiayaan', 'description' => 'Penyertaan Modal BUMDes Sukamundur Sejahtera', 'budget_amount' => 65000000, 'realized_amount' => 65000000, 'notes' => 'Pengembangan unit usaha wisata & air bersih'],
        ];

        if ($year2026->items()->count() === 0) {
            foreach ($items2026 as $item) {
                $year2026->items()->create($item);
            }
        }

        $year2025 = BudgetYear::updateOrCreate(
            ['year' => 2025],
            [
                'title' => 'APBDes Tahun Anggaran 2025',
                'description' => 'Laporan Realisasi Pelaksanaan APBDes Sukamundur Tahun Anggaran 2025 (Data Contoh).',
                'is_active' => true,
            ]
        );

        $items2025 = [
            ['type' => 'Pendapatan', 'category' => 'Pendapatan Asli Desa (PADes)', 'description' => 'Hasil Pengelolaan Aset & BUMDes', 'budget_amount' => 120000000, 'realized_amount' => 124500000, 'notes' => 'Melampaui target 103.8%'],
            ['type' => 'Pendapatan', 'category' => 'Dana Desa (DD)', 'description' => 'Transfer Dana Desa dari APBN', 'budget_amount' => 1120000000, 'realized_amount' => 1120000000, 'notes' => 'Terealisasi 100%'],
            ['type' => 'Pendapatan', 'category' => 'Alokasi Dana Desa (ADD)', 'description' => 'Alokasi Dana Desa dari APBD Kabupaten', 'budget_amount' => 590000000, 'realized_amount' => 590000000, 'notes' => 'Terealisasi 100%'],
            ['type' => 'Belanja', 'category' => 'Bidang Penyelenggaraan Pemerintahan', 'description' => 'Operasional Pemerintahan & Layanan Publik', 'budget_amount' => 550000000, 'realized_amount' => 538000000, 'notes' => 'Efisiensi belanja ATK'],
            ['type' => 'Belanja', 'category' => 'Bidang Pelaksanaan Pembangunan', 'description' => 'Drainase Dusun I & II serta Lampu Jalan Tenaga Surya', 'budget_amount' => 760000000, 'realized_amount' => 745000000, 'notes' => 'Seluruh pekerjaan fisik selesai'],
            ['type' => 'Belanja', 'category' => 'Bidang Pembinaan Kemasyarakatan', 'description' => 'Kegiatan Kepemudaan, PKK & Posyandu', 'budget_amount' => 195000000, 'realized_amount' => 190000000, 'notes' => 'Berjalan sesuai jadwal'],
            ['type' => 'Belanja', 'category' => 'Bidang Pemberdayaan Masyarakat', 'description' => 'Bantuan Alat Pertanian & Pelatihan Pengolahan Kopi', 'budget_amount' => 255000000, 'realized_amount' => 242000000, 'notes' => 'Disalurkan ke 4 kelompok tani'],
            ['type' => 'Belanja', 'category' => 'Bidang Penanggulangan Bencana', 'description' => 'BLT Dana Desa & Mitigasi Longsor', 'budget_amount' => 120000000, 'realized_amount' => 119500000, 'notes' => 'Tersalurkan penuh'],
        ];

        if ($year2025->items()->count() === 0) {
            foreach ($items2025 as $item) {
                $year2025->items()->create($item);
            }
        }

        // 7. Galleries (Dummy Fiktif)
        $galleries = [
            ['title' => 'Panorama Pagi Desa Sukamundur', 'category' => 'Wisata', 'image' => 'galleries/panorama-kalisari.jpg', 'caption' => 'Pemandangan pagi hari kawasan perbukitan dan pertanian Desa Sukamundur.', 'taken_at' => now()->subDays(10)->toDateString()],
            ['title' => 'Pesona Alam Air Terjun Desa', 'category' => 'Wisata', 'image' => 'galleries/curug-arjuna.jpg', 'caption' => 'Destinasi wisata air terjun alami di kawasan Agrowisata Bukit Pinang.', 'taken_at' => now()->subDays(8)->toDateString()],
            ['title' => 'Musyawarah Desa RKPDes', 'category' => 'Kegiatan', 'image' => 'galleries/musdes-kalisari.jpg', 'caption' => 'Suasana musyawarah warga bersama perangkat desa di Balai Desa Sukamundur.', 'taken_at' => now()->subDays(5)->toDateString()],
            ['title' => 'Gotong Royong Kerja Bakti Warga', 'category' => 'Kegiatan', 'image' => 'galleries/kerja-bakti-kalisari.jpg', 'caption' => 'Kegiatan bersih desa dan penghijauan lingkungan bersama warga.', 'taken_at' => now()->subDays(2)->toDateString()],
        ];

        foreach ($galleries as $item) {
            Gallery::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
