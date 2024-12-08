<?php
  namespace App\Accessorize;
  require_once __DIR__.'/bootstrap.php';
  use App\Accessorize\Product;
  use App\Accessorize\User;

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header("Location: login.php");
  }else{
    if($_SESSION['role'] == 1){ //user is admin
      $admin = true;
    }
      
    if(empty($_GET['category'])){ //no category selected --> show all products
      $products = Product::getAll();
    }
    else{
      $products = Product::getByCategory($_GET['category']); //show products by category
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
</body>
</html>