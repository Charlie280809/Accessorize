<?php
    namespace App\Accessorize;
    include_once(__DIR__."/Db.php");
    
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
            $statement = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
            $statement->bindValue(":order_id", $this->getOrderId());
            $statement->bindValue(":product_id", $this->getProductId());
            $statement->bindValue(":quantity", $this->getQuantity());
            $statement->bindValue(":price", $this->getPrice());
            $statement->execute();
            $this->id = $conn->lastInsertId();
            return $this->id;
        }
    
        // public static function getItemsByOrderId($user_id) {
        //     $conn = Db::getConnection();
        //     $statement = $conn->prepare("SELECT * FROM order_items WHERE user_id = :user_id");
        //     $statement->bindValue(":user_id", $user_id);
        //     $statement->execute();
        //     return $statement->fetchAll(\PDO::FETCH_ASSOC);
        // }
    }
    
?>