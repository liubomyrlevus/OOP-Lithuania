<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Main - User Management System</title>
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h2>
    <p>Your role in the system: <strong><?= htmlspecialchars($_SESSION['user_role']) ?></strong></p>
    
    <?php if ($_SESSION['user_role'] === 'Admin'): ?>
        <div style="background-color: #f4f4f4; padding: 10px; border: 1px solid #ccc;">
            <h3>Admin Panel</h3>
            <p>These are functions available only to administrators.</p>
        </div>
    <?php endif; ?>

    <br>
    <a href="logout.php"><button>Logout</button></a>
</body>
</html>