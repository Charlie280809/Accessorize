<?php
    namespace App\Accessorize;
    require_once __DIR__.'/bootstrap.php';
    use App\Accessorize\Order;
    use App\Accessorize\OrderItem;
    use App\Accessorize\User;

    $currentUser = User::getUserByEmail($_SESSION['email']); //get current user
    $userId = $currentUser['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
        if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true) {
            die("You must be logged in.");
        }
        
        $cart = $_SESSION['cart'] ?? [];

        //calculate full price of all products combined
        $totalPrice = 0.00;
        foreach ($_SESSION['cart'] as $product) {
            $totalPrice += $product['price'] * $product['quantity'];
            $totalPrice = number_format($totalPrice, 2, '.', '');
        }

        $userCurrencyBalance = $currentUser['currency_balance'];
        $userCurrencyBalance = (int)$userCurrencyBalance;

        if ($userCurrencyBalance >= $totalPrice) { //check if user has enough currency
            $newBalance = number_format($userCurrencyBalance - $totalPrice, 2, '.', '');
            $newBalance = (int)$newBalance;
            //$currentUser::updateCurrencyBalance($newBalance, $userId); //this should work, but it doesn't
            //^ I disabled it, so that the rest still works

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
            echo "Something went wrong. Please try again.";
        }
    }
?>