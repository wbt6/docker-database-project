<?php // index.php
// index.php
session_start();
require_once 'db.php';

// Simple test-login page that lists users from the users table and lets you "login" as them.
// Clicking a user sets the session and redirects to the appropriate UC page (student -> UC-01, staff -> UC-03, admin -> UC-05)

try {
    $pdo = get_db();
    $stmt = $pdo->query("SELECT user_id, name, email, role FROM users ORDER BY user_id");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $users = [];
    $error = "Could not fetch users: " . $e->getMessage();
}

if (isset($_GET['login']) && is_numeric($_GET['login'])) {
    $uid = intval($_GET['login']);
    // fetch user
    $stmt = $pdo->prepare('SELECT user_id, name, role FROM users WHERE user_id = ?');
    $stmt->execute([$uid]);
    $u = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($u) {
        $_SESSION['user'] = $u;
        // redirect by role
        if ($u['role'] === 'student') {
            header('Location: UC-01.php');
            exit;
        } elseif ($u['role'] === 'staff') {
            header('Location: UC-03.php');
            exit;
        } elseif ($u['role'] === 'admin') {
            header('Location: UC-05.php');
            exit;
        } else {
            $error = 'Unknown role for user.';
        }
    } else {
        $error = 'User not found.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Test Login - SmartCampus</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SmartCampus</a>
  </div>
</nav>

<div class="container">
  <h1>Test Login (SSO placeholder)</h1>
  <p class="text-muted">Select a test user to simulate UMBC SSO login. The repo Docker DB must be running and reachable via environment variables.</p>

  <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?=htmlspecialchars($error)?></div>
  <?php endif; ?>

  <div class="list-group">
    <?php foreach ($users as $u): ?>
      <div class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <strong><?=htmlspecialchars($u['name'])?></strong> <small class="text-muted">(<?=htmlspecialchars($u['email'])?>)</small><br>
          <small class="text-muted">role: <?=htmlspecialchars($u['role'])?></small>
        </div>
        <div>
          <a class="btn btn-sm btn-outline-primary" href="?login=<?=intval($u['user_id'])?>">Login as</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if (empty($users)): ?>
    <div class="mt-3">
      <p class="text-warning">No users found in the database. Ensure the DB is running and contains test users. See README for details.</p>
    </div>
  <?php endif; ?>

</div>

<script src="assets/js/app.js"></script>
</body>
</html>
