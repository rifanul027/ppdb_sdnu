<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => service('uuid')->uuid4()->toString(),
                'nama' => 'Pembukaan Pendaftaran Gelombang 1 PPDB 2025/2026',
                'deskripsi' => 'Dengan bangga kami mengumumkan bahwa pendaftaran PPDB Gelombang 1 untuk tahun ajaran 2025/2026 telah dibuka. Dapatkan berbagai keuntungan dan diskon khusus untuk pendaftar gelombang pertama ini. Buruan daftar sebelum kuota terpenuhi!

Keuntungan Gelombang 1:
• Diskon biaya pendaftaran 20%
• Gratis seragam lengkap
• Prioritas pemilihan kelas
• Bebas biaya tes masuk',
                'image_url' => null,
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'id' => service('uuid')->uuid4()->toString(),
                'nama' => 'Syarat dan Ketentuan PPDB 2025/2026',
                'deskripsi' => 'Berikut adalah persyaratan lengkap untuk calon peserta didik baru tahun ajaran 2025/2026:

1. Usia 6-7 tahun per 1 Juli 2025
2. Fotocopy Akta Kelahiran yang sudah dilegalisir
3. Fotocopy Kartu Keluarga terbaru
4. Pas foto 3x4 berwarna sebanyak 4 lembar
5. Surat keterangan sehat dari dokter (opsional)
6. Ijazah TK/RA jika sudah lulus (opsional)

Untuk informasi lebih lanjut, silakan hubungi panitia PPDB melalui WhatsApp.',
                'image_url' => null,
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'id' => service('uuid')->uuid4()->toString(),
                'nama' => 'Jadwal Tes Wawancara dan Observasi',
                'deskripsi' => 'Jadwal tes wawancara dan observasi untuk calon peserta didik baru:

📅 Tanggal: 15-20 Maret 2025
🕐 Waktu: 08.00 - 12.00 WIB
📍 Lokasi: SD Nahdlatul Ulama Pemanahan

Peserta yang sudah mendaftar akan dihubungi panitia untuk konfirmasi jadwal tes. Pastikan calon siswa dalam kondisi sehat dan siap mengikuti serangkaian tes yang telah disiapkan.

Tes meliputi:
- Observasi kemampuan dasar
- Wawancara dengan orang tua
- Tes kesehatan sederhana',
                'image_url' => null,
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'id' => service('uuid')->uuid4()->toString(),
                'nama' => 'Program Beasiswa untuk Siswa Berprestasi',
                'deskripsi' => 'SD Nahdlatul Ulama Pemanahan dengan bangga mengumumkan program beasiswa untuk siswa berprestasi tahun ajaran 2025/2026. Program ini ditujukan untuk mendukung pendidikan anak-anak berprestasi dari keluarga kurang mampu.

Kriteria penerima beasiswa:
- Prestasi akademik yang baik
- Kondisi ekonomi keluarga yang kurang mampu
- Berkelakuan baik dan berakhlaq mulia
- Lulus seleksi wawancara

Beasiswa mencakup:
- Bebas SPP selama 1 tahun
- Gratis seragam dan perlengkapan sekolah
- Bantuan buku pelajaran

Pendaftaran beasiswa dapat dilakukan bersamaan dengan pendaftaran PPDB.',
                'image_url' => null,
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-6 hours')),
            ],
        ];

        $this->db->table('pengumuman')->insertBatch($data);
    }
}
