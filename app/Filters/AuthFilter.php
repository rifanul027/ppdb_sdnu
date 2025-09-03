<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        if (!$session->get('logged_in')) {
            // Check if it's an AJAX request
            if ($request->isAJAX()) {
                return service('response')->setJSON([
                    'status' => 'error',
                    'message' => 'Silakan login terlebih dahulu untuk mengakses halaman ini.',
                    'redirect' => base_url('auth/login')
                ])->setStatusCode(401);
            }
            
            // For regular requests, show custom error page
            $errorController = new \App\Controllers\ErrorController();
            return $errorController->loginRequired();
        }
        
        // Check if session has expired (optional: check last activity)
        $lastActivity = $session->get('last_activity');
        $sessionTimeout = 3600; // 1 hour in seconds
        
        if ($lastActivity && (time() - $lastActivity > $sessionTimeout)) {
            $session->destroy();
            
            if ($request->isAJAX()) {
                return service('response')->setJSON([
                    'status' => 'error',
                    'message' => 'Sesi Anda telah berakhir. Silakan login kembali.',
                    'redirect' => base_url('auth/login')
                ])->setStatusCode(401);
            }
            
            $errorController = new \App\Controllers\ErrorController();
            return $errorController->sessionExpired();
        }
        
        // Update last activity
        $session->set('last_activity', time());
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
