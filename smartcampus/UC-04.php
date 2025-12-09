<?php // UC-04.php
// UC-04.php - Submit & Track Issue/Feedback (simplified)
// Allows students to submit a ticket. Tracking and assignment are minimal in this prototype.

session_start();
require_once 'db.php';
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'] ?? '';
    $description = $_POST['description'] ?? '';
    try {
        $pdo = get_db();
        $stmt = $pdo->prepare('INSERT INTO tickets (student_id, category, description) VALUES (?, ?, ?)');
        $stmt->execute([$user['user_id'], $category, $description]);
        $message = 'Ticket created.';
    } catch (Exception $e) {
        $message = 'Error creating ticket: ' . $e->getMessage();
    }
}
?>
<!doctype html>
<html><head>
  <meta charset="utf-8">
  <title>Smartcampus Submit Issue</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container py-4">
  <h1>Submit Issue / Feedback</h1>
  <?php if (isset($message)): ?><div class="alert alert-info"><?=htmlspecialchars($message)?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Category</label>
      <input name="category" class="form-control" placeholder="e.g., Technical, Appointment" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="4" required></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Submit Ticket</button>
  </form>
  <a class="btn btn-primary" href="UC-01.php">Back to Dashboard</a>
  <a class="btn btn-secondary mt-3" href="logout.php">Logout</a>
</div>
</body>
</html>
