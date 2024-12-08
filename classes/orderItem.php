<?php
    namespace App\Accessorize;
    require_once __DIR__."/Db.php";
    
    class orderItem {
        private $id;
        private $order_id;
        private $product_id;
        private $quantity;
        private $price;

        public function getId(){
            return $this->id;
        }

        public function getOrderId(){
            return $this->order_id;
        }
        public function setOrderId($order_id){
            $this->order_id = $order_id;
            return $this;
        }

        public function getProductId(){
            return $this->product_id;
        }
        public function setProductId($product_id){
            $this->product_id = $product_id;
            return $this;
        }

        public function getQuantity(){
            return $this->quantity;
        }
        public function setQuantity($quantity){
            $this->quantity = $quantity;
            return $this;
        }

        public function getPrice(){
            return $this->price;
        }
        public function setPrice($price){
            $this->price = $price;
            return $this;
        }
    
        public function save() {
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)");
            $statement->bindValue(":order_id", $this->getOrderId());
            $statement->bindValue(":product_id", $this->getProductId());
            $statement->bindValue(":quantity", $this->getQuantity());
            $statement->execute();
            $this->id = $conn->lastInsertId();
            return $this->id;
        }

        public static function getItemsWithProductDetailsByOrderId($order_id) {
            $conn = Db::getConnection();
            // link order_items to products
            $statement = $conn->prepare("
                SELECT oi.quantity, p.title, p.price 
                FROM order_items AS oi
                INNER JOIN products AS p ON oi.product_id = p.id
                WHERE oi.order_id = :order_id
            ");
            $statement->bindValue(":order_id", $order_id);
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>