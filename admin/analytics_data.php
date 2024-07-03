<?php
// Include database connection
include '../config/database.php';
include '../src/navbar.php';


// Fetch quiz results data for analytics
$sql = "SELECT COUNT(*) as total_attempts, SUM(is_correct) as total_correct FROM answers";
$stmt = $pdo->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$totalAttempts = $row['total_attempts'];
$totalCorrect = $row['total_correct'];

// Prepare data for JSON response
$data = [
    'totalAttempts' => $totalAttempts,
    'totalCorrect' => $totalCorrect,
];

// Output JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
