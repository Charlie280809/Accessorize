<?php
    namespace App\Accessorize;
    include_once(__DIR__."/classes/Db.php");
    include_once(__DIR__."/classes/Order.php");
    include_once(__DIR__."/classes/OrderItem.php");
    include_once(__DIR__."/classes/User.php");
    session_start();

    if($_SESSION['loggedin']!== true){
        header('Location: login.php');
    }
    else{
        $currentUser = User::getUserByEmail($_SESSION['email']);
        //$orders = Order::getOrdersByUserId($currentUser['id']);
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>