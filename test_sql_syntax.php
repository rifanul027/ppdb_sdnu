<?php

// Test SQL syntax for the new ordering
require_once 'vendor/autoload.php';

$config = new \Config\Database();
$db = \Config\Database::connect();

echo "Testing SQL Syntax for AdminDaftarUlang ordering:\n";
echo "================================================\n\n";

try {
    // Test the exact query structure used in AdminDaftarUlang
    $currentYear = date('Y');
    
    $sql = "SELECT s.nama_lengkap, s.no_registrasi, p.id as payment_id 
            FROM students s 
            LEFT JOIN tahun_ajaran ta ON s.tahun_ajaran_id = ta.id 
            LEFT JOIN pembayaran p ON s.bukti_pembayaran_id = p.id 
            WHERE s.accepted_at IS NOT NULL 
            AND s.status = 'calon' 
            AND s.deleted_at IS NULL 
            AND ta.tahun_mulai = ? 
            ORDER BY ISNULL(p.id) ASC, p.id ASC 
            LIMIT 5";
    
    $query = $db->query($sql, [$currentYear]);
    $results = $query->getResultArray();
    
    echo "✅ SQL syntax is valid!\n";
    echo "Found " . count($results) . " records\n\n";
    
    if (!empty($results)) {
        echo "Sample results:\n";
        echo "Name\t\t\tRegistration\tPayment ID\n";
        echo "---------------------------------------------------\n";
        
        foreach ($results as $row) {
            $paymentId = $row['payment_id'] ?: 'NULL';
            echo sprintf("%-20s\t%s\t\t%s\n", 
                substr($row['nama_lengkap'], 0, 19),
                $row['no_registrasi'],
                $paymentId
            );
        }
    }
    
} catch (Exception $e) {
    echo "❌ SQL Error: " . $e->getMessage() . "\n";
    echo "Let's try alternative syntax...\n\n";
    
    // Alternative approach using CASE statement
    try {
        $sql = "SELECT s.nama_lengkap, s.no_registrasi, p.id as payment_id 
                FROM students s 
                LEFT JOIN tahun_ajaran ta ON s.tahun_ajaran_id = ta.id 
                LEFT JOIN pembayaran p ON s.bukti_pembayaran_id = p.id 
                WHERE s.accepted_at IS NOT NULL 
                AND s.status = 'calon' 
                AND s.deleted_at IS NULL 
                AND ta.tahun_mulai = ? 
                ORDER BY CASE WHEN p.id IS NULL THEN 1 ELSE 0 END ASC, p.id ASC 
                LIMIT 5";
        
        $query = $db->query($sql, [$currentYear]);
        $results = $query->getResultArray();
        
        echo "✅ Alternative CASE syntax works!\n";
        echo "Found " . count($results) . " records\n";
        
    } catch (Exception $e2) {
        echo "❌ Alternative also failed: " . $e2->getMessage() . "\n";
    }
}

echo "\nRecommended ORDER BY syntax:\n";
echo "1. ISNULL(p.id) ASC, p.id ASC  (MySQL)\n";
echo "2. CASE WHEN p.id IS NULL THEN 1 ELSE 0 END ASC, p.id ASC  (Universal)\n";
