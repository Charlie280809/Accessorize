<?php
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

    // Bereken de totale prijs
    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $product) {
        $totalPrice += $product['price'] * $product['quantity'];
    }

    // Maak een nieuwe bestelling
    $order = new App\Accessorize\Order();
    $order->setUserId($_SESSION['user_id']); // Zorg ervoor dat de gebruiker is ingelogd en een sessie heeft
    $order->setTotalPrice($totalPrice);
    $order->setOrderDate(date("Y-m-d H:i:s"));
    $order->save(); // Sla de bestelling op in de database

    // Voeg de items toe aan de bestelling
    foreach ($_SESSION['cart'] as $product) {
        $orderItem = new App\Accessorize\OrderItem();
        $orderItem->setOrderId($order->getId()); // Koppel aan de zojuist gemaakte bestelling
        $orderItem->setProductId($product['id']);
        $orderItem->setQuantity($product['quantity']);
        $orderItem->save(); // Sla het item op in de database
    }

    // Leeg de winkelwagen na afronden van de bestelling
    unset($_SESSION['cart']);

    echo "Your order has been placed!";
}
