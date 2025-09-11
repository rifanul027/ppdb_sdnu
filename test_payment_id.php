<?php

use App\Models\PembayaranModel;

// Test payment ID generation
$paymentModel = new PembayaranModel();

// Test data
$testData = [
    'nama_pembayar' => 'John Doe',
    'metode' => 'transfer'
];

echo "Testing Payment ID Generation:\n";
echo "=============================\n\n";

// Test creating multiple payments to see the sequential numbering
for ($i = 1; $i <= 5; $i++) {
    try {
        $paymentId = $paymentModel->createPayment('test-student-id', $testData);
        echo "Payment {$i}: {$paymentId}\n";
        
        // Add small delay to ensure different timestamps if needed
        usleep(100000); // 0.1 second
        
    } catch (Exception $e) {
        echo "Error creating payment {$i}: " . $e->getMessage() . "\n";
    }
}

echo "\nExpected format: PAY" . date('Ymd') . "NNNN\n";
echo "Where NNNN is sequential number starting from 0001\n";
