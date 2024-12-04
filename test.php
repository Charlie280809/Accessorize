<?php
    namespace App\Accessorize;
    require_once __DIR__.'classes/Order.php';
    $conn = Db::getConnection();
    $statment = $conn->prepare("SELECT * FROM users");
    $statment->execute();

    var_dump($statment->fetchAll());
?>