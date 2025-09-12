<?php
/**
 * Admin Settings Tab Navigation Component
 */
?>

<div class="bg-white border-b">
    <div class="px-6">
        <nav class="flex space-x-8" aria-label="Tabs">
            <!-- Tab Tahun Ajaran -->
            <button id="tab-tahun-ajaran" 
                    class="tab-button active group py-4 px-1 border-b-2 font-medium text-sm transition-all duration-200"
                    onclick="switchTab('tahun-ajaran')">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-calendar-alt text-green-600 group-hover:text-green-700"></i>
                    <span class="text-green-600 group-hover:text-green-700">Tahun Ajaran</span>
                </div>
            </button>
            
            <!-- Tab Kategori -->
            <button id="tab-kategori" 
                    class="tab-button group py-4 px-1 border-b-2 border-transparent font-medium text-sm transition-all duration-200"
                    onclick="switchTab('kategori')">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-tags text-gray-500 group-hover:text-gray-700"></i>
                    <span class="text-gray-500 group-hover:text-gray-700">Kategori</span>
                </div>
            </button>
            
            <!-- Tab Gelombang -->
            <button id="tab-gelombang" 
                    class="tab-button group py-4 px-1 border-b-2 border-transparent font-medium text-sm transition-all duration-200"
                    onclick="switchTab('gelombang')">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-wave-square text-gray-500 group-hover:text-gray-700"></i>
                    <span class="text-gray-500 group-hover:text-gray-700">Gelombang Pendaftaran</span>
                </div>
            </button>
        </nav>
    </div>
</div>

<style>
.tab-button.active {
    border-bottom-color: #2563eb;
}
.tab-button.active .fas,
.tab-button.active span {
    color: #2563eb !important;
}
.tab-button:hover {
    border-bottom-color: #e5e7eb;
}
</style>
