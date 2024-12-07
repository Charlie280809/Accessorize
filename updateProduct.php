<?php
    namespace App\Accessorize;
    require_once(__DIR__."./bootstrap.php");
    use App\Accessorize\Product;
    use App\Accessorize\User;
    use App\Accessorize\Review;
    use App\Accessorize\Db;
    use App\Accessorize\Cart;
    use App\Accessorize\Order;
    

    if($_SESSION['role'] == 1){ //if the user is an admin
        $product = Product::getProductById($_GET['id']); //get product
        $productId = $product['id'];
        var_dump($productId);
        if(!empty($_POST) && isset($_POST['update_product'])){ //if POST is not empty
            try{
                $product->setTitle($_POST['title']);
                $product->setPrice($_POST['price']);
                $product->setDescription($_POST['description']);
                $product->setStock_amount($_POST['stock_amount']);
                $product->updateById($productId);

                echo "Product updated!";
            }
            catch(\Exception $e){
                $error = $e->getMessage();
            }
        }

        // if(isset($_POST['delete_product'])){
        //     $product::deleteById($product['id']);
        //     echo 'product deleted';
        //     header('Location: index.php');
        // }
    }else{ //if the user is not an admin
        header('Location: index.php');
    }





?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update product</title>
</head>
<body>
    <h2>Update product</h2>
    <?php //if(isset($error)): ?>
        <p><?php //echo $error; ?></p>
    <?php //endif; ?>

    <?php //if(isset($succes)): ?>
        <p><?php //echo $succes; ?></p>
    <?php //endif; ?>

    <form method="POST">

        <div>
            <label for="Title">Product title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($product['title']) ?>">
        </div>
        <div>
            <label for="Price">Product price</label>
            <input type="text" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price']) ?>">
        </div>
        <div>
            <label for="Description">Product description</label>
            <input type="text" name="description" value="<?php echo htmlspecialchars($product['description']) ?>">
        </div>
        <div>
            <label for="Stock">Stock amount</label>
            <input type="text" name="stock_amount" value="<?php echo htmlspecialchars($product['stock_amount']) ?>">
        </div>

        <button type="submit" name="update_product">Update Product</button>
        <button type="submit" name="delete_product">Delete Product</button>
    </form>
</body>
</html>