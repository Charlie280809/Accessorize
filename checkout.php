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

        if ($userCurrencyBalance >= $totalPrice) { //check if user has enough currency
           
            $newBalance = $userCurrencyBalance - $totalPrice;
            $newBalance = round($newBalance, 2);
            $currentUser::updateCurrencyBalance($userId, );
            
            // create new order
            $order = new Order();
            $order->setUserId($userId);
            $order->setTotalPrice($totalPrice);
            $order->save();

            // add order to database
            foreach ($_SESSION['cart'] as $product) {
                $orderItem = new OrderItem();
                $orderItem->setOrderId($order->getId());
                $orderItem->setProductId($product['id']);
                $orderItem->setQuantity($product['quantity']);
                $orderItem->save();
            }

            unset($_SESSION['cart']); //empty cart after checkout

            header('Location: orders.php'); //go to orders
        } else {
            echo "You do not have enough currency to complete this purchase.";
        }
    }
?>