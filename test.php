<?php
    namespace App\Accessorize;
    require_once __DIR__.'/vendor/autoload.php';
    require_once __DIR__.'classes/Db.php';
    require_once __DIR__.'classes/Order.php';
    
    $conn = Db::getConnection();
    $statment = $conn->prepare("SELECT * FROM users");
    $statment->execute();

    var_dump($statment->fetchAll());
?>