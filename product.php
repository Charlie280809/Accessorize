<?php
  namespace App\Accessorize;
  session_start();
  include_once(__DIR__."/classes/Db.php");

  include_once(__DIR__."/classes/Review.php");
  if(!isset($_GET['id'])){ //als de variabele $_GET['id'] NIET bestaat
    //redirect naar error-pg (header: 'Location(error.php)') --> maar die error-pg bestaat nog niet 
    exit("Product not found");
  }

  function getProductById($id){
    $conn = Db::getConnection();
    $statement = $conn->prepare('SELECT * FROM products WHERE id = :id');
    $statement->bindParam(':id', $id);
    $statement->execute();
    $product = $statement->fetch(\PDO::FETCH_ASSOC);
    return $product;
  }

  $product = getProductById($_GET['id']);
  $allReviews = Review::getAllReviewsByProductId($_GET['id']);

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
      <div class="product_imgs">
        <img src="./images/<?php echo $product['img1_url'] ?>.png" alt=" <?php echo $product['title'] ?>" >
        <img src="./images/<?php echo $product['img2_url'] ?>.png" alt=" <?php echo $product['title'] ?>" >
      </div>
        <img class="product_thumbnail" src="./images/<?php echo $product['thumbnail_url'] ?>.png" alt=" <?php echo $product['title'] ?>" >
      <div class="product_details">
        <p class="product_title"><?php echo $product['title'] ?>
        <p class="product_price"><?php echo '€'.$product['price'] ?></p>
        <p class="product_description"><?php echo $product['description'] ?></p>
        <p class="product_stock"><?php echo 'Stock: '.$product['stock_amount'] .' pieces left' ?></p>
        <p class="product_color"><?php echo 'Color: '.$product['color'] ?></p>
        <p class="product_creator"><?php echo 'created by '.$product['created_by'] ?></p>
        <!-- <p class="update_date"><?php //echo 'updated at ' .$product['updated_at'] ?></p> -->
      </div>
    </div>

    <div class="reviews">
      <div class="reviews_form">
        <p class="error hidden">You have to have bought this item before leaving a review on it!</p>
        <input type="text" id="review_content" placeholder="Leave a review here">
        <a href="#" class="btn" id="addReviewbtn" data-productid="<?php echo $product['id']; ?> ">Add review</a>
      </div>
    
      <ul class="reviews_list">
        <?php foreach($allReviews as $r): ?>
          <li><?php echo $r['content'] ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <!--<form action="" method="post">
    <input type="hidden" name="collectionId" value="<?php //echo $id ?>">
    <input class="btn btn--primary" name="btnAdd" type="submit" value="Add to cart">
    </form>-->
</div>
<script src="review.js"></script>
</body>
</html>