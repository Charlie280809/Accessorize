<?php
    namespace App\Accessorize;
    include_once(__DIR__."/Db.php");
    
    class orderItem {
        private $order_id;
        private $product_id;
        private $quantity;
        private $price;
    
        public function __construct($order_id, $product_id, $quantity, $price) {
            $this->order_id = $order_id;
            $this->product_id = $product_id;
            $this->quantity = $quantity;
            $this->price = $price;
        }
    
        public function save() {
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
            $statement->bindValue(":order_id", $this->order_id);
            $statement->bindValue(":product_id", $this->product_id);
            $statement->bindValue(":quantity", $this->quantity);
            $statement->bindValue(":price", $this->price);
            $statement->execute();
        }
    
        public static function getItemsByOrderId($order_id) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM order_items WHERE order_id = :order_id");
            $statement->bindValue(":order_id", $order_id);
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
    
?>