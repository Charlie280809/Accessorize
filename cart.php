<?php
    require_once __DIR__.'/bootstrap.php';
    use App\Accessorize\Product;
    use App\Accessorize\User;
    use App\Accessorize\Order;
    use App\Accessorize\OrderItem;
    
    if($_SESSION['role'] == 1){
        header('Location: index.php');
    } //admins don't have a cart
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // add products to cart
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $thumbnail = isset($_POST['thumbnail_url']) ? $_POST['thumbnail_url'] : ''; // Ensure thumbnail_url is set

        //if the item is already in the cart
        foreach ($_SESSION['cart'] as &$item) { //for all the items in the cart
            if ($item['id'] === $productId) { //if an item with the sam id is already in the cart
                $item['quantity'] += $quantity; //add another
                header('Location: cart.php');
                exit;
            }
        }

        //add new products to cart
        $_SESSION['cart'][] = [
            'id' => $productId,
            'name' => $productName,
            'price' => $price,
            'quantity' => $quantity,
        ];

        header('Location: cart.php');
        exit;
    }

    //remove products from cart
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action === 'remove') {
            $productId = $_POST['product_id'];
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] === $productId) {
                    unset($_SESSION['cart'][$key]);
                    header('Location: cart.php');
                    exit();
                }
            }
        }
    }

    //calculate total price
    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }

    $userCurrencyBalance = User::getUserByEmail($_SESSION['email'])['currency_balance'];
    if($userCurrencyBalance < $totalPrice){
        $error = true;
    }
?><!DOCTYPE html>
<lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>

    <div class="accessorize">
        <h1>Your Cart</h1>
        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty. Add some things on the <a href="index.php">homepage</a></p>
        <?php else: ?>
            <div class="cart">
                <div class="cart-header">
                    <div class="cart-column">Product</div>
                    <div class="cart-column">Price</div>
                    <div class="cart-column">Quantity</div>
                    <div class="cart-column">Subtotal</div>
                    <div class="cart-column">Remove items</div>
                </div>

                <div class="cart-body">
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <div class="cart-row">
                            <div class="cart-column"><?= htmlspecialchars($item['name']); ?></div>
                            <div class="cart-column">€<?= number_format($item['price'], 2); ?></div>
                            <div class="cart-column"><?= $item['quantity']; ?></div>
                            <div class="cart-column">€<?= number_format($item['price'] * $item['quantity'], 2); ?></div>
                            <div class="cart-column">
                                <a href="cart.php?action=remove&id=<?= $item['id']; ?>" class="remove-link">Remove</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="cart-footer">
                    <div class="cart-column cart-total-label" colspan="3">Total</div>
                    <div class="cart-column cart-total-value">€<?php echo isset($totalPrice) ? number_format($totalPrice, 2): '0.00'; ?></div>
                </div>
            </div>
            <form action="checkout.php" method="post">
                <button class="buyItemsbtn" type="submit" name="checkout">Buy all items in cart</button>
            </form>
            <?php if(isset($error)): //werkt nog niet ?>
                <p class="error">You do not have enough currency to buy these items.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>   
</body>
</html>