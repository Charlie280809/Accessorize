<?php 
    namespace App\Accessorize;
    include_once(__DIR__."/Db.php");

    class Review{
        private $user_id;
        private $product_id;
        private $content;

        public function getUserId(){
            return $this->user_id;
        }
        public function setUserId($user_id){
            $this->user_id = $user_id;
            return $this;
        }

        public function getProductId(){
            return $this->product_id;
        }
        public function setProductId($product_id){
            $this->product_id = $product_id;
            return $this;
        }

        public function getContent(){
            return $this->content;
        }
        public function setContent($content){
            $this->content = $content;
            return $this;
        }

        public function save(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO reviews (user_id, product_id, content) VALUES (:user_id, :product_id, :content)");
            $statement->bindValue(":user_id", $this->getUserId());
            $statement->bindValue(":product_id", $this->getProductId());
            $statement->bindValue(":content", $this->getContent());
            
            $result = $statement->execute();
            return $result;
        }

        public static function getAllReviewsByProductId($product_id){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM reviews WHERE product_id = :product_id");
            $statement->bindValue(":product_id", $product_id);
            $statement->execute();
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>