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

    public function settings()
    {
        $data = [
            'title' => 'Settings',
            'pageTitle' => 'Settings',
            'activeTab' => 'general',
            'settings' => $this->getSettings()
        ];

        return view('admin/settings/settings', $data);
    }

    public function settingsBiaya()
    {
        $data = [
            'title' => 'Pengaturan Biaya',
            'pageTitle' => 'Pengaturan Biaya',
            'activeTab' => 'biaya',
            'biaya' => $this->getBiayaSettings(),
            'biaya_tambahan' => $this->getBiayaTambahan()
        ];

        return view('admin/settings/settings-biaya', $data);
    }

    public function settingsPendaftaran()
    {
        $data = [
            'title' => 'Pengaturan Pendaftaran',
            'pageTitle' => 'Pengaturan Pendaftaran',
            'activeTab' => 'pendaftaran',
            'settings' => $this->getPendaftaranSettings()
        ];

        return view('admin/settings/settings-pendaftaran', $data);
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

    // =========================================
    // API Methods for Tahun Ajaran
    // =========================================

    public function getTahunAjaran()
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        try {
            $data = $tahunAjaranModel->orderBy('tahun_mulai', 'DESC')->findAll();
            
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Gagal mengambil data tahun ajaran: ' . $e->getMessage()
            ]);
        }
    }

    public function storeTahunAjaran()
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        $data = [
            'nama' => $this->request->getPost('nama'),
            'tahun_mulai' => $this->request->getPost('tahun_mulai'),
            'tahun_selesai' => $this->request->getPost('tahun_selesai'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'tanggal_mulai_pendaftaran' => $this->request->getPost('tanggal_mulai_pendaftaran'),
            'tanggal_selesai_pendaftaran' => $this->request->getPost('tanggal_selesai_pendaftaran'),
            'kuota_maksimal' => $this->request->getPost('kuota_maksimal'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        try {
            if ($tahunAjaranModel->insert($data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Tahun ajaran berhasil ditambahkan'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan tahun ajaran',
                    'errors' => $tahunAjaranModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function updateTahunAjaran($id)
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        $data = [
            'nama' => $this->request->getRawInput()['nama'] ?? $this->request->getPost('nama'),
            'tahun_mulai' => $this->request->getRawInput()['tahun_mulai'] ?? $this->request->getPost('tahun_mulai'),
            'tahun_selesai' => $this->request->getRawInput()['tahun_selesai'] ?? $this->request->getPost('tahun_selesai'),
            'is_active' => ($this->request->getRawInput()['is_active'] ?? $this->request->getPost('is_active')) ? 1 : 0,
            'tanggal_mulai_pendaftaran' => $this->request->getRawInput()['tanggal_mulai_pendaftaran'] ?? $this->request->getPost('tanggal_mulai_pendaftaran'),
            'tanggal_selesai_pendaftaran' => $this->request->getRawInput()['tanggal_selesai_pendaftaran'] ?? $this->request->getPost('tanggal_selesai_pendaftaran'),
            'kuota_maksimal' => $this->request->getRawInput()['kuota_maksimal'] ?? $this->request->getPost('kuota_maksimal'),
            'deskripsi' => $this->request->getRawInput()['deskripsi'] ?? $this->request->getPost('deskripsi')
        ];

        try {
            if ($tahunAjaranModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Tahun ajaran berhasil diperbarui'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui tahun ajaran',
                    'errors' => $tahunAjaranModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteTahunAjaran($id)
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        try {
            // Check if there are students using this tahun ajaran
            $studentCount = $this->db->table('students')->where('tahun_ajaran_id', $id)->countAllResults();
            
            if ($studentCount > 0) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => "Tidak dapat menghapus tahun ajaran karena masih ada $studentCount siswa yang terdaftar"
                ]);
            }

            if ($tahunAjaranModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Tahun ajaran berhasil dihapus'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus tahun ajaran'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function activateTahunAjaran($id)
    {
        $tahunAjaranModel = new \App\Models\TahunAjaranModel();
        
        try {
            if ($tahunAjaranModel->activate($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Tahun ajaran berhasil diaktifkan'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengaktifkan tahun ajaran'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function getBeasiswa()
    {
        $beasiswaModel = new \App\Models\BeasiswaModel();
        
        try {
            $data = $beasiswaModel->orderBy('nama', 'ASC')->findAll();
            
            // Add usage count for each beasiswa
            foreach ($data as &$item) {
                $item['usage_count'] = $beasiswaModel->getUsageCount($item['id']);
                $item['can_delete'] = $item['usage_count'] == 0;
            }
            
            return $this->response->setJSON([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Gagal mengambil data beasiswa: ' . $e->getMessage()
            ]);
        }
    }

    public function storeBeasiswa()
    {
        $beasiswaModel = new \App\Models\BeasiswaModel();
        
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jenis' => $this->request->getPost('jenis'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'syarat' => $this->request->getPost('syarat'),
            'besaran_rupiah' => $this->request->getPost('besaran_rupiah'),
            'besaran_persen' => $this->request->getPost('besaran_persen'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'kuota' => $this->request->getPost('kuota'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai')
        ];

        try {
            if ($beasiswaModel->insert($data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Beasiswa berhasil ditambahkan'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan beasiswa',
                    'errors' => $beasiswaModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function updateBeasiswa($id)
    {
        $beasiswaModel = new \App\Models\BeasiswaModel();
        
        $data = [
            'nama' => $this->request->getRawInput()['nama'] ?? $this->request->getPost('nama'),
            'jenis' => $this->request->getRawInput()['jenis'] ?? $this->request->getPost('jenis'),
            'deskripsi' => $this->request->getRawInput()['deskripsi'] ?? $this->request->getPost('deskripsi'),
            'syarat' => $this->request->getRawInput()['syarat'] ?? $this->request->getPost('syarat'),
            'besaran_rupiah' => $this->request->getRawInput()['besaran_rupiah'] ?? $this->request->getPost('besaran_rupiah'),
            'besaran_persen' => $this->request->getRawInput()['besaran_persen'] ?? $this->request->getPost('besaran_persen'),
            'is_active' => ($this->request->getRawInput()['is_active'] ?? $this->request->getPost('is_active')) ? 1 : 0,
            'kuota' => $this->request->getRawInput()['kuota'] ?? $this->request->getPost('kuota'),
            'tanggal_mulai' => $this->request->getRawInput()['tanggal_mulai'] ?? $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getRawInput()['tanggal_selesai'] ?? $this->request->getPost('tanggal_selesai')
        ];

        try {
            if ($beasiswaModel->update($id, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Beasiswa berhasil diperbarui'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui beasiswa',
                    'errors' => $beasiswaModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteBeasiswa($id)
    {
        $beasiswaModel = new \App\Models\BeasiswaModel();
        
        try {
            // Check if there are students using this beasiswa
            $studentCount = $beasiswaModel->getUsageCount($id);
            
            if ($studentCount > 0) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => "Tidak dapat menghapus beasiswa karena masih ada $studentCount siswa yang menggunakannya"
                ]);
            }

            if ($beasiswaModel->delete($id)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Beasiswa berhasil dihapus'
                ]);
            } else {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus beasiswa'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

}
