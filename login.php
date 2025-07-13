<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$message = '';

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Fetch user by username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Set session and redirect
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];

        // ✅ Proper redirection
       header("Location: /Adi%20project%201/php-auth-app/public/dashboard.php");
exit();


;
       
    } else {
        $message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - ChocoPrime</title>
    <style>
        body { background: #2d1e1e; color: #fff; font-family: 'Segoe UI', sans-serif; }
        .login-container { max-width: 400px; margin: 60px auto; background: #fff; color: #2d1e1e; border-radius: 12px; box-shadow: 0 4px 24px rgba(0,0,0,0.2); padding: 2.5rem 2rem; }
        .login-container h2 { text-align: center; margin-bottom: 1.5rem; }
        .login-container form { display: flex; flex-direction: column; gap: 1.2rem; }
        .login-container input[type="text"], .login-container input[type="password"] { padding: 0.8rem; border: 1px solid #bfa181; border-radius: 6px; font-size: 1rem; }
        .login-container button { background: #bfa181; color: #fff; border: none; padding: 0.9rem; border-radius: 6px; font-size: 1.1rem; cursor: pointer; transition: background 0.2s; }
        .login-container button:hover { background: #a07c4e; }
        .login-container .register-link { text-align: center; margin-top: 1rem; }
        .login-container .register-link a { color: #bfa181; text-decoration: none; }
        .login-container .register-link a:hover { text-decoration: underline; }
        .login-container .error { color: #c0392b; text-align: center; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login to ChocoPrime</h2>
        <?php if (!empty($message)): ?>
            <div class="error"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="register-link">
            Don't have an account? <a href="register.php">Register</a>
        </div>
    </div>
</body>
</html>
