<?php // UC-02.php
// UC-02.php - Book Appointment with full PHP functionality

session_start();
require_once 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header('Location: index.php');
    exit;
}

$pdo = get_db();
$user = $_SESSION['user'];

$service_type = $_POST['service_type'] ?? null;
$selected_staff = $_POST['staff_id'] ?? null;
$selected_availability = $_POST['availability_id'] ?? null;

$message = null;

/* --- Handle booking submission --- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_appointment'])) {

    try {
        $stmt = $pdo->prepare("
            SELECT staff_id, start_time, end_time 
            FROM staff_availability 
            WHERE availability_id = ?
        ");
        $stmt->execute([$selected_availability]);
        $slot = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($slot) {
            $insert = $pdo->prepare("
                INSERT INTO appointments (student_id, staff_id, service_type, start_time, end_time)
                VALUES (?, ?, ?, ?, ?)
            ");
            $insert->execute([
                $user['user_id'],
                $slot['staff_id'],
                $service_type,
                $slot['start_time'],
                $slot['end_time']
            ]);

            // OPTIONAL: remove availability so it cannot be booked twice
            $del = $pdo->prepare("DELETE FROM staff_availability WHERE availability_id = ?");
            $del->execute([$selected_availability]);

            $message = "Appointment booked successfully!";
        } else {
            $message = "Selected availability no longer exists.";
        }

    } catch (Exception $e) {
        $message = "Error booking appointment: " . $e->getMessage();
    }
}

/* --- Step 1: Service Types --- */
$service_types = ["Advising", "Tutoring", "IT support"];

/* --- Step 2: Fetch staff by department --- */
$staff = [];
if ($service_type) {
    $stmt = $pdo->prepare("
        SELECT users.user_id, users.name 
        FROM users
        JOIN departments d ON d.department_id = users.department_id
        WHERE users.role = 'staff'
          AND d.name = ?
    ");
    $stmt->execute([$service_type]);
    $staff = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/* --- Step 3: Fetch valid staff availability --- */
$availability = [];
if ($selected_staff) {
    $stmt = $pdo->prepare("
        SELECT availability_id, start_time, end_time
        FROM staff_availability
        WHERE staff_id = ?
          AND start_time >= NOW()
        ORDER BY start_time ASC
    ");
    $stmt->execute([$selected_staff]);
    $availability = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Smartcampus Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">

<h1>Book Appointment</h1>

<?php if ($message): ?>
    <div class="alert alert-info"><?=$message?></div>
<?php endif; ?>

<form method="post">

    <!-- Service Type -->
    <div class="mb-3">
        <label class="form-label">Service Type</label>
        <select name="service_type" class="form-select" onchange="this.form.submit()">
            <option value="">Select service...</option>
            <?php foreach ($service_types as $t): ?>
                <option value="<?=$t?>" <?=($service_type==$t?"selected":"")?>><?=$t?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Staff -->
    <?php if ($service_type): ?>
    <div class="mb-3">
        <label class="form-label">Staff</label>
        <select name="staff_id" class="form-select" onchange="this.form.submit()">
            <option value="">Select staff...</option>
            <?php foreach ($staff as $s): ?>
                <option value="<?=$s['user_id']?>" <?=($selected_staff==$s['user_id']?"selected":"")?>>
                    <?=htmlspecialchars($s['name'])?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php endif; ?>

    <!-- Availability -->
    <?php if ($selected_staff): ?>
    <div class="mb-3">
        <label class="form-label">Available Times</label>
        <select name="availability_id" class="form-select">
            <option value="">Select time...</option>
            <?php foreach ($availability as $a): ?>
                <option value="<?=$a['availability_id']?>">
                    <?=htmlspecialchars($a['start_time'])?> — <?=htmlspecialchars($a['end_time'])?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="btn btn-primary" name="book_appointment">Book Appointment</button>
    <?php endif; ?>

</form>

<a class="btn btn-secondary mt-3" href="UC-01.php">Back to Dashboard</a>

</div>
</body>
</html>
