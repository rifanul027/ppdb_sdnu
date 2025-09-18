<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
        <div class="flex justify-between items-start mb-4">
            <div>
                <div class="text-sm font-medium text-gray-600 mb-2">Total Siswa</div>
                <div class="text-3xl font-bold text-gray-900"><?= $totalSiswa ?? 0 ?></div>
            </div>
            <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                <i class="fas fa-graduation-cap text-white text-xl"></i>
            </div>
        </div>
        <div class="flex items-center text-sm text-gray-600">
            <i class="fas fa-info-circle mr-2"></i>
            <span>Siswa yang sudah diterima</span>
        </div>
    </div>
    
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
        <div class="flex justify-between items-start mb-4">
            <div>
                <div class="text-sm font-medium text-gray-600 mb-2">Total Pendaftar</div>
                <div class="text-3xl font-bold text-gray-900"><?= $totalPendaftar ?? 0 ?></div>
            </div>
            <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
        </div>
        <div class="flex items-center text-sm text-gray-600">
            <i class="fas fa-info-circle mr-2"></i>
            <span>Calon siswa yang mendaftar</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Quick Actions -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 gap-3">
                    <a href="/admin/pengaturan" class="flex items-center justify-center px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200">
                        <i class="fas fa-cog mr-2"></i>
                        Settings
                    </a>
                    
                    <a href="/admin/pendaftar" class="flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        <i class="fas fa-users mr-2"></i>
                        Lihat Pendaftar
                    </a>
                    
                    <a href="/admin/daftar-ulang" class="flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        <i class="fas fa-clipboard-list mr-2"></i>
                        Lihat Daftar Ulang
                    </a>
                    
                    <a href="/admin/siswa" class="flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Lihat Siswa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Applications -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Pendaftar Terbaru</h3>
                </div>
            </div>
            <div class="overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Registrasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (isset($pendaftarTerbaru) && !empty($pendaftarTerbaru)): ?>
                                <?php foreach ($pendaftarTerbaru as $siswa): ?>
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-mono font-semibold text-green-600">
                                                <?= esc($siswa['no_registrasi']) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-semibold text-gray-900"><?= esc($siswa['nama_lengkap']) ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <?= $siswa['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <?= date('d/m/Y H:i', strtotime($siswa['created_at'])) ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full <?= $siswa['status'] === 'siswa' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                                                <?= $siswa['status'] === 'siswa' ? 'Siswa' : 'Calon' ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                                            <div class="text-lg font-medium mb-2">Belum ada pendaftar terbaru</div>
                                            <div class="text-sm">Data pendaftar akan muncul di sini</div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="text-center">
                    <a href="/admin/pendaftar" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-500 hover:bg-green-600 transition-colors duration-200">
                        Lihat Semua Pendaftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>