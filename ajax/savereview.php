<?php
namespace App\Accessorize;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once(__DIR__."/../classes/Review.php");

if(!empty($_POST)){

    error_log("POST data ontvangen: " . print_r($_POST, true)); // Log naar PHP-log


        $r = new Review();
        $r->setUserId(1); //$_SESSION
        $r->setProductId($_POST['productId']);
        $r->setContent($_POST['content']);

        $r->save();

        $response = [
            'status' => 'success',
            'body' => htmlspecialchars($r->getContent()),
            'message' => 'Review saved'
        ];

        header('Content-Type: application/json');
        echo json_encode($response); //json_encode zet array om naar json
} else {
    error_log("Lege POST data");
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
    exit;
}
?>