<?php
  namespace App\Accessorize;
  require_once __DIR__.'./bootstrap.php';
  use App\Accessorize\Product;
  use App\Accessorize\User;

  if($_SESSION['loggedin']!== true){ //als de gebruiker niet is ingelogd
    header('Location: login.php'); //terug naar de loginpagina
  }
  else{
      // $user = App\Accessorize\User::getUserByEmail($_SESSION['email']);
      // var_dump($user); DIT WERKT NIET
    if(empty($_GET['category'])){ //als er geen categorie is geselecteerd
      $products = Product::getAll(); //toon alle producten
    }
    else{
      $products = Product::getByCategory($_GET['category']); //toon producten van de geselecteerde categorie
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
  
  <?php if($_SESSION['role'] == 1): //als de gerbuiker een admin is ?>
    <a href="addProduct.php">product toevoegen hier</a>
  <?php endif; ?>
  </body>
</html>