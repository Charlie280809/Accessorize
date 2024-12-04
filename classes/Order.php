<?php
    namespace App\Accessorize;
    include_once(__DIR__."/Db.php");

    class Order {
        private $id;
        private $user_id;
        private $order_date;
        private $total_price;
    
        public function __construct($user_id, $total_price) {
            $this->user_id = $user_id;
            $this->order_date = date("Y-m-d H:i:s");
            $this->total_price = $total_price;
        }
    
        public function save() {
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO orders (user_id, order_date, total_price) VALUES (:user_id, :order_date, :total_price)");
            $statement->bindValue(":user_id", $this->user_id);
            $statement->bindValue(":order_date", $this->order_date);
            $statement->bindValue(":total_price", $this->total_price);
            $statement->execute();
            $this->id = $conn->lastInsertId(); // Bewaar het order-ID
            return $this->id;
        }
    
        public static function getOrdersByUserId($user_id) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM orders WHERE user_id = :user_id");
            $statement->bindValue(":user_id", $user_id);
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>