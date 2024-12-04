<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
    //make the cart an array
}

// Voeg een product toe aan de cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Controleer of het product al in de cart zit
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $productId) {
            $item['quantity'] += $quantity; // Aantal verhogen
            header('Location: cart.php');
            exit;
        }
    }

    // Voeg nieuw product toe
    $_SESSION['cart'][] = [
        'id' => $productId,
        'name' => $productName,
        'price' => $price,
        'quantity' => $quantity,
    ];

    header('Location: cart.php');
    exit;
}

// Verwijder een product uit de cart
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['id'])) {
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) {
        return $item['id'] !== $_GET['id'];
    });
    header('Location: cart.php');
    exit;
}

// Bereken totaalprijs
$totalPrice = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
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
    <h1>Your Cart</h1>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']); ?></td>
                        <td>€<?= number_format($item['price'], 2); ?></td>
                        <td><?= $item['quantity']; ?></td>
                        <td>€<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                        <td>
                            <a href="cart.php?action=remove&id=<?= $item['id']; ?>">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>€<?= number_format($totalPrice, 2); ?></td>
                </tr>
            </tfoot>
        </table>
        <form action="checkout.php" method="post">
            <button type="submit" name="checkout">Checkout</button>
        </form>
    <?php endif; ?>
</body>
</html>
