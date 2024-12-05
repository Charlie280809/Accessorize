<?php
    namespace App\Accessorize;
    include_once(__DIR__."/Db.php");

    class Order {
        private $id;
        private $user_id;
        private $total_price;

        public function getId(){
            return $this->id;
        }

        public function getUserId(){
            return $this->user_id;
        }
        public function setUserId($user_id){
            $this->user_id = $user_id;
            return $this;
        }

        public function getTotalPrice(){
            return $this->total_price;
        }
        public function setTotalPrice($total_price){
            $this->total_price = $total_price;
            return $this;
        }
    
        public function save() {
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO orders (user_id, total_price) VALUES (:user_id, :total_price)");
            $statement->bindValue(":user_id", $this->getUserId());
            $statement->bindValue(":total_price", $this->getTotalPrice());
            $statement->execute();
            $this->id = $conn->lastInsertId();
            return $this->id;
        }
    
        // public static function getOrdersByUserId($user_id) {
        //     $conn = Db::getConnection();
        //     $statement = $conn->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        //     $statement->bindValue(":user_id", $user_id);
        //     $statement->execute();
        //     return $statement->fetchAll(\PDO::FETCH_ASSOC);
        // }
    }
?>