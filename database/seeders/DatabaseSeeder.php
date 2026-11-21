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
            ['email' => 'admin@desasukamaju.id'],
            [
                'name' => 'Admin Desa Sukamaju',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Village Profile
        VillageProfile::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Desa Sukamaju',
                'tagline' => 'Maju, Mandiri, Sejahtera & Transparan',
                'district' => 'Kecamatan Sukasari',
                'regency' => 'Kabupaten Bandung',
                'province' => 'Jawa Barat',
                'postal_code' => '40381',
                'head_name' => 'H. Ahmad Hidayat, S.Sos.',
                'head_title' => 'Kepala Desa Sukamaju',
                'head_welcome' => 'Assalamu\'alaikum Warahmatullahi Wabarakatuh. Selamat datang di portal resmi Pemerintah Desa Sukamaju. Website ini hadir sebagai wujud komitmen kami dalam menghadirkan pelayanan informasi publik yang cepat, akurat, serta transparansi pengelolaan keuangan desa demi terwujudnya tata kelola pemerintahan yang bersih, akuntabel, dan partisipatif.',
                'vision' => 'Terwujudnya Desa Sukamaju yang Mandiri, Sejahtera, Berdaya Saing, dan Berakhlak Mulia Berbasis Potensi Lokal serta Tata Kelola Pemerintahan yang Transparan.',
                'mission' => "Meningkatkan kualitas pelayanan publik yang cepat, ramah, dan berbasis digital.\nMengoptimalkan potensi pertanian, wisata alam, dan UMKM lokal untuk kemandirian ekonomi warga.\nMewujudkan pengelolaan APBDes yang transparan, akuntabel, dan tepat sasaran.\nMeningkatkan kualitas infrastruktur dasar, pendidikan, dan kesehatan masyarakat desa.\nMemperkuat nilai gotong royong, kerukunan, dan pelestarian budaya lokal.",
                'history' => "Desa Sukamaju berdiri sejak tahun 1952 sebagai hasil pemekaran wilayah di lereng perbukitan Kecamatan Sukasari. Nama 'Sukamaju' dipilih oleh para sesepuh desa sebagai doa dan harapan agar masyarakatnya senantiasa bersemangat untuk maju dan berkembang.\n\nDengan bentang alam yang subur, udara sejuk, dan sumber mata air alami, sebagian besar warga awalnya bermata pencaharian sebagai petani padi, palawija, dan kopi. Seiring perkembangan zaman, Desa Sukamaju terus bertransformasi mengembangkan sektor agrowisata, UMKM kerajinan bambu, serta digitalisasi layanan desa untuk menjawab kebutuhan masyarakat modern.",
                'address' => 'Jl. Raya Sukamaju No. 45, Kec. Sukasari, Kab. Bandung, Jawa Barat 40381',
                'phone' => '(022) 8765-4321',
                'email' => 'pemdes@desasukamaju.id',
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
            ]
        );

        // 3. Officials
        $officials = [
            ['name' => 'H. Ahmad Hidayat, S.Sos.', 'position' => 'Kepala Desa', 'nip' => '-', 'phone' => '0812-3456-7801', 'order' => 1, 'bio' => 'Memimpin penyelenggaraan pemerintahan, pembangunan, dan pemberdayaan masyarakat Desa Sukamaju periode 2022-2030.'],
            ['name' => 'Siti Nurhaliza, S.AP.', 'position' => 'Sekretaris Desa', 'nip' => '198804122015032001', 'phone' => '0812-3456-7802', 'order' => 2, 'bio' => 'Koordinator kesekretariatan, administrasi pemerintahan, dan penyusunan perencanaan program kerja desa.'],
            ['name' => 'Budi Santoso, S.E.', 'position' => 'Kaur Keuangan', 'nip' => '-', 'phone' => '0812-3456-7803', 'order' => 3, 'bio' => 'Mengelola penatausahaan keuangan desa, pelaporan realisasi APBDes, dan pertanggungjawaban anggaran.'],
            ['name' => 'Dewi Lestari, S.Kom.', 'position' => 'Kaur Perencanaan & Umum', 'nip' => '-', 'phone' => '0812-3456-7804', 'order' => 4, 'bio' => 'Menyusun RKPDes, RPJMDes, serta mengelola aset dan sistem informasi desa.'],
            ['name' => 'Agus Setiawan', 'position' => 'Kasi Pemerintahan', 'nip' => '-', 'phone' => '0812-3456-7805', 'order' => 5, 'bio' => 'Menangani administrasi kependudukan, pertanahan, dan ketentraman ketertiban umum desa.'],
            ['name' => 'Rina Kartika, S.Pd.', 'position' => 'Kasi Kesejahteraan & Pelayanan', 'nip' => '-', 'phone' => '0812-3456-7806', 'order' => 6, 'bio' => 'Mengkoordinasikan program sosial, kesehatan posyandu, pendidikan, dan pelayanan warga.'],
        ];

        foreach ($officials as $item) {
            Official::updateOrCreate(['name' => $item['name']], $item);
        }

        // 4. Potentials
        $potentials = [
            [
                'title' => 'Agrowisata Bukit Pinang & Kebun Kopi',
                'slug' => 'agrowisata-bukit-pinang-kebun-kopi',
                'category' => 'Wisata',
                'summary' => 'Destinasi wisata alam keluarga dengan panorama perbukitan, kebun kopi arabika, dan area camping ground.',
                'description' => "Agrowisata Bukit Pinang terletak di Dusun II pada ketinggian 1.100 mdpl. Pengunjung dapat menikmati pemandangan hamparan sawah terasering, wisata edukasi petik kopi arabika bersama kelompok tani setempat, serta fasilitas gardu pandang dan bumi perkemahan.\n\nDikelola oleh BUMDes Sukamaju Sejahtera, destinasi ini menjadi salah satu penyumbang utama Pendapatan Asli Desa (PADes) dan menyerap lebih dari 35 tenaga kerja lokal.",
                'location' => 'Dusun II Sukamaju',
                'contact' => '0813-2200-1122 (Pengelola BUMDes)',
                'is_featured' => true,
            ],
            [
                'title' => 'Sentra UMKM Anyaman Bambu & Kerajinan',
                'slug' => 'sentra-umkm-anyaman-bambu-kerajinan',
                'category' => 'UMKM',
                'summary' => 'Produk kerajinan tangan ramah lingkungan mulai dari besek, lampu hias, hingga perlengkapan kafe berbahan bambu.',
                'description' => "Sentra kerajinan anyaman bambu di Dusun I telah berkembang secara turun-temurun dan kini menaungi 42 perajin aktif. Dengan sentuhan desain modern, produk anyaman Desa Sukamaju telah dipasarkan ke berbagai kota besar di Indonesia.\n\nPemerintah desa secara rutin memberikan pendampingan pemasaran digital dan fasilitasi pameran UMKM.",
                'location' => 'Dusun I RW 02',
                'contact' => '0857-9988-7766 (Paguyuban Perajin)',
                'is_featured' => true,
            ],
            [
                'title' => 'Pertanian Organik & Beras Merah Sukamaju',
                'slug' => 'pertanian-organik-beras-merah-sukamaju',
                'category' => 'Pertanian',
                'summary' => 'Lahan pertanian seluas 180 hektar yang menghasilkan padi organik, beras merah unggulan, dan sayuran segar.',
                'description' => "Didukung oleh sistem irigasi teknis dari mata air pegunungan, kelompok tani Desa Sukamaju mengembangkan budidaya beras merah organik tanpa pestisida kimia.\n\nHasil panen dikemas secara higienis melalui koperasi tani dan menjadi produk unggulan ketahanan pangan desa.",
                'location' => 'Dusun III & IV',
                'contact' => '0821-4455-6677 (Gapoktan Harapan)',
                'is_featured' => true,
            ],
            [
                'title' => 'Sanggar Seni & Budaya Sunda Mekar',
                'slug' => 'sanggar-seni-budaya-sunda-mekar',
                'category' => 'Budaya',
                'summary' => 'Pelestarian kesenian tradisional angklung, pencak silat, dan upacara adat panen raya tahunan.',
                'description' => "Sanggar Seni Mekar menjadi wadah bagi generasi muda Desa Sukamaju untuk belajar kesenian tradisional angklung, calung, tari jaipong, dan pencak silat.\n\nSetiap tahun setelah masa panen raya, masyarakat menggelar festival budaya desa yang menarik wisatawan dari luar daerah.",
                'location' => 'Balai Budaya Desa Sukamaju',
                'contact' => '0812-8877-3344',
                'is_featured' => false,
            ],
        ];

        foreach ($potentials as $item) {
            Potential::updateOrCreate(['slug' => $item['slug']], $item);
        }

        // 5. Posts
        $admin = User::where('email', 'admin@desasukamaju.id')->first();
        $posts = [
            [
                'title' => 'Musyawarah Desa Penyusunan RKPDes Tahun Anggaran 2026 Berjalan Lancar',
                'slug' => 'musyawarah-desa-penyusunan-rkpdes-2026',
                'type' => 'Berita',
                'excerpt' => 'Pemerintah Desa bersama BPD, tokoh masyarakat, dan perwakilan dusun menyepakati prioritas pembangunan infrastruktur dan pemberdayaan UMKM.',
                'content' => "Bertempat di Aula Balai Desa Sukamaju, Pemerintah Desa Sukamaju bersama Badan Permusyawaratan Desa (BPD) telah melaksanakan Musyawarah Desa (Musdes) dalam rangka penyusunan Rencana Kerja Pemerintah Desa (RKPDes) Tahun Anggaran 2026.\n\nDalam musyawarah tersebut, disepakati beberapa program prioritas antara lain lanjutan rabat beton jalan usaha tani di Dusun III, rehabilitasi saluran irigasi, serta pelatihan digital marketing bagi pelaku UMKM desa.\n\nKepala Desa Sukamaju menegaskan bahwa seluruh usulan warga yang masuk akan diprioritaskan berdasarkan asas manfaat dan transparansi anggaran.",
                'published_at' => now()->subDays(2),
                'is_published' => true,
                'views' => 148,
                'user_id' => $admin?->id,
            ],
            [
                'title' => 'Pembangunan Rabat Beton Jalan Usaha Tani Dusun III Rampung 100%',
                'slug' => 'pembangunan-rabat-beton-jalan-usaha-tani-dusun-iii',
                'type' => 'Berita',
                'excerpt' => 'Akses pengangkutan hasil panen petani kini jauh lebih mudah setelah pengerjaan rabat beton sepanjang 650 meter selesai tepat waktu.',
                'content' => "Pembangunan infrastruktur jalan usaha tani sepanjang 650 meter dengan lebar 2,5 meter di Dusun III telah resmi selesai 100% dan dapat dimanfaatkan oleh seluruh warga.\n\nProyek ini didanai melalui Dana Desa dengan sistem padat karya tunai sehingga turut membuka lapangan kerja bagi warga setempat selama proses pengerjaan berlangsung.",
                'published_at' => now()->subDays(7),
                'is_published' => true,
                'views' => 235,
                'user_id' => $admin?->id,
            ],
            [
                'title' => 'Pengumuman Jadwal Pelayanan Administrasi & Pembuatan KTP/KK Keliling',
                'slug' => 'pengumuman-pelayanan-ktp-kk-keliling',
                'type' => 'Pengumuman',
                'excerpt' => 'Disdukcapil bekerja sama dengan Pemerintah Desa Sukamaju akan membuka layanan jemput bola perekaman e-KTP dan pembaruan KK di Balai Desa.',
                'content' => "Diberitahukan kepada seluruh warga Desa Sukamaju bahwa layanan administrasi kependudukan keliling akan dilaksanakan pada hari Rabu mendatang pukul 08.30 - 14.00 WIB di Pendopo Balai Desa.\n\nWarga diharapkan membawa dokumen persyaratan asli (Kartu Keluarga lama, Akta Kelahiran, atau Surat Pengantar RT/RW) untuk mempercepat proses pelayanan.",
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
                'content' => "Dalam rangka menjaga kelestarian lingkungan dan mencegah erosi di kawasan perbukitan, Pemerintah Desa Sukamaju mengundang seluruh elemen masyarakat untuk berpartisipasi dalam kegiatan Kerja Bakti Massal dan Penanaman 500 Bibit Pohon Alpukat serta Mangga.\n\nTitik kumpul: Lapangan Desa Sukamaju pukul 07.00 WIB. Mohon membawa peralatan kebersihan masing-masing.",
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

        // 6. Budget Years & Items
        $year2026 = BudgetYear::updateOrCreate(
            ['year' => 2026],
            [
                'title' => 'APBDes Tahun Anggaran 2026',
                'description' => 'Anggaran Pendapatan dan Belanja Desa Sukamaju Tahun Anggaran 2026 (Data Realisasi berjalan hingga Triwulan IV).',
                'is_active' => true,
            ]
        );

        $items2026 = [
            ['type' => 'Pendapatan', 'category' => 'Pendapatan Asli Desa (PADes)', 'description' => 'Hasil Usaha BUMDes & Pengelolaan Agrowisata', 'budget_amount' => 145000000, 'realized_amount' => 132500000, 'notes' => 'Setoran bagi hasil BUMDes Sukamaju Sejahtera'],
            ['type' => 'Pendapatan', 'category' => 'Dana Desa (DD)', 'description' => 'Transfer Dana Desa dari APBN', 'budget_amount' => 1180000000, 'realized_amount' => 1180000000, 'notes' => 'Pencairan Tahap I, II, dan III selesai'],
            ['type' => 'Pendapatan', 'category' => 'Alokasi Dana Desa (ADD)', 'description' => 'Alokasi Dana Desa dari APBD Kabupaten', 'budget_amount' => 625000000, 'realized_amount' => 562500000, 'notes' => 'Pencairan hingga bulan November'],
            ['type' => 'Pendapatan', 'category' => 'Bagi Hasil Pajak & Retribusi', 'description' => 'Bagi Hasil Pajak Daerah dan Retribusi Daerah', 'budget_amount' => 85000000, 'realized_amount' => 76000000, 'notes' => 'Realisasi sesuai target triwulan'],
            ['type' => 'Belanja', 'category' => 'Bidang Penyelenggaraan Pemerintahan', 'description' => 'Penghasilan Tetap, Tunjangan Perangkat & Operasional Kantor Desa', 'budget_amount' => 585000000, 'realized_amount' => 520000000, 'notes' => 'Gaji perangkat, BPD, dan layanan administrasi'],
            ['type' => 'Belanja', 'category' => 'Bidang Pelaksanaan Pembangunan', 'description' => 'Rabat Beton Jalan Usaha Tani, Irigasi & Posyandu', 'budget_amount' => 820000000, 'realized_amount' => 775000000, 'notes' => 'Pembangunan fisik infrastruktur desa'],
            ['type' => 'Belanja', 'category' => 'Bidang Pembinaan Kemasyarakatan', 'description' => 'Pembinaan Karang Taruna, PKK, Linmas & Keagamaan', 'budget_amount' => 210000000, 'realized_amount' => 185000000, 'notes' => 'Kegiatan sosial kemasyarakatan dan keamanan'],
            ['type' => 'Belanja', 'category' => 'Bidang Pemberdayaan Masyarakat', 'description' => 'Pelatihan UMKM Bambu, Ketahanan Pangan & Pertanian Organik', 'budget_amount' => 290000000, 'realized_amount' => 248000000, 'notes' => 'Program peningkatan kapasitas ekonomi warga'],
            ['type' => 'Belanja', 'category' => 'Bidang Penanggulangan Bencana', 'description' => 'BLT Dana Desa & Tanggap Darurat Bencana Alam', 'budget_amount' => 130000000, 'realized_amount' => 118000000, 'notes' => 'Bantuan langsung tunai untuk 30 KPM'],
            ['type' => 'Pembiayaan', 'category' => 'Penerimaan Pembiayaan', 'description' => 'SILPA Tahun Anggaran Sebelumnya (2025)', 'budget_amount' => 65000000, 'realized_amount' => 65000000, 'notes' => 'Sisa lebih perhitungan anggaran 2025'],
            ['type' => 'Pembiayaan', 'category' => 'Pengeluaran Pembiayaan', 'description' => 'Penyertaan Modal BUMDes Sukamaju Sejahtera', 'budget_amount' => 65000000, 'realized_amount' => 65000000, 'notes' => 'Pengembangan unit usaha wisata & air bersih'],
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
                'description' => 'Laporan Realisasi Pelaksanaan APBDes Sukamaju Tahun Anggaran 2025 (Final / Audited).',
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
    }
}
