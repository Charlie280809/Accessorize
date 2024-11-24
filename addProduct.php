<?php
include_once(__DIR__."/classes/Product.php");
    session_start();
    if(!empty($_POST)){ //als de POST niet leeg is, dus als er iets gesubmit is
        try{
            $product = new App\Accessorize\Product();
            $product->setTitle( $_POST['title']);
            $product->setPrice($_POST['price']);
            $product->setDescription($_POST['description']);
            $product->setCategory_id($_POST['category']);
            $product->setColor( $_POST['color']);
            $product->setStock_amount( $_POST['stock_amount']);
            $product->setThumbnailURL( $_POST['thumbnail_url']);
            $product->setImg1URL( $_POST['img1_url']);
            $product->setImg2URL( $_POST['img2_url']);
            
        //    $product->setKeywords($_POST['']);
            $product->save();
            $succes = "Product saved!";
        }
        catch(Exception $e){
            $error = $e->getMessage();
        }
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
    <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
    <?php include_once("nav.inc.php") ?>
    <div class="profile">
        
        <form action="" method="post" class="new_product">

            <div>
                <?php if(isset($error)): ?> 
                    <div class="error">
                        <p class="error">
                            <?php echo $error; ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <div>					
                <label for="Title">Product title</label>
				<input type="text" name="title">
			</div>
            <div>					
                <label for="Price">Product price</label>
				<input type="text" name="price">
			</div>
            <div>					
                <label for="category">Choose a category</label>
                <select name="category" id="category">
                    <option value="1">Earrings</option>
                    <option value="2">Rings</option>
                    <option value="3">Necklaces</option>
                    <option value="4">Bracelets</option>
                </select>
			</div>
            <div>					
                <label for="Description">Product description</label>
				<input type="text" name="description">
			</div>
            <div>					
                <label for="Color">Product color</label>
				<input type="text" name="color">
			</div>
            <div>					
                <label for="Stock_amount">How many do you have in stock? (Please insert a number)</label>
				<input type="text" name="stock_amount">
			</div>
            <div>
                <label for="Thumbnail">Add a thumbnail for your product.</label>
                <input type="text" name="thumbnail_url">
                <label for="IMG1">Add a second photo for your product. (Optional)</label>
                <input type="text" name="img1_url">
                <label for="IMG2">Add a third photo for your product. (Optional)</label>
                <input type="text" name="img2_url">
            </div>
            <div>
                <input type="submit" value="Add new product to shop" class="addbtn">
            </div>
            <div><?php echo $succes ?></div>
        </form>
            <br>
        <!-- <p>Change password (?)</p> -->
            <br>
        <!-- <p>Deactivate account (?)</p> -->
        <a href="logout.php" class="logoutbtn">Log out?</a>
    </div>
</body>
</html>