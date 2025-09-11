<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function rekapSiswa()
    {
        $data = [
            'title' => 'Rekap Siswa',
            'pageTitle' => 'Rekap Siswa'
        ];

        return view('admin/rekap-siswa/rekap-siswa', $data);
    }

    // API untuk mengambil data siswa dengan filter dan pagination
    public function getStudentsData()
    {
        $request = $this->request;
        
        if (!$request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Invalid request']);
        }

        $studentModel = new \App\Models\StudentModel();
        
        // Get filter parameters
        $filters = [
            'status' => $request->getGet('status'),
            'tahun_ajaran' => $request->getGet('tahun_ajaran'),
            'tanggal_dari' => $request->getGet('tanggal_dari'),
            'tanggal_sampai' => $request->getGet('tanggal_sampai'),
            'search' => $request->getGet('search')
        ];

        // Pagination
        $page = intval($request->getGet('page')) ?: 1;
        $perPage = intval($request->getGet('per_page')) ?: 10;
        $offset = ($page - 1) * $perPage;

        try {
            // Get filtered data with pagination
            $builder = $studentModel->getStudentsWithRelations($filters);
            $total = $builder->countAllResults(false);
            
            $students = $builder->limit($perPage, $offset)
                ->orderBy('students.created_at', 'DESC')
                ->get()
                ->getResultArray();

            // If no data found, create sample data for testing
            if (empty($students) && $page == 1) {
                $this->createSampleData();
                
                // Try again after creating sample data
                $builder = $studentModel->getStudentsWithRelations($filters);
                $total = $builder->countAllResults(false);
                
                $students = $builder->limit($perPage, $offset)
                    ->orderBy('students.created_at', 'DESC')
                    ->get()
                    ->getResultArray();
            }

            // Format data for display
            foreach ($students as &$student) {
                $student['tanggal_lahir_formatted'] = date('d/m/Y', strtotime($student['tanggal_lahir']));
                $student['created_at_formatted'] = date('d/m/Y H:i', strtotime($student['created_at']));
            }

            return $this->response->setJSON([
                'success' => true,
                'data' => $students,
                'pagination' => [
                    'page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                    'total_pages' => ceil($total / $perPage)
                ]
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // API untuk update status siswa
    public function updateStudentStatus($id)
    {
        $request = $this->request;
        
        if (!$request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Invalid request']);
        }

        $studentModel = new \App\Models\StudentModel();
        $input = $request->getJSON(true);

        try {
            $data = [
                'status' => $input['status'] ?? ''
            ];

            if ($studentModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Status siswa berhasil diupdate'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengupdate status siswa'
                ]);
            }

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // API untuk delete siswa
    public function deleteStudent($id)
    {
        $request = $this->request;
        
        if (!$request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Invalid request']);
        }

        $studentModel = new \App\Models\StudentModel();

        try {
            if ($studentModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Data siswa berhasil dihapus'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus data siswa'
                ]);
            }

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // Export Excel
    public function exportExcel()
    {
        $request = $this->request;
        $studentModel = new \App\Models\StudentModel();
        
        // Get filter parameters
        $filters = [
            'status' => $request->getGet('status'),
            'tahun_ajaran' => $request->getGet('tahun_ajaran'),
            'tanggal_dari' => $request->getGet('tanggal_dari'),
            'tanggal_sampai' => $request->getGet('tanggal_sampai'),
            'search' => $request->getGet('search')
        ];

        try {
            // Get all data without pagination for export
            $students = $studentModel->getStudentsWithRelations($filters)
                ->orderBy('students.created_at', 'DESC')
                ->get()
                ->getResultArray();

            // Create CSV content
            $csv = "No,No. Registrasi,Nama Lengkap,Jenis Kelamin,Tempat Lahir,Tanggal Lahir,Alamat,Domisili,Nama Ayah,Nama Ibu,Status,Tahun Ajaran,Tanggal Daftar\n";
            
            $no = 1;
            foreach ($students as $student) {
                $csv .= '"' . $no++ . '",';
                $csv .= '"' . ($student['no_registrasi'] ?? '') . '",';
                $csv .= '"' . ($student['nama_lengkap'] ?? '') . '",';
                $csv .= '"' . ($student['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan') . '",';
                $csv .= '"' . ($student['tempat_lahir'] ?? '') . '",';
                $csv .= '"' . date('d/m/Y', strtotime($student['tanggal_lahir'])) . '",';
                $csv .= '"' . str_replace('"', '""', $student['alamat'] ?? '') . '",';
                $csv .= '"' . str_replace('"', '""', $student['domisili'] ?? '') . '",';
                $csv .= '"' . ($student['nama_ayah'] ?? '') . '",';
                $csv .= '"' . ($student['nama_ibu'] ?? '') . '",';
                $csv .= '"' . ($student['status'] === 'calon' ? 'Calon Siswa' : 'Siswa') . '",';
                $csv .= '"' . ($student['tahun_ajaran_nama'] ?? '') . '",';
                $csv .= '"' . date('d/m/Y', strtotime($student['created_at'])) . '"';
                $csv .= "\n";
            }

            $filename = 'rekap-siswa-' . date('Y-m-d') . '.csv';
            
            return $this->response
                ->setHeader('Content-Type', 'text/csv; charset=utf-8')
                ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->setHeader('Cache-Control', 'no-cache, must-revalidate')
                ->setBody($csv);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat export: ' . $e->getMessage());
        }
    }

    // Export PDF
    public function exportPdf()
    {
        $request = $this->request;
        $studentModel = new \App\Models\StudentModel();
        
        // Get filter parameters
        $filters = [
            'status' => $request->getGet('status'),
            'tahun_ajaran' => $request->getGet('tahun_ajaran'),
            'tanggal_dari' => $request->getGet('tanggal_dari'),
            'tanggal_sampai' => $request->getGet('tanggal_sampai'),
            'search' => $request->getGet('search')
        ];

        try {
            // Get all data without pagination for export
            $students = $studentModel->getStudentsWithRelations($filters)
                ->orderBy('students.created_at', 'DESC')
                ->get()
                ->getResultArray();

            $data = [
                'title' => 'Laporan Rekap Siswa',
                'students' => $students,
                'filters' => $filters,
                'generated_at' => date('d/m/Y H:i:s')
            ];

            // Generate HTML for PDF
            $html = view('admin/exports/pdf-rekap-siswa', $data);
            
            // For now, return HTML (you can integrate with TCPDF or MPDF later)
            return $this->response
                ->setHeader('Content-Type', 'text/html; charset=utf-8')
                ->setBody($html);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat export PDF: ' . $e->getMessage());
        }
    }

    public function profile()
    {
        $data = [
            'title' => 'Profile Admin',
            'pageTitle' => 'Profile',
            'admin' => $this->getAdminProfile(),
            'activities' => $this->getAdminActivities()
        ];

        return view('admin/settings/profile', $data);
    }

}
