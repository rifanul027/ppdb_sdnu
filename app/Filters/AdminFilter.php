<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Check if user is logged in
        if (!$session->get('logged_in')) {
            if ($request->isAJAX()) {
                return service('response')->setJSON([
                    'status' => 'error',
                    'message' => 'Silakan login terlebih dahulu untuk mengakses area administrator.',
                    'redirect' => base_url('auth/login')
                ])->setStatusCode(401);
            }
            
            $errorController = new \App\Controllers\ErrorController();
            return $errorController->loginRequired();
        }
        
        // Check if user has admin role
        if ($session->get('role') !== 'admin') {
            if ($request->isAJAX()) {
                return service('response')->setJSON([
                    'status' => 'error',
                    'message' => 'Akses ditolak. Anda tidak memiliki hak akses administrator.',
                    'redirect' => base_url()
                ])->setStatusCode(403);
            }
            
            $errorController = new \App\Controllers\ErrorController();
            return $errorController->adminAccessDenied();
        }
        
        // Check if session has expired
        $lastActivity = $session->get('last_activity');
        $sessionTimeout = 3600; // 1 hour in seconds
        
        if ($lastActivity && (time() - $lastActivity > $sessionTimeout)) {
            $session->destroy();
            
            if ($request->isAJAX()) {
                return service('response')->setJSON([
                    'status' => 'error',
                    'message' => 'Sesi administrator telah berakhir. Silakan login kembali.',
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
