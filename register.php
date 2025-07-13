<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if ($username && $email && $password) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);

        if ($stmt->fetch()) {
            $message = "Username or email already exists!";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if ($stmt->execute([$username, $email, $hash])) {
                $message = "Registration successful! <a href='login.php'>Login here</a>.";
            } else {
                $message = "Registration failed!";
            }
        }
    } else {
        $message = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register | Chocolate Haven</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #3d1f0a;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .register-container {
      background-color: white;
      padding: 2rem 3rem;
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      max-width: 400px;
      width: 100%;
    }

    .register-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #333;
    }

    .register-container input[type="text"],
    .register-container input[type="email"],
    .register-container input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }

    .register-container button {
      width: 100%;
      background-color: #3498db;
      color: white;
      border: none;
      padding: 10px;
      font-size: 1rem;
      border-radius: 6px;
      margin-top: 15px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .register-container button:hover {
      background-color: #2980b9;
    }

    .register-container p {
      margin-top: 1rem;
      text-align: center;
      font-size: 0.95rem;
    }

    .register-container p a {
      color: #3498db;
      text-decoration: none;
    }

    .message {
      text-align: center;
      margin-top: 1rem;
      font-weight: bold;
      color: #e74c3c;
    }

    .message a {
      color: #27ae60;
    }
  </style>
</head>
<body>

  <div class="register-container">
    <h2>Create Account</h2>
    <form method="post" action="">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Register</button>
    </form>

    <?php if (!empty($message)): ?>
      <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>

</body>
</html>
