<?php

namespace App\Controllers;

/**
 * Example Controller showing how to use custom error pages
 * This is for demonstration purposes
 */
class ExampleController extends BaseController
{
    /**
     * Example of using custom error in controller
     */
    public function testErrors()
    {
        // Example 1: Check user permission
        $permission_check = check_permission('admin');
        if ($permission_check !== true) {
            return $permission_check; // Will return appropriate error page
        }
        
        // Example 2: Manual error handling
        try {
            // Some operation that might fail
            $data = $this->someRiskyOperation();
            
            if (!$data) {
                return show_404('Data yang Anda cari tidak ditemukan.');
            }
            
        } catch (\Exception $e) {
            if (ENVIRONMENT === 'development') {
                return show_500('Database Error: ' . $e->getMessage());
            } else {
                return show_500('Terjadi kesalahan pada sistem. Tim teknis sedang menangani masalah ini.');
            }
        }
        
        return view('example_view', ['data' => $data]);
    }
    
    /**
     * Example of AJAX error handling
     */
    public function ajaxTest()
    {
        if (!$this->request->isAJAX()) {
            return show_400('Request ini hanya menerima AJAX.');
        }
        
        $session = session();
        
        if (!$session->get('logged_in')) {
            return handle_ajax_error(401, 'Silakan login terlebih dahulu.', base_url('auth/login'));
        }
        
        try {
            // Some AJAX operation
            $result = $this->processAjaxRequest();
            
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $result
            ]);
            
        } catch (\Exception $e) {
            return handle_ajax_error(500, 'Terjadi kesalahan server.');
        }
    }
    
    /**
     * Example of maintenance mode check
     */
    public function checkMaintenance()
    {
        // Check if site is in maintenance mode (you can store this in database or config)
        $maintenance_mode = env('MAINTENANCE_MODE', false);
        
        if ($maintenance_mode) {
            return maintenance_mode();
        }
        
        return view('normal_page');
    }
    
    /**
     * Example of validation error handling
     */
    public function processForm()
    {
        if (!$this->validate([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required|numeric'
        ])) {
            $errors = $this->validator->getErrors();
            $errorMessage = "Data yang Anda masukkan tidak valid:\n";
            foreach ($errors as $field => $error) {
                $errorMessage .= "- $error\n";
            }
            
            return show_400($errorMessage);
        }
        
        // Process form if validation passes
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
    
    /**
     * Dummy method for testing
     */
    private function someRiskyOperation()
    {
        // Simulate some operation that might fail
        return null; // Simulate failure
    }
    
    /**
     * Dummy method for AJAX testing
     */
    private function processAjaxRequest()
    {
        return ['message' => 'AJAX request processed successfully'];
    }
}
