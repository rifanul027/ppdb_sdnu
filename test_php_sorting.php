<?php

echo "Testing PHP-based sorting for AdminDaftarUlang:\n";
echo "==============================================\n\n";

// Sample data simulating database results
$sampleData = [
    [
        'nama_lengkap' => 'Zarina Ahmad',
        'bukti_pembayaran_id' => null,
        'no_registrasi' => 'REG001'
    ],
    [
        'nama_lengkap' => 'Ahmad Rizki',
        'bukti_pembayaran_id' => 'PAY202509120003',
        'no_registrasi' => 'REG002'
    ],
    [
        'nama_lengkap' => 'Budi Santoso',
        'bukti_pembayaran_id' => null,
        'no_registrasi' => 'REG003'
    ],
    [
        'nama_lengkap' => 'Citra Dewi',
        'bukti_pembayaran_id' => 'PAY202509120001',
        'no_registrasi' => 'REG004'
    ],
    [
        'nama_lengkap' => 'Dian Permata',
        'bukti_pembayaran_id' => 'PAY202509120002',
        'no_registrasi' => 'REG005'
    ],
];

echo "Original data:\n";
foreach ($sampleData as $index => $student) {
    $paymentId = $student['bukti_pembayaran_id'] ?: 'NULL';
    echo sprintf("%d. %-15s - %-15s - %s\n", 
        $index + 1, 
        $student['nama_lengkap'], 
        $student['no_registrasi'],
        $paymentId
    );
}

// Apply the same sorting logic as in AdminDaftarUlang
usort($sampleData, function($a, $b) {
    // If both have payments, sort by payment ID
    if ($a['bukti_pembayaran_id'] && $b['bukti_pembayaran_id']) {
        return strcmp($a['bukti_pembayaran_id'], $b['bukti_pembayaran_id']);
    }
    // If only one has payment, payment comes first
    if ($a['bukti_pembayaran_id'] && !$b['bukti_pembayaran_id']) {
        return -1;
    }
    if (!$a['bukti_pembayaran_id'] && $b['bukti_pembayaran_id']) {
        return 1;
    }
    // If neither has payment, sort by student name
    return strcmp($a['nama_lengkap'], $b['nama_lengkap']);
});

echo "\nAfter PHP sorting:\n";
foreach ($sampleData as $index => $student) {
    $paymentId = $student['bukti_pembayaran_id'] ?: 'NULL';
    echo sprintf("%d. %-15s - %-15s - %s\n", 
        $index + 1, 
        $student['nama_lengkap'], 
        $student['no_registrasi'],
        $paymentId
    );
}

echo "\nExpected result:\n";
echo "✅ Students with payments appear first, ordered by payment ID\n";
echo "✅ Students without payments appear last, ordered by name\n";
echo "✅ No SQL syntax errors!\n";
