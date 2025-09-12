<?php
/**
 * Form Field Components
 * Reusable form input components
 */

// Text Input Component
function renderTextInput($id, $label, $placeholder = '', $required = true, $type = 'text') {
    $requiredAttr = $required ? 'required' : '';
    $requiredMark = $required ? '<span class="text-red-500 ml-1">*</span>' : '';
    
    return '
    <div class="form-group">
        <label for="' . $id . '" class="block text-sm font-semibold text-gray-700 mb-2">
            ' . $label . $requiredMark . '
        </label>
        <input type="' . $type . '" 
               id="' . $id . '" 
               name="' . $id . '" 
               placeholder="' . $placeholder . '"
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-gray-50 focus:bg-white"
               ' . $requiredAttr . '>
    </div>';
}

// Textarea Component
function renderTextarea($id, $label, $placeholder = '', $required = false, $rows = 3) {
    $requiredAttr = $required ? 'required' : '';
    $requiredMark = $required ? '<span class="text-red-500 ml-1">*</span>' : '';
    
    return '
    <div class="form-group">
        <label for="' . $id . '" class="block text-sm font-semibold text-gray-700 mb-2">
            ' . $label . $requiredMark . '
        </label>
        <textarea id="' . $id . '" 
                  name="' . $id . '" 
                  rows="' . $rows . '"
                  placeholder="' . $placeholder . '"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-gray-50 focus:bg-white resize-none"
                  ' . $requiredAttr . '></textarea>
    </div>';
}

// Number Input Component
function renderNumberInput($id, $label, $placeholder = '', $min = '', $max = '', $required = true) {
    $requiredAttr = $required ? 'required' : '';
    $requiredMark = $required ? '<span class="text-red-500 ml-1">*</span>' : '';
    $minAttr = $min !== '' ? 'min="' . $min . '"' : '';
    $maxAttr = $max !== '' ? 'max="' . $max . '"' : '';
    
    return '
    <div class="form-group">
        <label for="' . $id . '" class="block text-sm font-semibold text-gray-700 mb-2">
            ' . $label . $requiredMark . '
        </label>
        <input type="number" 
               id="' . $id . '" 
               name="' . $id . '" 
               placeholder="' . $placeholder . '"
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-gray-50 focus:bg-white"
               ' . $requiredAttr . ' ' . $minAttr . ' ' . $maxAttr . '>
    </div>';
}

// Date Input Component
function renderDateInput($id, $label, $required = true) {
    $requiredAttr = $required ? 'required' : '';
    $requiredMark = $required ? '<span class="text-red-500 ml-1">*</span>' : '';
    
    return '
    <div class="form-group">
        <label for="' . $id . '" class="block text-sm font-semibold text-gray-700 mb-2">
            ' . $label . $requiredMark . '
        </label>
        <input type="date" 
               id="' . $id . '" 
               name="' . $id . '"
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-gray-50 focus:bg-white"
               ' . $requiredAttr . '>
    </div>';
}

// Currency Input Component  
function renderCurrencyInput($id, $label, $placeholder = '', $required = true) {
    $requiredAttr = $required ? 'required' : '';
    $requiredMark = $required ? '<span class="text-red-500 ml-1">*</span>' : '';
    
    return '
    <div class="form-group">
        <label for="' . $id . '" class="block text-sm font-semibold text-gray-700 mb-2">
            ' . $label . $requiredMark . '
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm">Rp</span>
            </div>
            <input type="text" 
                   id="' . $id . '" 
                   name="' . $id . '" 
                   placeholder="' . $placeholder . '"
                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                   onkeyup="formatCurrency(this)"
                   ' . $requiredAttr . '>
        </div>
    </div>';
}
?>
