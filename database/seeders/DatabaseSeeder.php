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
            ['email' => 'admin@kalisari-blado.desa.id'],
            [
                'name' => 'Admin Desa Kalisari',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Village Profile (Desa Kalisari, Kec. Blado, Kab. Batang, Jawa Tengah)
        VillageProfile::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Desa Kalisari',
                'tagline' => 'Asri, Agraris, Mandiri & Transparan',
                'district' => 'Kecamatan Blado',
                'regency' => 'Kabupaten Batang',
                'province' => 'Jawa Tengah',
                'postal_code' => '51255',
                'head_name' => 'Kepala Desa Kalisari [Perlu Disesuaikan]',
                'head_title' => 'Kepala Desa Kalisari',
                'head_welcome' => 'Assalamu\'alaikum Warahmatullahi Wabarakatuh. Selamat datang di portal resmi Pemerintah Desa Kalisari, Kecamatan Blado, Kabupaten Batang. Website ini hadir sebagai media informasi publik, promosi potensi pertanian, UMKM, serta wisata alam desa seperti Curug Arjuna, sekaligus wujud komitmen kami dalam menghadirkan transparansi pengelolaan APBDes kepada seluruh masyarakat.',
                'vision' => 'Terwujudnya Desa Kalisari yang Maju, Mandiri, Sejahtera, Berbasis Pertanian Berkelanjutan dan Wisata Alam dengan Tata Kelola Pemerintahan yang Transparan.',
                'mission' => "Meningkatkan kualitas pelayanan administrasi pemerintahan desa yang cepat, ramah, dan transparan.\nMengoptimalkan sektor pertanian hortikultura, perkebunan dataran tinggi, dan ketahanan pangan desa.\nMengembangkan potensi wisata alam Curug Arjuna serta UMKM olahan hasil bumi masyarakat.\nMewujudkan pengelolaan APBDes yang terbuka, akuntabel, dan tepat sasaran.\nMemperkuat semangat gotong royong, keamanan lingkungan, dan pelestarian alam pegunungan Blado.",
                'history' => "Desa Kalisari merupakan salah satu desa di wilayah administratif Kecamatan Blado, Kabupaten Batang, Provinsi Jawa Tengah (kode wilayah Kemendagri 33.25.03.2007). Terletak di kawasan dataran tinggi lereng utara Dataran Tinggi Dieng, Desa Kalisari dikenal memiliki bentang alam perbukitan yang asri, udara pegunungan yang sejuk, serta lahan pertanian yang subur.\n\nSejak dahulu, masyarakat Desa Kalisari menggantungkan kehidupan pada sektor agraris melalui budidaya tanaman pangan, sayuran hortikultura, dan komoditas perkebunan dataran tinggi. Seiring berkembangnya kawasan Kecamatan Blado sebagai sentra agrowisata Kabupaten Batang, Desa Kalisari terus mendorong pengembangan wisata alam Curug Arjuna dan pemberdayaan UMKM lokal demi meningkatkan kesejahteraan warga.",
                'address' => 'Balai Desa Kalisari, Kec. Blado, Kab. Batang, Jawa Tengah 51255',
                'phone' => '(0285) 000-000',
                'email' => 'pemdes@kalisari-blado.desa.id',
                'office_hours' => 'Senin - Jumat, 08:00 - 15:00 WIB',
                'population_total' => 2450,
                'families_total' => 720,
                'male_total' => 1245,
                'female_total' => 1205,
                'area_km2' => 4.85,
                'dusun_count' => 3,
                'rw_count' => 6,
                'rt_count' => 18,
                'map_embed_url' => 'https://maps.google.com/maps?q=Desa+Kalisari+Kecamatan+Blado+Kabupaten+Batang&t=&z=14&ie=UTF8&iwloc=&output=embed',
                'hero_image' => 'profile/hero-kalisari.jpg',
            ]
        );

        // 3. Officials (Placeholder Perangkat Desa Kalisari — Untuk Disesuaikan Nama Asli)
        $officials = [
            ['name' => 'Kepala Desa Kalisari [Perlu Disesuaikan]', 'position' => 'Kepala Desa', 'nip' => '-', 'phone' => '0812-0000-0001', 'order' => 1, 'bio' => 'Memimpin penyelenggaraan pemerintahan, pembangunan, pembinaan, dan pemberdayaan masyarakat Desa Kalisari.'],
            ['name' => 'Sekretaris Desa [Perlu Disesuaikan]', 'position' => 'Sekretaris Desa', 'nip' => '-', 'phone' => '0812-0000-0002', 'order' => 2, 'bio' => 'Koordinator kesekretariatan, administrasi pemerintahan desa, dan penyusunan perencanaan RKPDes/APBDes.'],
            ['name' => 'Kaur Keuangan [Perlu Disesuaikan]', 'position' => 'Kaur Keuangan', 'nip' => '-', 'phone' => '0812-0000-0003', 'order' => 3, 'bio' => 'Mengelola penatausahaan keuangan desa, pelaporan realisasi APBDes, dan pertanggungjawaban anggaran.'],
            ['name' => 'Kasi Pemerintahan [Perlu Disesuaikan]', 'position' => 'Kasi Pemerintahan', 'nip' => '-', 'phone' => '0812-0000-0004', 'order' => 4, 'bio' => 'Menangani pelayanan administrasi kependudukan, pertanahan, dan ketentraman ketertiban umum desa.'],
            ['name' => 'Kasi Kesejahteraan & Pelayanan [Perlu Disesuaikan]', 'position' => 'Kasi Kesejahteraan & Pelayanan', 'nip' => '-', 'phone' => '0812-0000-0005', 'order' => 5, 'bio' => 'Mengkoordinasikan program sosial, kesehatan posyandu, pendidikan, serta pelayanan masyarakat.'],
        ];

        foreach ($officials as $item) {
            Official::updateOrCreate(['name' => $item['name']], $item);
        }

        // 4. Potentials (Potensi Nyata Desa Kalisari, Blado, Batang)
        $potentials = [
            [
                'title' => 'Wisata Alam Curug Arjuna',
                'slug' => 'wisata-alam-curug-arjuna',
                'category' => 'Wisata',
                'summary' => 'Destinasi wisata air terjun pegunungan di Dukuh Kalisari dengan aliran air jernih dan suasana pedesaan yang asri.',
                'description' => "Curug Arjuna terletak di Dukuh Kalisari, Desa Kalisari, Kecamatan Blado, Kabupaten Batang. Dikelilingi oleh vegetasi hijau dan perbukitan yang sejuk, curug ini menawarkan pengalaman wisata petualangan alam serta ketenangan suasana pedesaan.\n\nPotensi ini terus dikembangkan bersama kelompok sadar wisata (Pokdarwis) dan pemuda desa sebagai daya tarik wisata alam unggulan di wilayah Blado.",
                'location' => 'Dukuh Kalisari, Desa Kalisari, Kec. Blado',
                'contact' => 'Pokdarwis Desa Kalisari [Perlu Disesuaikan]',
                'image' => 'potentials/curug-arjuna.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'Pertanian Hortikultura & Sayuran Dataran Tinggi',
                'slug' => 'pertanian-hortikultura-sayuran-dataran-tinggi',
                'category' => 'Pertanian',
                'summary' => 'Lahan pertanian subur di lereng pegunungan Blado yang menghasilkan sayuran segar, buah-buahan, padi, dan palawija.',
                'description' => "Berada pada iklim pegunungan yang sejuk, mayoritas warga Desa Kalisari bermata pencaharian sebagai petani. Lahan pertanian desa menghasilkan beragam komoditas hortikultura seperti sayuran segar, tanaman pangan, serta komoditas perkebunan dataran tinggi.\n\nPemerintah desa terus mendukung penguatan kelompok tani melalui perbaikan irigasi dan akses jalan usaha tani.",
                'location' => 'Wilayah Pertanian Desa Kalisari',
                'contact' => 'Gapoktan Desa Kalisari [Perlu Disesuaikan]',
                'image' => 'potentials/pertanian-kalisari.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'UMKM Olahan Hasil Bumi & Penyangga Wisata Blado',
                'slug' => 'umkm-olahan-hasil-bumi-kalisari',
                'category' => 'UMKM',
                'summary' => 'Produk olahan pangan lokal, kerajinan rumah tangga, kuliner pedesaan, dan jasa pendukung wisata Kecamatan Blado.',
                'description' => "Letak Desa Kalisari yang berada di kawasan Kecamatan Blado sebagai sentra agrowisata Kabupaten Batang membuka peluang besar bagi UMKM warga.\n\nPelaku usaha mikro desa memproduksi beragam olahan hasil bumi lokal, jajanan tradisional, serta kerajinan rumah tangga untuk dipasarkan kepada warga maupun wisatawan yang melintas.",
                'location' => 'Desa Kalisari, Kec. Blado',
                'contact' => 'Paguyuban UMKM Kalisari [Perlu Disesuaikan]',
                'image' => 'potentials/umkm-kalisari.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'Agrowisata Edukasi & Tradisi Gotong Royong Desa',
                'slug' => 'agrowisata-edukasi-tradisi-kalisari',
                'category' => 'Budaya',
                'summary' => 'Pelestarian tradisi budaya pedesaan Jawa, kegiatan bersih desa, serta potensi wisata edukasi bercocok tanam.',
                'description' => "Masyarakat Desa Kalisari menjunjung tinggi nilai-nilai gotong royong dan kearifan lokal pedesaan Jawa. Kegiatan bersih desa, kerja bakti lingkungan, dan aktivitas pertanian tradisional menjadi daya tarik tersendiri bagi pengunjung yang ingin merasakan kehidupan desa pegunungan yang harmonis.",
                'location' => 'Balai Desa & Lingkungan Desa Kalisari',
                'contact' => 'Pemdes Kalisari [Perlu Disesuaikan]',
                'is_featured' => false,
            ],
        ];

        foreach ($potentials as $item) {
            Potential::updateOrCreate(['slug' => $item['slug']], $item);
        }

        // 5. Posts (Berita, Pengumuman, Agenda Kontekstual Desa Kalisari)
        $admin = User::where('email', 'admin@kalisari-blado.desa.id')->first();
        $posts = [
            [
                'title' => 'Musyawarah Desa Penyusunan RKPDes Desa Kalisari Tahun Anggaran 2026',
                'slug' => 'musyawarah-desa-rkpdes-kalisari-2026',
                'type' => 'Berita',
                'excerpt' => 'Pemerintah Desa Kalisari bersama BPD dan perwakilan masyarakat menyepakati prioritas pembangunan infrastruktur tani dan penataan akses wisata.',
                'content' => "Bertempat di Balai Desa Kalisari, Pemerintah Desa Kalisari bersama Badan Permusyawaratan Desa (BPD), tokoh masyarakat, dan perwakilan RT/RW telah melaksanakan Musyawarah Desa (Musdes) penyusunan RKPDes Tahun Anggaran 2026.\n\nPrioritas yang disepakati meliputi peningkatan jalan usaha tani, pemeliharaan saluran irigasi pertanian, serta dukungan penataan akses menuju kawasan wisata Curug Arjuna.\n\nSeluruh rencana anggaran dan realisasi APBDes dipublikasikan secara terbuka melalui menu Transparansi APBDes.",
                'image' => 'posts/musdes-kalisari.jpg',
                'published_at' => now()->subDays(2),
                'is_published' => true,
                'views' => 142,
                'user_id' => $admin?->id,
            ],
            [
                'title' => 'Kerja Bakti Pembersihan Saluran Air & Akses Jalan Desa Kalisari',
                'slug' => 'kerja-bakti-saluran-air-kalisari',
                'type' => 'Berita',
                'excerpt' => 'Warga Desa Kalisari bergotong royong membersihkan drainase jalan desa dan jalur menuju area pertanian menjelang musim penghujan.',
                'content' => "Warga dari berbagai dukuh di Desa Kalisari melaksanakan kerja bakti massal membersihkan saluran drainase dan merapikan bahu jalan utama desa.\n\nKegiatan gotong royong ini dilakukan untuk mengantisipasi genangan air saat curah hujan tinggi di kawasan pegunungan Kecamatan Blado sekaligus menjaga kenyamanan akses mobilitas hasil pertanian warga.",
                'image' => 'posts/kerja-bakti-kalisari.jpg',
                'published_at' => now()->subDays(6),
                'is_published' => true,
                'views' => 195,
                'user_id' => $admin?->id,
            ],
            [
                'title' => 'Pengumuman Jadwal Pelayanan Administrasi & Surat Keterangan di Balai Desa Kalisari',
                'slug' => 'pengumuman-jadwal-pelayanan-balai-desa-kalisari',
                'type' => 'Pengumuman',
                'excerpt' => 'Informasi jam pelayanan surat menyurat, pengantar KTP/KK, dan layanan administrasi warga di Kantor Balai Desa Kalisari.',
                'content' => "Diberitahukan kepada seluruh warga Desa Kalisari bahwa pelayanan administrasi pemerintahan desa dibuka setiap hari Senin hingga Jumat pukul 08.00 - 15.00 WIB di Kantor Balai Desa Kalisari.\n\nWarga diharapkan membawa dokumen pendukung (KTP, Kartu Keluarga, serta surat pengantar RT/RW) agar proses pelayanan berjalan cepat dan tertib.",
                'published_at' => now()->subDays(4),
                'is_published' => true,
                'views' => 260,
                'user_id' => $admin?->id,
            ],
            [
                'title' => 'Agenda Posyandu Balita, Lansia & Koordinasi Pokdarwis Curug Arjuna',
                'slug' => 'agenda-posyandu-pokdarwis-kalisari',
                'type' => 'Agenda',
                'excerpt' => 'Jadwal kegiatan pelayanan kesehatan posyandu desa dan rapat koordinasi pengembangan wisata Curug Arjuna.',
                'content' => "Mengundang ibu-ibu kader posyandu, warga peserta posyandu balita dan lansia, serta anggota Pokdarwis Desa Kalisari untuk mengikuti rangkaian kegiatan rutin minggu ini di Balai Desa Kalisari.\n\nMari bersama-sama menjaga kesehatan keluarga dan memajukan potensi wisata serta UMKM Desa Kalisari.",
                'event_date' => now()->addDays(4)->toDateString(),
                'published_at' => now()->subDay(),
                'is_published' => true,
                'views' => 91,
                'user_id' => $admin?->id,
            ],
        ];

        foreach ($posts as $item) {
            Post::updateOrCreate(['slug' => $item['slug']], $item);
        }

        // 6. Budget Years & Items (Simulasi APBDes Desa Kalisari — Untuk Disesuaikan Angka Resmi)
        $year2026 = BudgetYear::updateOrCreate(
            ['year' => 2026],
            [
                'title' => 'APBDes Desa Kalisari Tahun Anggaran 2026 [Simulasi]',
                'description' => 'Ringkasan Anggaran Pendapatan dan Belanja Desa (APBDes) Desa Kalisari, Kec. Blado, Kab. Batang TA 2026. Angka simulasi awal sebelum input data resmi.',
                'is_active' => true,
            ]
        );

        $items2026 = [
            ['type' => 'Pendapatan', 'category' => 'Dana Desa (DD)', 'description' => 'Transfer Dana Desa dari APBN', 'budget_amount' => 980000000, 'realized_amount' => 980000000, 'notes' => 'Angka simulasi — sesuaikan dengan APBDes resmi'],
            ['type' => 'Pendapatan', 'category' => 'Alokasi Dana Desa (ADD)', 'description' => 'Alokasi Dana Desa dari APBD Kabupaten Batang', 'budget_amount' => 485000000, 'realized_amount' => 440000000, 'notes' => 'Pencairan bertahap'],
            ['type' => 'Pendapatan', 'category' => 'Pendapatan Asli Desa (PADes)', 'description' => 'Pengelolaan Aset Desa & Kontribusi Wisata Curug Arjuna', 'budget_amount' => 65000000, 'realized_amount' => 58000000, 'notes' => 'Angka simulasi awal'],
            ['type' => 'Pendapatan', 'category' => 'Bagi Hasil Pajak & Retribusi', 'description' => 'Bagi Hasil Pajak dan Retribusi Daerah', 'budget_amount' => 55000000, 'realized_amount' => 49500000, 'notes' => 'Realisasi berjalan'],
            ['type' => 'Belanja', 'category' => 'Bidang Penyelenggaraan Pemerintahan', 'description' => 'Penghasilan Tetap, Tunjangan Perangkat & Operasional Balai Desa', 'budget_amount' => 490000000, 'realized_amount' => 450000000, 'notes' => 'Gaji perangkat, BPD, dan layanan publik'],
            ['type' => 'Belanja', 'category' => 'Bidang Pelaksanaan Pembangunan', 'description' => 'Jalan Usaha Tani, Irigasi Pertanian & Akses Curug Arjuna', 'budget_amount' => 620000000, 'realized_amount' => 585000000, 'notes' => 'Pembangunan fisik infrastruktur desa'],
            ['type' => 'Belanja', 'category' => 'Bidang Pembinaan Kemasyarakatan', 'description' => 'Pembinaan Karang Taruna, PKK, Posyandu & Linmas', 'budget_amount' => 165000000, 'realized_amount' => 150000000, 'notes' => 'Kegiatan sosial kemasyarakatan'],
            ['type' => 'Belanja', 'category' => 'Bidang Pemberdayaan Masyarakat', 'description' => 'Pelatihan Hortikultura, UMKM & Pokdarwis Desa Kalisari', 'budget_amount' => 195000000, 'realized_amount' => 172000000, 'notes' => 'Peningkatan kapasitas petani & UMKM'],
            ['type' => 'Belanja', 'category' => 'Bidang Penanggulangan Bencana', 'description' => 'BLT Dana Desa & Mitigasi Bencana Kawasan Pegunungan', 'budget_amount' => 115000000, 'realized_amount' => 108000000, 'notes' => 'Bantuan langsung tunai & tanggap darurat'],
            ['type' => 'Pembiayaan', 'category' => 'Penerimaan Pembiayaan', 'description' => 'SILPA Tahun Anggaran Sebelumnya (2025)', 'budget_amount' => 42000000, 'realized_amount' => 42000000, 'notes' => 'Sisa lebih perhitungan anggaran'],
            ['type' => 'Pembiayaan', 'category' => 'Pengeluaran Pembiayaan', 'description' => 'Penyertaan Modal BUMDes Kalisari', 'budget_amount' => 42000000, 'realized_amount' => 42000000, 'notes' => 'Pengembangan unit usaha desa'],
        ];

        if ($year2026->items()->count() === 0) {
            foreach ($items2026 as $item) {
                $year2026->items()->create($item);
            }
        }

        $year2025 = BudgetYear::updateOrCreate(
            ['year' => 2025],
            [
                'title' => 'APBDes Desa Kalisari Tahun Anggaran 2025 [Simulasi]',
                'description' => 'Laporan realisasi pelaksanaan APBDes Desa Kalisari Tahun Anggaran 2025 (Data simulasi awal).',
                'is_active' => true,
            ]
        );

        $items2025 = [
            ['type' => 'Pendapatan', 'category' => 'Dana Desa (DD)', 'description' => 'Transfer Dana Desa dari APBN', 'budget_amount' => 940000000, 'realized_amount' => 940000000, 'notes' => 'Terealisasi 100%'],
            ['type' => 'Pendapatan', 'category' => 'Alokasi Dana Desa (ADD)', 'description' => 'Alokasi Dana Desa dari APBD Kabupaten Batang', 'budget_amount' => 460000000, 'realized_amount' => 460000000, 'notes' => 'Terealisasi 100%'],
            ['type' => 'Pendapatan', 'category' => 'Pendapatan Asli Desa (PADes)', 'description' => 'Hasil Pengelolaan Aset & Wisata Desa', 'budget_amount' => 55000000, 'realized_amount' => 58500000, 'notes' => 'Melampaui target'],
            ['type' => 'Belanja', 'category' => 'Bidang Penyelenggaraan Pemerintahan', 'description' => 'Operasional Pemerintahan & Pelayanan Balai Desa', 'budget_amount' => 470000000, 'realized_amount' => 462000000, 'notes' => 'Efisiensi operasional'],
            ['type' => 'Belanja', 'category' => 'Bidang Pelaksanaan Pembangunan', 'description' => 'Rabat Beton Jalan Desa & Drainase Lingkungan', 'budget_amount' => 580000000, 'realized_amount' => 568000000, 'notes' => 'Pekerjaan fisik selesai'],
            ['type' => 'Belanja', 'category' => 'Bidang Pembinaan Kemasyarakatan', 'description' => 'Posyandu, PKK & Kepemudaan', 'budget_amount' => 150000000, 'realized_amount' => 146000000, 'notes' => 'Berjalan sesuai jadwal'],
            ['type' => 'Belanja', 'category' => 'Bidang Pemberdayaan Masyarakat', 'description' => 'Bantuan Kelompok Tani & Pelatihan UMKM', 'budget_amount' => 165000000, 'realized_amount' => 159000000, 'notes' => 'Tersalurkan'],
            ['type' => 'Belanja', 'category' => 'Bidang Penanggulangan Bencana', 'description' => 'BLT Dana Desa & Mitigasi Longsor', 'budget_amount' => 90000000, 'realized_amount' => 88000000, 'notes' => 'Tersalurkan penuh'],
        ];

        if ($year2025->items()->count() === 0) {
            foreach ($items2025 as $item) {
                $year2025->items()->create($item);
            }
        }

        // 7. Galleries (Ilustrasi Demo)
        $galleries = [
            ['title' => 'Panorama Pegunungan Desa Kalisari', 'category' => 'Wisata', 'image' => 'galleries/panorama-kalisari.jpg', 'caption' => 'Pemandangan pagi hari kawasan pertanian dataran tinggi Desa Kalisari, Kecamatan Blado.', 'taken_at' => now()->subDays(10)->toDateString()],
            ['title' => 'Pesona Alam Curug Arjuna', 'category' => 'Wisata', 'image' => 'galleries/curug-arjuna.jpg', 'caption' => 'Air terjun Curug Arjuna di Dukuh Kalisari dengan aliran air pegunungan yang jernih.', 'taken_at' => now()->subDays(8)->toDateString()],
            ['title' => 'Musyawarah Desa Kalisari', 'category' => 'Kegiatan', 'image' => 'galleries/musdes-kalisari.jpg', 'caption' => 'Suasana musyawarah warga bersama perangkat desa di Balai Desa Kalisari.', 'taken_at' => now()->subDays(5)->toDateString()],
            ['title' => 'Gotong Royong Kerja Bakti Warga', 'category' => 'Kegiatan', 'image' => 'galleries/kerja-bakti-kalisari.jpg', 'caption' => 'Kegiatan bersih desa dan penghijauan lingkungan bersama warga Desa Kalisari.', 'taken_at' => now()->subDays(2)->toDateString()],
        ];

        foreach ($galleries as $item) {
            Gallery::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
