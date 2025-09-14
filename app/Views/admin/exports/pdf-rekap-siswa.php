<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?> - SD Nahdlatul Ulama Pemanahan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'nu-green': '#2d5016',
                        'nu-light': '#4a7c25',
                        'nu-gold': '#f59e0b'
                    }
                }
            }
        }
    </script>
    <style>
        @media print {
            body { print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-white text-gray-800 text-xs leading-relaxed p-4">
    
    <!-- Header Section -->
    <div class="border-b-4 border-nu-green pb-4 mb-6">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <div class="w-16 h-16 bg-gray-100 border-2 border-nu-green rounded-full flex items-center justify-center">
                    <div class="text-nu-green font-bold text-xs text-center leading-tight">
                        LOGO<br>SDNU
                    </div>
                </div>
            </div>
            
            <!-- School Info -->
            <div class="flex-1 text-center mx-6">
                <h1 class="text-xl font-bold text-nu-green mb-1 uppercase tracking-wide">
                    SD Nahdlatul Ulama Pemanahan
                </h1>
                <div class="text-sm text-gray-600 mb-1">
                    "Santri Aswaja, Mandiri, Unggul, Berwawasan Global, Berkarakter Lokal"
                </div>
                <div class="text-xs text-gray-500 space-y-1">
                    <div>Gg. Dahlia, RT 12 Kerto Kidul, Desa Pleret, Kec. Pleret, Kabupaten Bantul, DIY</div>
                    <div>
                        Telp/WA: +62 822-2300-8689 | Email: sdnupemanahan@gmail.com
                    </div>
                </div>
            </div>
            
            <!-- School Status -->
            <div class="flex-shrink-0 text-right">
                <div class="bg-nu-green text-white px-3 py-2 rounded text-xs font-semibold">
                    TERAKREDITASI
                </div>
                <div class="text-xs text-gray-500 mt-1">
                    NSS: 101040404062<br>
                    NPSN: 20403439
                </div>
            </div>
        </div>
    </div>

    <!-- Report Title -->
    <div class="bg-gradient-to-r from-nu-green to-nu-light text-white p-4 rounded-lg mb-6 text-center">
        <h2 class="text-lg font-bold mb-1"><?= strtoupper($title) ?></h2>
        <p class="text-sm opacity-90">Tahun Ajaran <?= date('Y') ?>/<?= date('Y') + 1 ?></p>
    </div>

    <!-- Info Grid -->
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
        <div class="grid grid-cols-2 gap-4">
            <div class="space-y-2">
                <div class="flex items-center">
                    <span class="font-semibold text-nu-green w-32">Tanggal Cetak:</span>
                    <span class="text-gray-700"><?= $generated_at ?></span>
                </div>
                <?php if (!empty($filters['tahun_ajaran'])): ?>
                <div class="flex items-center">
                    <span class="font-semibold text-nu-green w-32">Tahun Ajaran:</span>
                    <span class="text-gray-700"><?= esc($filters['tahun_ajaran']) ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($filters['status'])): ?>
                <div class="flex items-center">
                    <span class="font-semibold text-nu-green w-32">Filter Status:</span>
                    <span class="text-gray-700"><?= ucfirst($filters['status']) ?></span>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="space-y-2">
                <div class="flex items-center">
                    <span class="font-semibold text-nu-green w-32">Total Data:</span>
                    <span class="text-gray-700 font-bold"><?= count($students) ?> siswa</span>
                </div>
                <?php if (!empty($filters['tanggal_dari']) || !empty($filters['tanggal_sampai'])): ?>
                <div class="flex items-center">
                    <span class="font-semibold text-nu-green w-32">Periode:</span>
                    <span class="text-gray-700">
                        <?= !empty($filters['tanggal_dari']) ? date('d/m/Y', strtotime($filters['tanggal_dari'])) : '...' ?>
                        s/d
                        <?= !empty($filters['tanggal_sampai']) ? date('d/m/Y', strtotime($filters['tanggal_sampai'])) : '...' ?>
                    </span>
                </div>
                <?php endif; ?>
                <div class="flex items-center">
                    <span class="font-semibold text-nu-green w-32">Kepala Sekolah:</span>
                    <span class="text-gray-700">H. Ahmad Muslih, S.Pd.I</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-4 gap-3 mb-6">
        <?php
        $total_students = count($students);
        $total_calon = count(array_filter($students, function($s) { return $s['status'] === 'calon'; }));
        $total_siswa = count(array_filter($students, function($s) { return $s['status'] === 'siswa'; }));
        $total_laki = count(array_filter($students, function($s) { return $s['jenis_kelamin'] === 'L'; }));
        ?>
        
        <div class="bg-white border border-gray-200 rounded-lg p-3 text-center shadow-sm">
            <div class="text-2xl font-bold text-nu-green"><?= $total_students ?></div>
            <div class="text-xs text-gray-600">Total Pendaftar</div>
        </div>
        
        <div class="bg-white border border-gray-200 rounded-lg p-3 text-center shadow-sm">
            <div class="text-2xl font-bold text-yellow-600"><?= $total_calon ?></div>
            <div class="text-xs text-gray-600">Calon Siswa</div>
        </div>
        
        <div class="bg-white border border-gray-200 rounded-lg p-3 text-center shadow-sm">
            <div class="text-2xl font-bold text-green-600"><?= $total_siswa ?></div>
            <div class="text-xs text-gray-600">Siswa Aktif</div>
        </div>
        
        <div class="bg-white border border-gray-200 rounded-lg p-3 text-center shadow-sm">
            <div class="text-2xl font-bold text-blue-600"><?= $total_laki ?></div>
            <div class="text-xs text-gray-600">Laki-laki</div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-nu-green text-white">
                    <th class="border border-gray-300 p-2 text-center w-8">No.</th>
                    <th class="border border-gray-300 p-2 w-24">No. Registrasi</th>
                    <th class="border border-gray-300 p-2 w-32">Nama Lengkap</th>
                    <th class="border border-gray-300 p-2 w-20">JK</th>
                    <th class="border border-gray-300 p-2 w-28">TTL</th>
                    <th class="border border-gray-300 p-2 w-32">Nama Orang Tua</th>
                    <th class="border border-gray-300 p-2 w-20">Status</th>
                    <th class="border border-gray-300 p-2 w-20">Tgl Daftar</th>
                </tr>
            </thead>
            <tbody class="text-xs">
                <?php if (!empty($students)): ?>
                    <?php $no = 1; foreach ($students as $student): ?>
                        <tr class="<?= $no % 2 == 0 ? 'bg-gray-50' : 'bg-white' ?> hover:bg-gray-100">
                            <td class="border border-gray-300 p-2 text-center font-medium"><?= $no++ ?></td>
                            <td class="border border-gray-300 p-2 font-mono"><?= esc($student['no_registrasi']) ?></td>
                            <td class="border border-gray-300 p-2 font-medium"><?= esc($student['nama_lengkap']) ?></td>
                            <td class="border border-gray-300 p-2 text-center">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold <?= $student['jenis_kelamin'] === 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' ?>">
                                    <?= $student['jenis_kelamin'] ?>
                                </span>
                            </td>
                            <td class="border border-gray-300 p-2">
                                <div class="font-medium"><?= esc($student['tempat_lahir']) ?></div>
                                <div class="text-gray-600"><?= date('d/m/Y', strtotime($student['tanggal_lahir'])) ?></div>
                            </td>
                            <td class="border border-gray-300 p-2">
                                <div><strong>Ayah:</strong> <?= esc($student['nama_ayah']) ?></div>
                                <div><strong>Ibu:</strong> <?= esc($student['nama_ibu']) ?></div>
                            </td>
                            <td class="border border-gray-300 p-2 text-center">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium <?= $student['status'] === 'calon' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' ?>">
                                    <?= $student['status'] === 'calon' ? 'Calon' : 'Siswa' ?>
                                </span>
                            </td>
                            <td class="border border-gray-300 p-2 text-center text-gray-600">
                                <?= date('d/m/Y', strtotime($student['created_at'])) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="border border-gray-300 p-8 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <div class="text-4xl mb-2">📄</div>
                                <div>Tidak ada data untuk ditampilkan</div>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="mt-8 pt-6 border-t border-gray-200">
        <div class="flex justify-between items-end">
            <div class="text-xs text-gray-500">
                <p class="mb-1">Laporan ini digenerate otomatis oleh sistem PPDB SDNU Pemanahan</p>
                <p>Tanggal cetak: <?= $generated_at ?> | Total halaman: 1</p>
            </div>
            
            <div class="text-right">
                <div class="text-xs text-gray-600 mb-12">
                    Mengetahui,<br>
                    Kepala Sekolah
                </div>
                <div class="border-b border-gray-400 w-32 mb-1"></div>
                <div class="text-xs font-semibold">H. Ahmad Muslih, S.Pd.I</div>
                <div class="text-xs text-gray-500">NUPTK. 1234567890123456</div>
            </div>
        </div>
    </div>

    <!-- Watermark -->
    <div class="fixed inset-0 flex items-center justify-center pointer-events-none opacity-5 text-6xl font-bold text-nu-green rotate-45 z-0">
        SDNU PEMANAHAN
    </div>

</body>
</html>