<?php
    namespace App\Accessorize;
    require_once __DIR__.'classes/Order.php';
    require_once __DIR__.'classes/Db.php';
    $conn = Db::getConnection();
    $statment = $conn->prepare("SELECT * FROM users");
    $statment->execute();

    var_dump($statment->fetchAll());
?>