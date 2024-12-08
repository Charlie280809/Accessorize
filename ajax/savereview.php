<?php
    namespace App\Accessorize;
    require_once __DIR__.'./bootstrap.php';
    use App\Accessorize\Db;
    use App\Accessorize\Review;
    use App\Accessorize\User;

    if(!empty($_POST)) {
        try {
            $currentUser = User::getUserByEmail($_SESSION['email']);
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
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response); // JSON response terugsturen
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'No data received']);
        exit;
    }
?>