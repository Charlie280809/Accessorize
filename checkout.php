<?php
namespace App\Accessorize;
session_start();
include_once(__DIR__."/classes/Db.php");
include_once(__DIR__."/classes/Order.php");
include_once(__DIR__."/classes/OrderItem.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        die("You must log in to checkout.");
    }

    $userId = $_SESSION['user_id'];
    $cart = $_SESSION['cart'] ?? [];

    if (empty($cart)) {
        die("Your cart is empty.");
    }

    $conn = Db::getConnection();

    try {
        $conn->beginTransaction();

        // Voeg bestelling toe
        $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, order_date) VALUES (:user_id, :total_price, NOW())");
        $stmt->bindValue(":user_id", $userId);
        $stmt->bindValue(":total_price", array_reduce($cart, function ($sum, $item) {
            return $sum + $item['price'] * $item['quantity'];
        }, 0));
        $stmt->execute();
        $orderId = $conn->lastInsertId();

        // Voeg order-items toe
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
        foreach ($cart as $item) {
            $stmt->bindValue(":order_id", $orderId);
            $stmt->bindValue(":product_id", $item['id']);
            $stmt->bindValue(":quantity", $item['quantity']);
            $stmt->bindValue(":price", $item['price']);
            $stmt->execute();
        }

        $conn->commit();
        $_SESSION['cart'] = []; // Maak de cart leeg
        echo "Order placed successfully!";
    } catch (\Exception $e) {
        $conn->rollBack();
        die("Something went wrong: " . $e->getMessage());
    }
}
