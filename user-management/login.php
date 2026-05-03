<?php
session_start();
require 'autoload.php';

use App\Models\Admin;
use App\Models\RegularUser;
use App\Services\AuthService;

if (isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit;
}

$admin = new Admin("Alice", "alice@example.com", "admin123");
$user = new RegularUser("Bob", "bob@example.com", "user123");
$authService = new AuthService();

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $adminLoginResult = $authService->authenticate($admin, $email, $password);
    $userLoginResult = $authService->authenticate($user, $email, $password);

    if (strpos($adminLoginResult, 'successfully') !== false) {
        $_SESSION['user_name'] = $admin->getName();
        $_SESSION['user_role'] = $admin->userRole();
        header("Location: index.php");
        exit;
    } elseif (strpos($userLoginResult, 'successfully') !== false) {
        $_SESSION['user_name'] = $user->getName();
        $_SESSION['user_role'] = $user->userRole();
        header("Location: index.php");
        exit;
    } else {
        $error_message = "Check email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Login - User Management System</title>
</head>
<body>
    <h2>Login to System</h2>
    
    <?php if ($error_message): ?>
        <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
    
    <hr>
    <p><strong>Test Data:</strong></p>
    <ul>
        <li>Admin: alice@example.com / admin123</li>
        <li>User: bob@example.com / user123</li>
    </ul>
</body>
</html>