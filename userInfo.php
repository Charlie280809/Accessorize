<?php
    namespace App\Accessorize;
    include_once(__DIR__."/classes/Db.php");
    include_once(__DIR__."/classes/User.php"); 
    session_start();
    
    if($_SESSION['loggedin']!== true){
        header('Location: login.php');
    }
    else{
        $currentUser = User::getUserByEmail($_SESSION['email']);
        //
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
    <div class="profile">
        <a href="orders.php">View your orders</a>
        <br>
        <a href="changePassword.php">Change password</a>
        <p>Deactivate account (?)</p>
        <a href="logout.php" class="logoutbtn">Log out?</a>
    </div>
</body>
</html>