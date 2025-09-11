<?php

echo "Testing COALESCE ORDER BY approach:\n";
echo "===================================\n\n";

// Sample data to demonstrate the ordering
$sampleData = [
    ['name' => 'Student A', 'payment_id' => 'PAY202509120001'],
    ['name' => 'Student B', 'payment_id' => null],
    ['name' => 'Student C', 'payment_id' => 'PAY202509120003'],
    ['name' => 'Student D', 'payment_id' => null],
    ['name' => 'Student E', 'payment_id' => 'PAY202509120002'],
    ['name' => 'Student F', 'payment_id' => 'PAY202509130001'],
];

echo "Original data:\n";
foreach ($sampleData as $index => $student) {
    $paymentId = $student['payment_id'] ?: 'NULL';
    echo sprintf("%d. %-12s - %s\n", $index + 1, $student['name'], $paymentId);
}

echo "\nAfter COALESCE ordering (simulated):\n";

// Sort using the same logic as COALESCE(p.id, "ZZZZZZZZZZZZZZZ")
usort($sampleData, function($a, $b) {
    $aValue = $a['payment_id'] ?: 'ZZZZZZZZZZZZZZZ';
    $bValue = $b['payment_id'] ?: 'ZZZZZZZZZZZZZZZ';
    return strcmp($aValue, $bValue);
});

foreach ($sampleData as $index => $student) {
    $paymentId = $student['payment_id'] ?: 'NULL';
    echo sprintf("%d. %-12s - %s\n", $index + 1, $student['name'], $paymentId);
}

echo "\nExpected result:\n";
echo "- Students with payments appear first, ordered by payment ID\n";
echo "- Students without payments appear last\n";
echo "- Payment IDs are naturally ordered by date and sequence\n";

echo "\nSQL equivalent:\n";
echo "ORDER BY COALESCE(p.id, \"ZZZZZZZZZZZZZZZ\") ASC\n";
