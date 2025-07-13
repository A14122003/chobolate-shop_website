<?php
session_start();
include 'php-auth-app/public/config/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['product_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = intval($_GET['product_id']);
    $quantity = 1;

    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "<h2>Product not found.</h2>";
        exit();
    }

    $price = $product['price'];
    $total = $price * $quantity;

    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount) VALUES (?, ?)");
    $stmt->execute([$user_id, $total]);
    $order_id = $conn->lastInsertId();

    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    $stmt->execute([$order_id, $product_id, $quantity, $price]);

    echo "<div style='
        max-width: 600px; margin: 100px auto; padding: 30px;
        border-radius: 10px; background: #f9f9f9; box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif; text-align: center;'>
        <h2 style='color: #4CAF50;'>🎉 Order Confirmed!</h2>
        <p>Thank you for your purchase.</p>
        <p><strong>Product:</strong> {$product['name']}</p>
        <p><strong>Order ID:</strong> {$order_id}</p>
        <p><strong>Total Amount:</strong> ₹{$total}</p>
        <a href='product.html' style='display: inline-block; margin-top: 20px;
            background: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px;
            text-decoration: none;'>Back to Products</a>
    </div>";
} else {
    echo "<h2>Invalid request.</h2>";
}
?>
