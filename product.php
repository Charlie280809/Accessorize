<?php
  require_once __DIR__."/bootstrap.php";
  use App\Accessorize\Db;
  use App\Accessorize\Product;
  use App\Accessorize\Review;
  use App\Accessorize\User;

  $product = App\Accessorize\Product::getProductById($_GET['id']);

  if(!isset($_GET['id']) == $product){
    exit("Product not found, go back to the <a href='index.php'>homepage</a>");
  }else{
    $allReviews = Review::getAllReviewsByProductId($_GET['id']);

    $currentUser = User::getUserByEmail($_SESSION['email']);
    $userId = $currentUser['id'];
    if(Review::isVerifiedBuyer($userId, $_GET['id'])){ //user is verified to leave a review
      $showReviewInput = true;
    }

    $customer = false;
    $admin = false;
    if($_SESSION['role'] == 1){ //if the user is an admin
      $admin = true;
    }
    if($_SESSION['role'] == 0){ //if the user is a customer
      $customer = true;
    }
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

        <?php if($customer): //only customers can add products to cart ?>
          <form class="addProductToCart" action="cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $product['title']; ?>">
            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1">
            <button class="addToCartbtn" type="submit" name="add_to_cart">Add to Cart</button>
          </form>
        <?php endif; ?>

        <?php if($admin): //only admins can update products ?>
          <a href="updateProduct.php?id=<?php echo $product['id']; ?>" class="updateProductbtn">Update product</a>
        <?php endif; ?>
      </div>
    </div>

    <div class="reviews">
      <div class="reviews_form">
        <h3>Reviews</h3>
        <?php if($customer && isset($showReviewInput)): //only verified buyers can leave reviews ?>
          <input type="text" id="review_content" placeholder="Leave a review here">
          <a href="#" id="addReviewbtn" data-productid="<?php echo $product['id']; ?> ">Add review</a>
        <?php elseif($customer): ?>
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