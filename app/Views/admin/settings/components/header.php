<?php
/**
 * Admin Settings Header Component
 */
?>

<div class="bg-white shadow-sm border-b">
    <div class="px-6 py-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-cogs text-green-600 mr-3"></i>
                    Pengaturan PPDB
                </h1>
                <p class="text-sm text-gray-600 mt-1">
                    Kelola konfigurasi sistem penerimaan peserta didik baru
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="bg-green-50 px-3 py-1 rounded-full">
                    <span class="text-xs font-medium text-green-700">v2.0</span>
                </div>
                <button onclick="refreshAllData()" 
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Refresh Data
                </button>
            </div>
        </div>
    </div>
</div>
