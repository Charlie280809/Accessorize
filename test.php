<?php
    namespace App\Accessorize;
    require_once __DIR__.'/bootstrap.php';
    use App\Accessorize\User;
    use App\Accessorize\Order;
    use App\Accessorize\OrderItem;
    use App\Accessorize\Product;
    use App\Accessorize\Db;
    use App\Accessorize\Cart;
    
    $conn = Db::getConnection();
    $statment = $conn->prepare("SELECT * FROM users");
    $statment->execute();

    var_dump($statment->fetchAll());
?>