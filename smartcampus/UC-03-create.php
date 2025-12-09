<?php // UC-03-create.php
// UC-03-create.php - handler to insert availability
session_start();
require_once 'db.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'staff') {
    header('Location: index.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: UC-03.php');
    exit;
}

$start = $_POST['start_time'] ?? null;
$end = $_POST['end_time'] ?? null;
$is_rec = isset($_POST['is_recurring']) ? true : false;

try {
    $pdo = get_db();
    $stmt = $pdo->prepare('INSERT INTO staff_availability (staff_id, start_time, end_time, is_virtual) VALUES (?, ?, ?, false)');
    $stmt->execute([$_SESSION['user']['user_id'], $start, $end]);
    // Note: recurring checkbox is not fully implemented here; in a real system this would enqueue/create multiple rows.
    $_SESSION['flash'] = 'Availability added';
} catch (Exception $e) {
    $_SESSION['flash'] = 'Error adding availability: ' . $e->getMessage();
}
header('Location: UC-03.php');
exit;
