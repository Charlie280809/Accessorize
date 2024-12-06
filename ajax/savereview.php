<?php
namespace App\Accessorize;

include_once(__DIR__."/../classes/Db.php");
include_once(__DIR__."/../classes/Review.php");
include_once(__DIR__."/../classes/User.php");
session_start();

if(!empty($_POST)){

    $currentUser = User::getUserByEmail($_SESSION['email']); //get 
    $userId = $currentUser['id'];

    $r = new Review();
    $r->setUserId($userId);
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