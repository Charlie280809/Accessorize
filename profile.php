<?php
    session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessorize Profile</title>
    <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
    <?php include_once("nav.inc.php") ?>
    <div class="profile">
        <!-- <h2>Profile</h2> -->
        <h4>Hello there, <?php echo htmlspecialchars($_SESSION['email']);?>. You are an admin, which means you can create, update and delete your own products to the shop.</h4>
        <form action="" method="post" class="new_product">
            <div>					
                <label for="Title">Product title</label>
				<input type="text" name="title">
			</div>
            <div>					
                <label for="Price">Product price</label>
				<input type="text" name="price">
			</div>
            <div>					
                <label for="Email">E-mail</label>
                <!-- make dropdown -->
				<input type="dropdown" name="email">
                <option value="earrings">Earrings</option>
                <option value="rings">Rings</option>
                <option value="necklaces">Necklaces</option>
                <option value="bracelets">Bracelets</option>
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
                <label for="Stock_amount">How many do you have in stock? ()</label>
				<input type="text" name="stock_amount">
			</div>
            <div>
                <input type="submit" value="Add new product to shop" class="addbtn">
            </div>
        </form>
            <br>
        <p>Change password (?)</p>
            <br>
        <p>Deactivate account (?)</p>
        <a href="logout.php" class="logoutbtn">Log out?</a>
    </div>
</body>
</html>