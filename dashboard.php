<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | ChocoPrime</title>
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Courgette&family=Gabarito&family=Inclusive+Sans&family=Montserrat&family=Poppins&family=Roboto&family=Space+Grotesk&family=Ubuntu&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Ubuntu', sans-serif;
        }
        body {
            background: #f2f2f2;
            color: #333;
        }
        .navbar {
            background-color: #3d1f0a;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
        }
        .navbar h1 {
            font-family: 'Courgette', cursive;
            font-size: 28px;
        }
        .nav-links {
            display: flex;
            gap: 20px;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s ease;
        }
        .nav-links a:hover {
            color: #ff6b00;
        }
        .dashboard-container {
            padding: 40px 20px;
            max-width: 1200px;
            margin: auto;
        }
        .dashboard-container h2 {
            color: #3d1f0a;
            font-size: 32px;
            margin-bottom: 20px;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card i {
            font-size: 36px;
            color: #ff6b00;
            margin-bottom: 10px;
        }
        .card h3 {
            font-size: 20px;
            color: #3d1f0a;
            margin-bottom: 10px;
        }
        .card p {
            font-size: 14px;
            color: #555;
        }
        @media only screen and (max-width: 600px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }
            .nav-links {
                flex-direction: column;
                gap: 10px;
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>ChocoPrime Dashboard</h1>
        <div class="nav-links">
            <a href="../../index.html">Home</a>
            <a href="../../product.html">Products</a>
            <a href="#orders">Orders</a>
            <a href="#users">Users</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['username'] ?? 'User'; ?>!</h2>
        <div class="dashboard-grid">
            <div class="card">
                <i class="fas fa-box"></i>
                <h3>Manage Products</h3>
                <p>Add, edit, or remove chocolate products in the store.</p>
            </div>
            <div class="card">
                <i class="fas fa-shopping-cart"></i>
                <h3>View Orders</h3>
                <p>Track customer orders and manage shipping status.</p>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <h3>User Accounts</h3>
                <p>Monitor registered users and their activity.</p>
            </div>
            <div class="card">
                <i class="fas fa-chart-line"></i>
                <h3>Analytics</h3>
                <p>Get insights into sales performance and user engagement.</p>
            </div>
        </div>
    </div>
    <script src="../../index.js"></script>
</body>
</html>