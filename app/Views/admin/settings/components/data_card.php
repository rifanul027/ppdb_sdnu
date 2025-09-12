<?php
/**
 * Admin Settings Data Card Component
 * Reusable card component for displaying data lists
 */
?>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <!-- Card Header -->
    <div class="bg-gradient-to-r from-green-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-green-100 p-2 rounded-lg">
                    <i class="fas <?= $icon ?? 'fa-list' ?> text-green-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900"><?= $title ?></h3>
                    <p class="text-sm text-gray-600" id="<?= $countId ?>">
                        Total: <span class="font-medium">0</span> <?= $unitName ?>
                    </p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <!-- Status Indicator -->
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-xs text-gray-500">Live</span>
                </div>
                <!-- Add Button -->
                <button onclick="showCreateModal('<?= $type ?>')" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 transform hover:scale-105 shadow-sm">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah <?= $buttonText ?>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Card Body -->
    <div class="p-6">
        <!-- Loading State -->
        <div id="loading-<?= $type ?>" class="flex items-center justify-center py-12">
            <div class="text-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-600 mx-auto"></div>
                <p class="text-gray-500 text-sm mt-3">Memuat data...</p>
            </div>
        </div>
        
        <!-- Data List Container -->
        <div id="<?= $listId ?>" class="space-y-4 hidden">
            <!-- Data akan dimuat via AJAX -->
        </div>
        
        <!-- Empty State -->
        <div id="empty-<?= $type ?>" class="text-center py-12 hidden">
            <div class="mx-auto h-24 w-24 text-gray-400 mb-4">
                <i class="fas <?= $emptyIcon ?? 'fa-inbox' ?> text-6xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data</h3>
            <p class="text-gray-500 mb-6">Mulai dengan menambahkan <?= strtolower($title) ?> pertama</p>
            <button onclick="showCreateModal('<?= $type ?>')" 
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Tambah <?= $buttonText ?>
            </button>
        </div>
    </div>
</div>
