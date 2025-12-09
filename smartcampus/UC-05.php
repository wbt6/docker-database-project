<?php // UC-05.php
// UC-05.php - Admin Reports & Analytics (simplified)
// Shows options for generating reports. Exporting or scheduled reports are not implemented here.

session_start();
require_once 'db.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!doctype html>
<html><head>
  <meta charset="utf-8">
  <title>Smartcampus Admin Reports</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container py-4">
  <h1>Admin Reports & Analytics</h1>
  <p>Welcome, <?=htmlspecialchars($user['name'])?> — this is the admin analytics page.</p>

  <div class="mb-3">
    <button class="btn btn-outline-primary" disabled>Generate Usage Report (not currently available)</button>
    <button class="btn btn-outline-secondary" disabled>Schedule Report (not currently available)</button>
  </div>

  <a class="btn btn-secondary" href="logout.php">Logout</a>
</div>
</body>
</html>
