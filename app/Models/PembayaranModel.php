<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id',
        'nama',
        'metode',
        'bukti_url',
        'accepted_at',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation - disabled since we use frontend validation only
    protected $validationRules = [];
    protected $validationMessages = [];

    protected $skipValidation = true;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Generate sequential payment ID based on current date
     * Format: PAY{YYYYMMDD}{NNNN}
     * Example: PAY202509120001, PAY202509120002, etc.
     */
    private function generatePaymentId()
    {
        $datePrefix = 'PAY' . date('Ymd');
        
        // Get the highest sequence number for today
        $lastPayment = $this->db->table($this->table)
            ->select('id')
            ->where('id LIKE', $datePrefix . '%')
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->get()
            ->getRow();
        
        if ($lastPayment) {
            // Extract the last 4 digits and increment
            $lastSequence = (int) substr($lastPayment->id, -4);
            $nextSequence = $lastSequence + 1;
        } else {
            // First payment of the day
            $nextSequence = 1;
        }
        
        // Format with leading zeros (4 digits)
        $sequenceNumber = str_pad($nextSequence, 4, '0', STR_PAD_LEFT);
        
        return $datePrefix . $sequenceNumber;
    }

    /**
     * Create payment with file upload
     */
    public function createPayment($studentId, $formData, $buktiFile = null)
    {
        $paymentId = $this->generatePaymentId();
        
        // Handle file upload if exists
        $buktiUrl = null;
        
        if ($buktiFile && $buktiFile->isValid() && !$buktiFile->hasMoved()) {
            // Create payment upload directory
            $uploadPath = WRITEPATH . 'uploads/' . $studentId . '/payment';
            if (!is_dir($uploadPath)) {
                if (!mkdir($uploadPath, 0755, true)) {
                    throw new \Exception('Gagal membuat direktori upload payment.');
                }
            }
            
            $buktiName = 'payment_' . $paymentId . '.' . $buktiFile->getExtension();
            if (!$buktiFile->move($uploadPath, $buktiName)) {
                throw new \Exception('Gagal mengupload bukti pembayaran.');
            }
            $buktiUrl = 'writable/uploads/' . $studentId . '/payment/' . $buktiName;
        }
        
        // Prepare payment data
        $paymentData = [
            'id' => $paymentId,
            'nama' => $formData['nama_pembayar'],
            'metode' => $formData['metode'],
            'bukti_url' => $buktiUrl,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        // Insert payment data
        if ($this->insert($paymentData)) {
            return $paymentId;
        } else {
            // Clean up uploaded file if database insertion fails
            if ($buktiUrl && file_exists($uploadPath . '/' . $buktiName)) {
                unlink($uploadPath . '/' . $buktiName);
            }
            
            throw new \Exception('Gagal menyimpan data pembayaran.');
        }
    }
}
