<?php // UC-03.php
// UC-03.php - Staff Manage Availability (simplified)
// Staff can add availability entries. The recurring feature is noted but not fully implemented.

session_start();
require_once 'db.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'staff') {
    header('Location: index.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!doctype html>
<html><head>
  <meta charset="utf-8">
  <title>Smartcampus Staff Manage Availability</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container py-4">
  <h1>Manage Availability</h1>
  <p>Welcome, <?=htmlspecialchars($user['name'])?> — this is The Staff Availability Manager.</p>

  <form method="post" action="UC-03-create.php">
    <div class="mb-3">
      <label class="form-label">Start time</label>
      <input type="datetime-local" name="start_time" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">End time</label>
      <input type="datetime-local" name="end_time" class="form-control" required>
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" name="is_recurring" id="rec" class="form-check-input">
      <label for="rec" class="form-check-label">Recurring (adds repeat weekly within semester ranges) — not fully implemented</label>
    </div>
    <button class="btn btn-primary" type="submit">Add Availability</button>
  </form>

  <a class="btn btn-secondary mt-3" href="logout.php">Logout</a>
</div>
</body>
</html>
