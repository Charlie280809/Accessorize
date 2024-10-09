<?php
    // $conn = new mysqli("localhost", "root", "root", "accessorize");
    
    // $sql = "SELECT * FROM products";
    // $result = $conn->query($sql);
    // $products = $result->fetch_all(MYSQLI_ASSOC);

    //PDO connection
    $conn = new PDO("mysql:dbname=accessorize;host=localhost", "root", "root");
    // select * from products and fetch as array
    $statement = $conn->prepare('SELECT * FROM products');
    $statement->execute();
    $products = $statement->fetchALL(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessorize</title>
</head>
<body>
    <h1>Accessorize</h1>

    <?php foreach($products as $product): ?>
    <article>
        <h2><?php echo $product['title'] ?>: €<?php echo $product['price'] ?></h2>
    </article>
    <?php endforeach; ?>
</body>
</html>