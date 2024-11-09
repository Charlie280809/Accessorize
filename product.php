<?php
  include_once(__DIR__."/classes/Db.php");
  if(!isset($_GET['id'])){ //als de variabele $_GET['id'] NIET bestaat
    //redirect naar error-pg (header: 'Location(error.php)') --> maar die error-pg bestaat nog niet 
    exit("Product not found");
  }

  function getProductById($id){
    $conn = Db::getConnection();
    $statement = $conn->prepare('SELECT * FROM products WHERE id = :id');
    $statement->bindParam(':id', $id);
    $statement->execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);
    return $product;
  }

  $product = getProductById($_GET['id']);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product_details</title>
  <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
  <?php include_once("nav.inc.php"); ?>
  <div class="accessorize">
    <div class="product">
      <img src="Moon_Logo.png" alt="product" >
      <div class="product_details">
        <p class="product_title"><?php echo $product['title'] ?>
        <p class="product_price"><?php echo '€'.$product['price'] ?></p>
      </div>
    </div>

  <!--<form action="" method="post">
    <input type="hidden" name="collectionId" value="<?php// echo $id ?>">
    <input class="btn btn--primary" name="btnAdd" type="submit" value="Add to cart">
    </form>-->
</div>
</body>
</html>