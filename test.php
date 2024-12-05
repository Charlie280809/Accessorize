<?php
    namespace App\Accessorize;
    require_once __DIR__.'/vendor/autoload.php';
    require_once __DIR__.'classes/Db.php';
    require_once __DIR__.'classes/Order.php';
    
    $conn = Db::getConnection();
    $statment = $conn->prepare("SELECT * FROM users");
    $statment->execute();

    var_dump($statment->fetchAll());
?>

 <!-- <table border="1">
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
            <?php // foreach ($_SESSION['cart'] as $item): ?>
                    <tr>
                        <td><?= //htmlspecialchars($item['name']); ?></td>
                        <td>€<?= //number_format($item['price'], 2); ?></td>
                        <td><?=  //$item['quantity']; ?></td>
                        <td>€<?=  //number_format($item['price'] * $item['quantity'], 2); ?></td>
                        <td>
                            <a href="cart.php?action=remove&id=<?= // $item['id']; ?>">Remove</a>
                        </td>
                    </tr>
                <?php // endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>€<?= // number_format($totalPrice, 2); ?></td>
                </tr>
            </tfoot>
        </table> -->