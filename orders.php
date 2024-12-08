<?php
    namespace App\Accessorize;
    require_once __DIR__.'./bootstrap.php';
    use App\Accessorize\Order;
    use App\Accessorize\OrderItem;
    use App\Accessorize\User;
    use App\Accessorize\Product;
    
    if($_SESSION['loggedin']!== true){
        header('Location: login.php');
    }
    else{
        $currentUser = User::getUserByEmail($_SESSION['email']);
        $orders = Order::getOrdersByUserId($currentUser['id']);
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $currentUser['username'] .' orders'?></title>
    <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
    <?php include_once("nav.inc.php") ?>
    <div class="orders_page">
        <h1>Your orders</h1>
        <div class="all_orders">
            <?php foreach($orders as $order): ?>
                <div class="order">
                    <p>Order date: <?php echo $order['order_date'] ?></p>
                    <p>Total price: <?php echo $order['total_price'] ?></p>
                    <p>Items bought:</p>
                    <ul>
                    <?php
                        $orderItems = OrderItem::getItemsWithProductDetailsByOrderId($order['id']);
                        foreach ($orderItems as $orderItem): ?>
                            <li>
                                <?php echo $orderItem['quantity'] . 'x ' . $orderItem['title'] . ' (' . $orderItem['price'] . ' €)'; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>