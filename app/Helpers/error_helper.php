<?php

if (!function_exists('show_error_page')) {
    /**
     * Show custom error page
     * 
     * @param int $code HTTP status code
     * @param string|null $message Custom error message
     * @param string|null $title Custom error title
     * @return ResponseInterface
     */
    function show_error_page($code = 500, $message = null, $title = null)
    {
        $errorController = new \App\Controllers\ErrorController();
        return $errorController->showError($code, $message, $title);
    }
}

if (!function_exists('show_404')) {
    /**
     * Show 404 Not Found page
     * 
     * @param string|null $message Custom error message
     * @return ResponseInterface
     */
    function show_404($message = null)
    {
        $errorController = new \App\Controllers\ErrorController();
        return $errorController->show404();
    }
}

if (!function_exists('show_403')) {
    /**
     * Show 403 Forbidden page
     * 
     * @param string|null $message Custom error message
     * @return ResponseInterface
     */
    function show_403($message = null)
    {
        $errorController = new \App\Controllers\ErrorController();
        return $errorController->show403($message);
    }
}

if (!function_exists('show_401')) {
    /**
     * Show 401 Unauthorized page
     * 
     * @param string|null $message Custom error message
     * @return ResponseInterface
     */
    function show_401($message = null)
    {
        $errorController = new \App\Controllers\ErrorController();
        return $errorController->show401($message);
    }
}

if (!function_exists('show_500')) {
    /**
     * Show 500 Internal Server Error page
     * 
     * @param string|null $message Custom error message
     * @return ResponseInterface
     */
    function show_500($message = null)
    {
        $errorController = new \App\Controllers\ErrorController();
        return $errorController->show500($message);
    }
}

if (!function_exists('require_login')) {
    /**
     * Show login required error page
     * 
     * @return ResponseInterface
     */
    function require_login()
    {
        $errorController = new \App\Controllers\ErrorController();
        return $errorController->loginRequired();
    }
}

if (!function_exists('admin_access_denied')) {
    /**
     * Show admin access denied error page
     * 
     * @return ResponseInterface
     */
    function admin_access_denied()
    {
        $errorController = new \App\Controllers\ErrorController();
        return $errorController->adminAccessDenied();
    }
}

if (!function_exists('session_expired')) {
    /**
     * Show session expired error page
     * 
     * @return ResponseInterface
     */
    function session_expired()
    {
        $errorController = new \App\Controllers\ErrorController();
        return $errorController->sessionExpired();
    }
}

if (!function_exists('maintenance_mode')) {
    /**
     * Show maintenance mode page
     * 
     * @return ResponseInterface
     */
    function maintenance_mode()
    {
        $errorController = new \App\Controllers\ErrorController();
        return $errorController->maintenanceMode();
    }
}

if (!function_exists('check_permission')) {
    /**
     * Check if current user has required permission
     * 
     * @param string $permission Required permission
     * @param string|null $redirect_url URL to redirect if permission denied
     * @return bool|ResponseInterface Returns true if has permission, error response if not
     */
    function check_permission($permission, $redirect_url = null)
    {
        $session = session();
        
        // Check if logged in
        if (!$session->get('logged_in')) {
            return require_login();
        }
        
        // Check specific permissions
        $userRole = $session->get('role');
        $userPermissions = $session->get('permissions') ?? [];
        
        switch ($permission) {
            case 'admin':
                if ($userRole !== 'admin') {
                    return admin_access_denied();
                }
                break;
                
            case 'user':
                if (!in_array($userRole, ['user', 'admin'])) {
                    return show_403('Anda tidak memiliki akses untuk halaman ini.');
                }
                break;
                
            default:
                if (!in_array($permission, $userPermissions) && $userRole !== 'admin') {
                    return show_403('Anda tidak memiliki permission: ' . $permission);
                }
        }
        
        return true;
    }
}

if (!function_exists('handle_ajax_error')) {
    /**
     * Handle AJAX error responses
     * 
     * @param int $code HTTP status code
     * @param string $message Error message
     * @param string|null $redirect_url Redirect URL
     * @return ResponseInterface
     */
    function handle_ajax_error($code, $message, $redirect_url = null)
    {
        $data = [
            'status' => 'error',
            'message' => $message,
            'code' => $code
        ];
        
        if ($redirect_url) {
            $data['redirect'] = $redirect_url;
        }
        
        return service('response')->setJSON($data)->setStatusCode($code);
    }
}
