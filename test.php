<?php
    
    namespace App\Accessorize;
    include_once __DIR__.'classes/Db.php';
    $conn = Db::getConnection();
    $statment = $conn->prepare("SELECT * FROM users");
    $statment->execute();

    var_dump($statment->fetchAll());
?>