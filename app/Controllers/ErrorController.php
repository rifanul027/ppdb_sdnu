<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class ErrorController extends BaseController
{
    /**
     * Handle 404 Not Found errors
     */
    public function show404()
    {
        return $this->response
            ->setStatusCode(404)
            ->setBody(view('errors/html/error_404'));
    }

    /**
     * Handle 403 Forbidden errors
     */
    public function show403($message = null)
    {
        $data = [];
        if ($message) {
            $data['message'] = $message;
        }
        
        return $this->response
            ->setStatusCode(403)
            ->setBody(view('errors/html/error_403', $data));
    }

    /**
     * Handle 401 Unauthorized errors
     */
    public function show401($message = null)
    {
        $data = [];
        if ($message) {
            $data['message'] = $message;
        }
        
        return $this->response
            ->setStatusCode(401)
            ->setBody(view('errors/html/error_401', $data));
    }

    /**
     * Handle 400 Bad Request errors
     */
    public function show400($message = null)
    {
        $data = [];
        if ($message) {
            $data['message'] = $message;
        }
        
        return $this->response
            ->setStatusCode(400)
            ->setBody(view('errors/html/error_400', $data));
    }

    /**
     * Handle 500 Internal Server errors
     */
    public function show500($message = null)
    {
        $data = [];
        if ($message) {
            $data['message'] = $message;
        }
        
        return $this->response
            ->setStatusCode(500)
            ->setBody(view('errors/html/error_500', $data));
    }

    /**
     * Handle custom errors with specific codes
     */
    public function showError($code = 500, $message = null, $title = null)
    {
        $data = [
            'code' => $code,
            'message' => $message,
            'title' => $title
        ];

        // Choose appropriate error page based on code
        $errorView = 'errors/html/production';
        switch ($code) {
            case 400:
                $errorView = 'errors/html/error_400';
                break;
            case 401:
                $errorView = 'errors/html/error_401';
                break;
            case 403:
                $errorView = 'errors/html/error_403';
                break;
            case 404:
                $errorView = 'errors/html/error_404';
                break;
            case 500:
                $errorView = 'errors/html/error_500';
                break;
        }

        return $this->response
            ->setStatusCode($code)
            ->setBody(view($errorView, $data));
    }

    /**
     * Handle unauthorized access to admin areas
     */
    public function adminAccessDenied()
    {
        $message = 'Anda tidak memiliki akses untuk mengakses area administrator. Silakan login dengan akun administrator yang valid.';
        
        return $this->response
            ->setStatusCode(403)
            ->setBody(view('errors/html/error_403', ['message' => $message]));
    }

    /**
     * Handle when user is not logged in but trying to access protected areas
     */
    public function loginRequired()
    {
        $message = 'Silakan login terlebih dahulu untuk mengakses halaman ini.';
        
        return $this->response
            ->setStatusCode(401)
            ->setBody(view('errors/html/error_401', ['message' => $message]));
    }

    /**
     * Handle when user account is not activated
     */
    public function accountNotActivated()
    {
        $message = 'Akun Anda belum diaktivasi. Silakan check email untuk link aktivasi atau hubungi administrator.';
        
        return $this->response
            ->setStatusCode(403)
            ->setBody(view('errors/html/error_403', ['message' => $message]));
    }

    /**
     * Handle when session has expired
     */
    public function sessionExpired()
    {
        $message = 'Sesi Anda telah berakhir. Silakan login kembali untuk melanjutkan.';
        
        return $this->response
            ->setStatusCode(401)
            ->setBody(view('errors/html/error_401', ['message' => $message]));
    }

    /**
     * Handle maintenance mode
     */
    public function maintenanceMode()
    {
        $data = [
            'message' => 'Website sedang dalam mode maintenance. Kami sedang melakukan perbaikan sistem untuk meningkatkan pelayanan. Silakan coba lagi dalam beberapa saat.'
        ];
        
        return $this->response
            ->setStatusCode(503)
            ->setBody(view('errors/html/error_500', $data));
    }
}
