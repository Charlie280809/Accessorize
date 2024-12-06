<?php
  namespace App\Accessorize;
  session_start();
  include_once(__DIR__."/classes/Db.php");
  include_once(__DIR__."/classes/Review.php");
  include_once(__DIR__."/classes/User.php");

  if(!isset($_GET['id'])){ //als de variabele $_GET['id'] NIET bestaat
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

  $currentUser = User::getUserByEmail($_SESSION['email']);
  $userId = $currentUser['id'];
  if(Review::isVerifiedBuyer($userId, $_GET['id'])){ //user is verified to leave a review
    $showReviewInput = true;
  }


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
        <?php if($product['img1_url'] !== null): //if img1 exists ?>
          <img src="./images/<?php echo $product['img1_url'] ?>.png" alt=" <?php echo $product['title'] ?>" >
        <?php endif; ?>
        <?php if($product['img2_url'] !== null): //if img2 exists ?>
          <img src="./images/<?php echo $product['img2_url'] ?>.png" alt=" <?php echo $product['title'] ?>" >
        <?php endif; ?>
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

        <form class="addProductToCart" action="cart.php" method="post">
          <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
          <input type="hidden" name="product_name" value="<?php echo $product['title']; ?>">
          <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
          <label for="quantity">Quantity:</label>
          <input type="number" name="quantity" id="quantity" value="1" min="1">
          <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
      </div>
    </div>

    <div class="reviews">
      <div class="reviews_form">

        <?php if(isset($showReviewInput)): //only verified buyers can leave reviews ?>
          <input type="text" id="review_content" placeholder="Leave a review here">
          <a href="#" class="btn" id="addReviewbtn" data-productid="<?php echo $product['id']; ?> ">Add review</a>
        <?php else: ?>
         <p> <i>If you want to leave a review, you first have to buy the item</i>😉</p>
        <?php endif; ?>
      </div>
    
      <ul class="reviews_list">
        <?php foreach($allReviews as $r): ?>
          <li><?php echo $r['content'] ?></li>
        <?php endforeach; ?>
      </ul>
    </div> 
  </div>
</div>
<script src="review.js"></script>
</body>
</html>