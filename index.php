<?php
  include_once(__DIR__."/classes/Db.php");
  include_once(__DIR__."/classes/Product.php"); 
  session_start();

  if($_SESSION['loggedin']!== true){
    header('Location: login.php');
  }
  else{
    if(empty($_GET['category'])){ //als er geen categorie is geselecteerd
      $products = App\Accessorize\Product::getAll();
    }
    else{
      $products = App\Accessorize\Product::getByCategory($_GET['category']);
    }  
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
  <?php include_once("nav.inc.php") ?>
  <div class="accessorize">
    <div class="collection">
      <?php foreach($products as $p): ?>
        <a class="collection_link" href="product.php?id=<?php echo $p['id'] ?>">
          <div class="collection_product">
            <img src="./images/<?php echo $p['thumbnail_url'] ?>.png" alt="<?php echo htmlspecialchars($p['title']) ?>">
            <div class="product_details">
              <p class="product_title"><?php echo htmlspecialchars($p['title']) ?></p>
              <p class="product_price">€<?php echo ($p['price']) ?></p>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
  
  <?php if($_SESSION['role'] == 1): ?>
    <a href="addProduct.php">product toevoegen hier</a>
  <?php endif; ?>
  </body>
</html>