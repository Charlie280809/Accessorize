<?php
  include_once(__DIR__."/classes/Product.php"); 
  // session_start();
  // if($_SESSION['loggedin']!== true){
  //   header('Location: login.php');
  // }
  // else{
  //   $products = Product::getAll();
  // }
  $products = App\Accessorize\Product::getAll();

  
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessorize home</title>
    <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
  <?php include_once("nav.inc.php") ?>
  <div class="accessorize">
    <div class="collection">
      <?php foreach($products as $key => $p): ?>
        <a class="collection_link" href="product.php?id=<?php echo $key ?>">
          <div class="collection_product">
            <img src="Moon_Logo.png" alt="<?php echo $p['title'] ?>">
            <div class="product_details">
              <p class="product_title"><?php echo $p['title'] ?></p>
              <p class="product_price">€<?php echo $p['price'] ?></p>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>