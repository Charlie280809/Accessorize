<?php
  include_once(__DIR__."/classes/Product.php"); 
  session_start();
  if($_SESSION['loggedin']!== true){ //als 
    header('Location: login.php');
  }
  else{
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
  <nav class="navbar">
  <div class="navbar_top">
    <a href="index.php" class="logo"><img src="Moon_Logo.png" alt="logo"></a>
    <h2>Accessorize</h2>
    <a href="logout.php" class="navbar__logout">Hey <?php echo htmlspecialchars($_SESSION['email']); ?>, logout?</a>
  </div>

  <div class="navbar_search">
    <form action="" method="get">
      <input type="text" name="search" placeholder="Looking for something?">
    </form>
  </div>

  <div class="navbar_bottom">
    <a href="index.php" class="navbar__link">Home</a>
    <a href="#" class="navbar__link">Earrings</a>
    <a href="#" class="navbar__link">Rings</a>
    <a href="#" class="navbar__link">Necklaces</a>
    <a href="#" class="navbar__link">Bracelets</a>
  </div>
</nav>

    <div class="collection">
      <?php foreach($products as $key => $p): ?>
        <a href="product.php?id=<?php echo $key ?>">
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