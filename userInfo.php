<?php
    namespace App\Accessorize;
    require_once __DIR__.'./bootstrap.php';
    use App\Accessorize\User;
    use App\Accessorize\Db;
    
    if($_SESSION['loggedin']!== true){
        header('Location: login.php');
    }
    else{
        $currentUser = User::getUserByEmail($_SESSION['email']);
        //
    }

    if($_SESSION['role'] == 0){
        $customer = true;
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $currentUser['username']. ' details'?></title>
    <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
    <?php include_once("nav.inc.php") ?>
    <div class="user_info">
        <?php if($customer): ?>
            <a href="orders.php">View your orders</a>
        <?php endif; ?>
        <br>
        <a href="changePassword.php">Change password</a>
        <br>
        <a href="logout.php" class="logoutbtn">Log out?</a>
    </div>
</body>
</html>