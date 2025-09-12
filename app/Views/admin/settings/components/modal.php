<?php
/**
 * Admin Settings Modal Component
 * Reusable modal component for forms
 */
?>

<div id="modal-<?= $type ?>" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 transition-all duration-300">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 scale-95 modal-content">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                            <i class="fas <?= $icon ?? 'fa-plus' ?> text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white" id="modal-<?= $type ?>-title">
                            <?= $title ?>
                        </h3>
                    </div>
                    <button type="button" onclick="closeModal('<?= $type ?>')" 
                            class="text-white hover:text-gray-200 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6">
                <form id="form-<?= $type ?>" class="space-y-6">
                    <input type="hidden" id="<?= $type ?>-id" name="id" value="">
                    
                    <!-- Dynamic Form Content -->
                    <?= $formContent ?>
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 rounded-b-2xl flex justify-end space-x-3">
                <button type="button" onclick="closeModal('<?= $type ?>')" 
                        class="px-6 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </button>
                <button type="submit" form="form-<?= $type ?>" 
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>
                    <span id="submit-text-<?= $type ?>">Simpan</span>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.modal-content {
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-20px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}
</style>
