<!-- Toast Container -->
<div id="toast-container" class="fixed top-20 right-4 z-50 space-y-3">
    <!-- Toast messages will be inserted here -->
</div>

<!-- Toast Template (Hidden) -->
<div id="toast-template" class="hidden">
    <div class="toast-message max-w-sm bg-white border border-gray-200 rounded-xl shadow-lg transform translate-x-full opacity-0 transition-all duration-300">
        <div class="flex p-4">
            <div class="flex-shrink-0">
                <div class="toast-icon w-8 h-8 rounded-full flex items-center justify-center">
                    <i class="toast-icon-class text-white text-sm"></i>
                </div>
            </div>
            <div class="ml-3 flex-1">
                <div class="toast-title text-sm font-semibold text-gray-900"></div>
                <div class="toast-message-text text-sm text-gray-600 mt-1"></div>
            </div>
            <div class="ml-4">
                <button type="button" class="toast-close inline-flex text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600 transition-colors duration-200">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
        </div>
        <div class="toast-progress h-1 bg-gray-200 rounded-b-xl">
            <div class="toast-progress-bar h-full rounded-b-xl transition-all duration-300 ease-linear"></div>
        </div>
    </div>
</div>

<style>
    .toast-message {
        backdrop-filter: blur(10px);
    }
    
    .toast-message.show {
        transform: translateX(0);
        opacity: 1;
    }
    
    .toast-message.hide {
        transform: translateX(full);
        opacity: 0;
    }
    
    /* Success Toast */
    .toast-success .toast-icon {
        background: linear-gradient(135deg, #10B981, #059669);
    }
    .toast-success .toast-progress-bar {
        background: linear-gradient(90deg, #10B981, #059669);
    }
    
    /* Error Toast */
    .toast-error .toast-icon {
        background: linear-gradient(135deg, #EF4444, #DC2626);
    }
    .toast-error .toast-progress-bar {
        background: linear-gradient(90deg, #EF4444, #DC2626);
    }
    
    /* Warning Toast */
    .toast-warning .toast-icon {
        background: linear-gradient(135deg, #F59E0B, #D97706);
    }
    .toast-warning .toast-progress-bar {
        background: linear-gradient(90deg, #F59E0B, #D97706);
    }
    
    /* Info Toast */
    .toast-info .toast-icon {
        background: linear-gradient(135deg, #3B82F6, #2563EB);
    }
    .toast-info .toast-progress-bar {
        background: linear-gradient(90deg, #3B82F6, #2563EB);
    }
</style>

<script>
class ToastManager {
    constructor() {
        this.container = document.getElementById('toast-container');
        this.template = document.getElementById('toast-template');
        this.toasts = [];
        this.maxToasts = 5;
    }
    
    show(type, title, message, duration = 5000) {
        // Remove oldest toast if max limit reached
        if (this.toasts.length >= this.maxToasts) {
            this.remove(this.toasts[0]);
        }
        
        // Clone template
        const toastElement = this.template.querySelector('.toast-message').cloneNode(true);
        const toastId = 'toast-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
        toastElement.id = toastId;
        
        // Configure toast based on type
        this.configureToast(toastElement, type, title, message);
        
        // Add to container
        this.container.appendChild(toastElement);
        
        // Add to tracking array
        this.toasts.push({
            id: toastId,
            element: toastElement,
            timeout: null
        });
        
        // Show animation
        requestAnimationFrame(() => {
            toastElement.classList.add('show');
        });
        
        // Auto remove
        if (duration > 0) {
            const toast = this.toasts.find(t => t.id === toastId);
            toast.timeout = setTimeout(() => {
                this.remove(toast);
            }, duration);
            
            // Progress bar animation
            const progressBar = toastElement.querySelector('.toast-progress-bar');
            progressBar.style.width = '0%';
            requestAnimationFrame(() => {
                progressBar.style.width = '100%';
                progressBar.style.transitionDuration = duration + 'ms';
            });
        }
        
        // Close button
        const closeBtn = toastElement.querySelector('.toast-close');
        closeBtn.addEventListener('click', () => {
            const toast = this.toasts.find(t => t.id === toastId);
            this.remove(toast);
        });
        
        return toastId;
    }
    
    configureToast(element, type, title, message) {
        element.classList.add('toast-' + type);
        
        const icons = {
            success: 'fas fa-check',
            error: 'fas fa-times',
            warning: 'fas fa-exclamation-triangle',
            info: 'fas fa-info'
        };
        
        const iconElement = element.querySelector('.toast-icon-class');
        iconElement.className = 'toast-icon-class ' + (icons[type] || icons.info);
        
        element.querySelector('.toast-title').textContent = title;
        element.querySelector('.toast-message-text').textContent = message;
    }
    
    remove(toast) {
        if (!toast || !toast.element) return;
        
        // Clear timeout
        if (toast.timeout) {
            clearTimeout(toast.timeout);
        }
        
        // Hide animation
        toast.element.classList.remove('show');
        toast.element.classList.add('hide');
        
        // Remove from DOM after animation
        setTimeout(() => {
            if (toast.element && toast.element.parentNode) {
                toast.element.parentNode.removeChild(toast.element);
            }
            
            // Remove from tracking array
            const index = this.toasts.findIndex(t => t.id === toast.id);
            if (index > -1) {
                this.toasts.splice(index, 1);
            }
        }, 300);
    }
    
    success(title, message, duration = 5000) {
        return this.show('success', title, message, duration);
    }
    
    error(title, message, duration = 7000) {
        return this.show('error', title, message, duration);
    }
    
    warning(title, message, duration = 6000) {
        return this.show('warning', title, message, duration);
    }
    
    info(title, message, duration = 5000) {
        return this.show('info', title, message, duration);
    }
    
    clear() {
        this.toasts.forEach(toast => this.remove(toast));
    }
}

// Global instance
window.Toast = new ToastManager();

// Helper functions for easier use
window.showSuccessToast = (title, message, duration) => Toast.success(title, message, duration);
window.showErrorToast = (title, message, duration) => Toast.error(title, message, duration);
window.showWarningToast = (title, message, duration) => Toast.warning(title, message, duration);
window.showInfoToast = (title, message, duration) => Toast.info(title, message, duration);

// Auto show toast from session flash data
document.addEventListener('DOMContentLoaded', function() {
    // Check for flash messages from server
    <?php if (session()->getFlashdata('toast_type')): ?>
        const toastType = '<?= session()->getFlashdata('toast_type') ?>';
        const toastTitle = '<?= session()->getFlashdata('toast_title') ?>';
        const toastMessage = '<?= session()->getFlashdata('toast_message') ?>';
        
        if (toastType && toastTitle && toastMessage) {
            setTimeout(() => {
                Toast[toastType](toastTitle, toastMessage);
            }, 100);
        }
    <?php endif; ?>
});
</script>
