<?php
  include_once(__DIR__."/classes/Product.php"); 
  session_start();
  if($_SESSION['loggedin']!== true){
    header('Location: login.php');
  }else{
    $products = Product::getAll();
  }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessorize home</title>
</head>
<body>
  <div class="accessorize">
    <?php include_once("nav.inc.php") ?>
    <h1>Accessorize</h1>

        <?php foreach($products as $p): ?>
        <article>
            <h2><?php echo $p['title'] ?>: €<?php echo $p['price'] ?></h2>
        </article>
        <?php endforeach; ?>
  </div>
</body>
</html>