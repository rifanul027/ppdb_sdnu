<?php

// Test file to verify the ordering in AdminDaftarUlang
// This script simulates the query used in AdminDaftarUlang controller

use App\Models\StudentModel;

$studentModel = new StudentModel();

echo "Testing AdminDaftarUlang Ordering:\n";
echo "=================================\n\n";

// Simulate the query from AdminDaftarUlang controller
$currentYear = date('Y');
$builder = $studentModel->db->table('students s');
$builder->select('s.nama_lengkap, s.no_registrasi, s.created_at, p.id as payment_id, p.created_at as payment_created_at');
$builder->join('tahun_ajaran ta', 's.tahun_ajaran_id = ta.id', 'left');
$builder->join('pembayaran p', 's.bukti_pembayaran_id = p.id', 'left');
$builder->where('s.accepted_at IS NOT NULL');
$builder->where('s.status', 'calon');
$builder->where('s.deleted_at', null);
$builder->where('ta.tahun_mulai', $currentYear);

// Apply the new ordering
$builder->orderBy('p.id IS NULL', 'ASC');
$builder->orderBy('p.id', 'ASC');

$results = $builder->get()->getResultArray();

echo "Results ordered by payment ID (earliest payment first):\n";
echo "=======================================================\n\n";

if (empty($results)) {
    echo "No results found for year {$currentYear}\n";
} else {
    echo sprintf("%-20s %-15s %-20s %-20s\n", "Name", "Registration", "Payment ID", "Payment Date");
    echo str_repeat("-", 80) . "\n";
    
    foreach ($results as $row) {
        $paymentId = $row['payment_id'] ?: 'NULL';
        $paymentDate = $row['payment_created_at'] ? date('Y-m-d H:i:s', strtotime($row['payment_created_at'])) : 'NULL';
        
        echo sprintf("%-20s %-15s %-20s %-20s\n", 
            substr($row['nama_lengkap'], 0, 19),
            $row['no_registrasi'],
            $paymentId,
            $paymentDate
        );
    }
}

echo "\nExpected order:\n";
echo "1. Students with payments (ordered by payment ID ASC)\n";
echo "2. Students without payments (NULL payment IDs last)\n";
echo "\nWith new payment ID format PAY{YYYYMMDD}{NNNN}, earlier payments will naturally appear first.\n";
