<?php // UC-01.php
// UC-01.php - Student Dashboard with upcoming appointments

session_start();
require_once 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header('Location: index.php');
    exit;
}
$user = $_SESSION['user'];

try {
    $pdo = get_db();
    $stmt = $pdo->prepare("
        SELECT a.appointment_id, a.service_type, a.appointment_time,
               u.name AS staff_name
        FROM appointments a
        JOIN users u ON u.user_id = a.staff_id
        WHERE a.student_id = ?
          AND a.start_time >= NOW()
        ORDER BY a.start_time ASC
    ");
    $stmt->execute([$user['user_id']]);
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $appointments = [];
    $error = "Error fetching appointments: " . $e->getMessage();
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Smartcampus Student Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <h1>Student Dashboard</h1>
  <p>Welcome, <?=htmlspecialchars($user['name'])?> — this is your dashboard.</p>

  <h3>Upcoming Appointments</h3>

  <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?=$error?></div>
  <?php endif; ?>

  <?php if (empty($appointments)): ?>
    <p class="text-muted">You have no upcoming appointments.</p>
  <?php else: ?>
    <ul class="list-group mb-3">
      <?php foreach ($appointments as $a): ?>
        <li class="list-group-item">
          <strong><?=htmlspecialchars($a['service_type'])?></strong><br>
          With: <?=htmlspecialchars($a['staff_name'])?><br>
          Time: <?=htmlspecialchars($a['appointment_time'])?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <a class="btn btn-warning mb-3" href="UC-04.php">Submit Ticket / Feedback</a>
  <a class="btn btn-primary" href="UC-02.php">Book Appointment</a>
  <a class="btn btn-secondary" href="logout.php">Logout</a>
</div>
</body>
</html>

