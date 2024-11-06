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
    <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
  <div class="accessorize">
    <?php include_once("nav.inc.php") ?>
    <h1>Accessorize</h1>

    <div class="collection">
      <?php foreach($products as $key => $p): ?>
          <a href="product.php?id=<?php echo $key ?>">linkk voor <?php echo $key?></a>

        <article>
            <h2><?php echo $p['title'] ?>: €<?php echo $p['price'] ?></h2>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>