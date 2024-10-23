<?php
  session_start();
  if($_SESSION['loggedin']!== true){
    header('Location: login.php');
  }else{
    //PDO connection
    $conn = new PDO("mysql:dbname=accessorize;host=localhost", "root", "root");
    // select * from products and fetch as array
    $statement = $conn->prepare('SELECT * FROM products');
    $statement->execute();
    $products = $statement->fetchALL(PDO::FETCH_ASSOC);

  }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessorize home</title>
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