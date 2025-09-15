<?php

if (!function_exists('form_input_text')) {
    /**
     * Generate text input field with consistent styling
     * 
     * @param string $name Field name
     * @param string $label Field label
     * @param array $options Additional options (value, required, placeholder, etc.)
     * @return string
     */
    function form_input_text($name, $label, $options = [])
    {
        $value = $options['value'] ?? old($name) ?? '';
        $required = isset($options['required']) && $options['required'] ? true : false;
        $readonly = isset($options['readonly']) && $options['readonly'] ? true : false;
        $placeholder = $options['placeholder'] ?? '';
        $helpText = $options['help'] ?? '';
        $type = $options['type'] ?? 'text';
        $class = $options['class'] ?? '';
        
        $baseClass = 'w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-300';
        $inputClass = $class ? $baseClass . ' ' . $class : $baseClass;
        
        $html = '<div>';
        $html .= '<label class="block text-gray-700 font-semibold mb-2">' . $label;
        if ($required) {
            $html .= ' <span class="text-red-500">*</span>';
        }
        $html .= '</label>';
        $html .= '<input type="' . $type . '" name="' . $name . '" value="' . esc($value) . '"';
        if ($placeholder) {
            $html .= ' placeholder="' . esc($placeholder) . '"';
        }
        if ($readonly) {
            $html .= ' readonly';
        }
        $html .= ' class="' . $inputClass . '">';
        if ($helpText) {
            $html .= '<p class="mt-1 text-sm text-gray-500">' . $helpText . '</p>';
        }
        $html .= '</div>';
        
        return $html;
    }
}

if (!function_exists('form_input_textarea')) {
    /**
     * Generate textarea field with consistent styling
     * 
     * @param string $name Field name
     * @param string $label Field label
     * @param array $options Additional options (value, required, rows, etc.)
     * @return string
     */
    function form_input_textarea($name, $label, $options = [])
    {
        $value = $options['value'] ?? old($name) ?? '';
        $required = isset($options['required']) && $options['required'] ? true : false;
        $rows = $options['rows'] ?? 3;
        $helpText = $options['help'] ?? '';
        $class = $options['class'] ?? '';
        
        $baseClass = 'w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-300';
        $inputClass = $class ? $baseClass . ' ' . $class : $baseClass;
        
        $html = '<div>';
        $html .= '<label class="block text-gray-700 font-semibold mb-2">' . $label;
        if ($required) {
            $html .= ' <span class="text-red-500">*</span>';
        }
        $html .= '</label>';
        $html .= '<textarea name="' . $name . '" rows="' . $rows . '" class="' . $inputClass . '">' . esc($value) . '</textarea>';
        if ($helpText) {
            $html .= '<p class="mt-1 text-sm text-gray-500">' . $helpText . '</p>';
        }
        $html .= '</div>';
        
        return $html;
    }
}

if (!function_exists('form_input_select')) {
    /**
     * Generate select field with consistent styling
     * 
     * @param string $name Field name
     * @param string $label Field label
     * @param array $options Select options [value => label]
     * @param array $config Additional config (value, required, placeholder, etc.)
     * @return string
     */
    function form_input_select($name, $label, $options = [], $config = [])
    {
        $selectedValue = $config['value'] ?? old($name) ?? '';
        $required = isset($config['required']) && $config['required'] ? true : false;
        $placeholder = $config['placeholder'] ?? 'Pilih ' . $label;
        $helpText = $config['help'] ?? '';
        $class = $config['class'] ?? '';
        
        $baseClass = 'w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-300';
        $inputClass = $class ? $baseClass . ' ' . $class : $baseClass;
        
        $html = '<div>';
        $html .= '<label class="block text-gray-700 font-semibold mb-2">' . $label;
        if ($required) {
            $html .= ' <span class="text-red-500">*</span>';
        }
        $html .= '</label>';
        $html .= '<select name="' . $name . '" class="' . $inputClass . '">';
        $html .= '<option value="">' . $placeholder . '</option>';
        
        foreach ($options as $value => $optionLabel) {
            $selected = ($selectedValue == $value) ? ' selected' : '';
            $html .= '<option value="' . $value . '"' . $selected . '>' . esc($optionLabel) . '</option>';
        }
        
        $html .= '</select>';
        if ($helpText) {
            $html .= '<p class="mt-1 text-sm text-gray-500">' . $helpText . '</p>';
        }
        $html .= '</div>';
        
        return $html;
    }
}

if (!function_exists('form_input_file')) {
    function form_input_file($name, $label, $options = [])
    {
        $required = isset($options['required']) && $options['required'] ? true : false;
        $accept = $options['accept'] ?? '.pdf,.jpg,.jpeg,.png';
        $maxSize = $options['max_size'] ?? '5MB';
        $helpText = $options['help'] ?? 'Format: PDF, JPG, atau PNG (Maksimal ' . $maxSize . ')';
        $class = $options['class'] ?? '';
        $oldFile = $options['value'] ?? null; // <- ini yang kita pakai

        $baseClass = 'w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none 
                      focus:ring-2 focus:ring-green-500 transition-all duration-300 
                      file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 
                      file:text-sm file:font-medium file:bg-green-600 file:text-white 
                      hover:file:bg-green-700';
        $inputClass = $class ? $baseClass . ' ' . $class : $baseClass;

        $html = '<div>';
        $html .= '<label class="block text-gray-700 font-semibold mb-2">' . $label;
        if ($required) {
            $html .= ' <span class="text-red-500">*</span>';
        }
        $html .= '</label>';

        // tampilkan preview kalau ada value
        if ($oldFile) {
            $html .= '<p class="mb-2 text-sm text-blue-600">
                         <a href="' . base_url('uploads/' . $oldFile) . '" target="_blank" class="underline">
                             Lihat file lama
                         </a>
                      </p>';
            $html .= '<input type="hidden" name="' . $name . '_old" value="' . esc($oldFile) . '">';
        }

        // input file baru
        $html .= '<input type="file" name="' . $name . '" class="' . $inputClass . '" accept="' . $accept . '">';

        if ($helpText) {
            $html .= '<p class="mt-1 text-sm text-gray-500">' . $helpText . '</p>';
        }
        $html .= '</div>';

        return $html;
    }
}


if (!function_exists('form_section_header')) {
    /**
     * Generate form section header with consistent styling
     * 
     * @param string $title Section title
     * @param string $icon FontAwesome icon class
     * @param array $options Additional options (class, etc.)
     * @return string
     */
    function form_section_header($title, $icon = 'fas fa-edit', $options = [])
    {
        $class = $options['class'] ?? '';
        $containerClass = 'bg-gradient-to-br from-gray-50 via-white to-gray-50 border border-gray-200 rounded-xl p-6 shadow-lg';
        
        if ($class) {
            $containerClass .= ' ' . $class;
        }
        
        $html = '<div class="' . $containerClass . '">';
        $html .= '<div class="flex items-center gap-3 mb-6">';
        $html .= '<span class="inline-flex justify-center items-center size-10 rounded-full border border-green-200 bg-white text-green-600 shadow-sm">';
        $html .= '<i class="' . $icon . '"></i>';
        $html .= '</span>';
        $html .= '<h3 class="text-xl font-bold text-gray-800">' . $title . '</h3>';
        $html .= '</div>';
        
        return $html;
    }
}

if (!function_exists('form_section_footer')) {
    /**
     * Close form section
     * 
     * @return string
     */
    function form_section_footer()
    {
        return '</div>';
    }
}

if (!function_exists('form_grid_start')) {
    /**
     * Start form grid layout
     * 
     * @param int $columns Number of columns (1, 2, or 3)
     * @return string
     */
    function form_grid_start($columns = 2)
    {
        switch ($columns) {
            case 1:
                $gridClass = 'grid grid-cols-1 gap-6';
                break;
            case 3:
                $gridClass = 'grid grid-cols-1 md:grid-cols-3 gap-6';
                break;
            default:
                $gridClass = 'grid grid-cols-1 md:grid-cols-2 gap-6';
                break;
        }
        return '<div class="' . $gridClass . ' mb-6">';
    }
}

if (!function_exists('form_grid_end')) {
    /**
     * End form grid layout
     * 
     * @return string
     */
    function form_grid_end()
    {
        return '</div>';
    }
}

if (!function_exists('form_submit_button')) {
    /**
     * Generate submit button with consistent styling
     * 
     * @param string $text Button text
     * @param array $options Additional options (icon, class, etc.)
     * @return string
     */
    function form_submit_button($text = 'Kirim', $options = [])
    {
        $icon = $options['icon'] ?? 'fas fa-paper-plane';
        $class = $options['class'] ?? '';
        
        $baseClass = 'inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 border border-transparent text-white text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 py-4 px-8';
        $buttonClass = $class ? $baseClass . ' ' . $class : $baseClass;
        
        $html = '<div class="text-center">';
        $html .= '<button type="submit" class="' . $buttonClass . '">';
        if ($icon) {
            $html .= '<i class="' . $icon . '"></i>';
        }
        $html .= $text;
        $html .= '</button>';
        $html .= '</div>';
        
        return $html;
    }
}

// Predefined option arrays for common selects
if (!function_exists('get_agama_options')) {
    function get_agama_options()
    {
        return [
            'Islam' => 'Islam',
            'Kristen' => 'Kristen',
            'Katolik' => 'Katolik',
            'Hindu' => 'Hindu',
            'Buddha' => 'Buddha',
            'Konghucu' => 'Konghucu'
        ];
    }
}

if (!function_exists('get_jenis_kelamin_options')) {
    function get_jenis_kelamin_options()
    {
        return [
            'L' => 'Laki-laki',
            'P' => 'Perempuan'
        ];
    }
}

if (!function_exists('form_input_password')) {
    /**
     * Generate password input field with toggle visibility
     * 
     * @param string $name Field name
     * @param string $label Field label
     * @param array $options Additional options (required, placeholder, etc.)
     * @return string
     */
    function form_input_password($name, $label, $options = [])
    {
        $required = isset($options['required']) && $options['required'] ? 'required' : '';
        $placeholder = $options['placeholder'] ?? '';
        $helpText = $options['help'] ?? '';
        $class = $options['class'] ?? '';
        $toggleId = $options['toggle_id'] ?? 'toggle' . ucfirst($name);
        $eyeOpenId = $options['eye_open_id'] ?? $name . 'EyeOpen';
        $eyeClosedId = $options['eye_closed_id'] ?? $name . 'EyeClosed';
        
        $baseClass = 'w-full border border-gray-300 rounded-lg px-4 py-2 pr-12 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-300';
        $inputClass = $class ? $baseClass . ' ' . $class : $baseClass;
        
        $html = '<div>';
        $html .= '<label for="' . $name . '" class="block text-gray-700 font-semibold mb-1">' . $label;
        if ($required) {
            $html .= ' <span class="text-red-500">*</span>';
        }
        $html .= '</label>';
        $html .= '<div class="relative">';
        $html .= '<input id="' . $name . '" type="password" name="' . $name . '"';
        if ($placeholder) {
            $html .= ' placeholder="' . esc($placeholder) . '"';
        }
        $html .= ' class="' . $inputClass . '" ' . $required . '>';
        
        // Toggle button
        $html .= '<button type="button" id="' . $toggleId . '" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-gray-600 transition-colors">';
        
        // Eye open icon
        $html .= '<svg id="' . $eyeOpenId . '" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">';
        $html .= '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />';
        $html .= '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />';
        $html .= '</svg>';
        
        // Eye closed icon  
        $html .= '<svg id="' . $eyeClosedId . '" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">';
        $html .= '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 11-4.243-4.243m4.242 4.242L9.88 9.88" />';
        $html .= '</svg>';
        
        $html .= '</button>';
        $html .= '</div>';
        
        if ($helpText) {
            $html .= '<p class="mt-1 text-sm text-gray-500">' . $helpText . '</p>';
        }
        $html .= '</div>';
        
        return $html;
    }
}

if (!function_exists('form_input_simple')) {
    /**
     * Generate simple input field for login/register forms
     * 
     * @param string $name Field name
     * @param string $label Field label
     * @param array $options Additional options (type, value, required, placeholder, etc.)
     * @return string
     */
    function form_input_simple($name, $label, $options = [])
    {
        $type = $options['type'] ?? 'text';
        $value = $options['value'] ?? old($name) ?? '';
        $required = isset($options['required']) && $options['required'] ? 'required' : '';
        $placeholder = $options['placeholder'] ?? '';
        $class = $options['class'] ?? '';
        
        $baseClass = 'w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500';
        $inputClass = $class ? $baseClass . ' ' . $class : $baseClass;
        
        $html = '<div>';
        $html .= '<label for="' . $name . '" class="block text-sm font-medium mb-1">' . $label . '</label>';
        $html .= '<input id="' . $name . '" type="' . $type . '" name="' . $name . '"';
        if ($value) {
            $html .= ' value="' . esc($value) . '"';
        }
        if ($placeholder) {
            $html .= ' placeholder="' . esc($placeholder) . '"';
        }
        $html .= ' class="' . $inputClass . '" ' . $required . '>';
        $html .= '</div>';
        
        return $html;
    }
}

if (!function_exists('form_checkbox')) {
    /**
     * Generate checkbox input
     * 
     * @param string $name Field name
     * @param string $label Field label
     * @param array $options Additional options (checked, value, class, etc.)
     * @return string
     */
    function form_checkbox($name, $label, $options = [])
    {
        $checked = isset($options['checked']) && $options['checked'] ? 'checked' : '';
        $value = $options['value'] ?? '1';
        $class = $options['class'] ?? '';
        
        $baseClass = 'rounded border-gray-300 text-green-600 focus:ring-green-500';
        $inputClass = $class ? $baseClass . ' ' . $class : $baseClass;
        
        $html = '<label class="flex items-center space-x-2">';
        $html .= '<input type="checkbox" name="' . $name . '" value="' . $value . '" class="' . $inputClass . '" ' . $checked . '>';
        $html .= '<span>' . $label . '</span>';
        $html .= '</label>';
        
        return $html;
    }
}

if (!function_exists('password_toggle_script')) {
    /**
     * Generate JavaScript for password toggle functionality
     * 
     * @param string $passwordId Password input ID
     * @param string $toggleId Toggle button ID
     * @param string $eyeOpenId Eye open icon ID
     * @param string $eyeClosedId Eye closed icon ID
     * @return string
     */
    function password_toggle_script($passwordId, $toggleId, $eyeOpenId, $eyeClosedId)
    {
        return "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('{$toggleId}');
            const passwordInput = document.getElementById('{$passwordId}');
            const eyeOpen = document.getElementById('{$eyeOpenId}');
            const eyeClosed = document.getElementById('{$eyeClosedId}');

            if (toggleButton && passwordInput && eyeOpen && eyeClosed) {
                toggleButton.addEventListener('click', function() {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        eyeOpen.classList.add('hidden');
                        eyeClosed.classList.remove('hidden');
                    } else {
                        passwordInput.type = 'password';
                        eyeOpen.classList.remove('hidden');
                        eyeClosed.classList.add('hidden');
                    }
                });
            }
        });
        </script>";
    }
}