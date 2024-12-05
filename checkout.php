<?php
    namespace App\Accessorize;

    session_start();
    include_once(__DIR__."/classes/Db.php");
    include_once(__DIR__."/classes/Order.php");
    include_once(__DIR__."/classes/OrderItem.php");
    include_once(__DIR__."/classes/User.php");


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            die("You must log in to checkout.");
        }

        $currentUser = User::getUserByEmail($_SESSION['email']); //get 
        $userId = $currentUser['id'];
        $userCurrencyBalance = $currentUser['currency_balance'];
        $cart = $_SESSION['cart'] ?? [];

        //calculate full price of all products combined
        $totalPrice = 0;
        foreach ($_SESSION['cart'] as $product) {
            $totalPrice += $product['price'] * $product['quantity'];
        }

        // Maak een nieuwe bestelling
        $order = new Order();
        $order->setUserId($userId); // Zorg ervoor dat de gebruiker is ingelogd en een sessie heeft
        $order->setTotalPrice($totalPrice);
        $order->save(); // Sla de bestelling op in de database

        // Voeg de items toe aan de bestelling
        foreach ($_SESSION['cart'] as $product) {
            $orderItem = new OrderItem();
            $orderItem->setOrderId($order->getId()); // Koppel aan de zojuist gemaakte bestelling
            $orderItem->setProductId($product['id']);
            $orderItem->setQuantity($product['quantity']);
            $orderItem->save(); // Sla het item op in de database
        }

        unset($_SESSION['cart']); //empty cart after checkout

        echo "Your order has been placed!";
        //doorverwijzing naar bestellingen? --> later
    }
?>