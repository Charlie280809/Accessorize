<?php
    namespace App\Accessorize;
    include_once("Db.php");
    class Product{
        private $id;
        private $title;
        private $price;
        private $category_id;
        private $description;
        private $color;
        private $stock_amount;
        private $created_by; /*NOG WERKENDE MAKEN*/
        private $thumbnail_url;
        private $img1_url;
        private $img2_url;

        public function getTitle(){
            return $this->title;
        }
        public function setTitle($title){
            if(empty((string)$title)){
                throw new \Exception("Please fill in a title for your product.");
            }
            $this->title = $title;
            return $this;
        }

        public function getPrice(){
            return $this->price;
        }
        public function setPrice($price){
            if(empty($price)){ //als de prijs leeg is
                throw new \Exception("Please fill in a price for your product.");
            }else if($price <= 0.00){ //als de prijs gelijk of kleiner is dan 0,00
                throw new \Exception("Your price can't be negative!");
            }
            $this->price = $price;
            return $this;
        }

        public function getCategory_id(){ /* MOET NOG FUNCTIONEEL GEMAAKT WORDEN */
            return $this->category_id;
        }
        public function setCategory_id($category_id){ /* || */
            
            $this->category_id = $category_id;
            return $this;
        }

        public function getDescription(){
            return $this->description;
        }
        public function setDescription($description){
            if(empty($description)){ //als de beschrijving leeg is
                throw new \Exception("Please fill in a description for your product.");
            }
            $this->description = $description;
            return $this;
        }

        public function getColor(){
            return $this->color;
        }
        public function setColor($color){
            if(empty($color)){
                throw new \Exception("Please fill in the color your product has.");
            }
            $this->color = $color;
            return $this;
        }

        public function getStock_amount(){
            return $this->stock_amount;
        }
        public function setStock_amount($stock_amount){
            if(empty($stock_amount)){
                throw new \Exception("Please fill in the product's stock amount.");
            }
            $this->stock_amount = $stock_amount;
            return $this;
        }

        public function getThumbnailURL(){
            return $this->thumbnail_url;
        }
        public function setThumbnailURL($thumbnail_url){
            if(empty($thumbnail_url)){ //als de beschrijving leeg is
                throw new \Exception("Please add photo for your product.");
            }
            $this->thumbnail_url = $thumbnail_url;
            return $this;
        }

        public function getImg1URL(){
            return $this->img1_url;
        }
        public function setImg1URL($img1_url){
            $this->img1_url = $img1_url;
            return $this;
        }

        public function getImg2URL(){
            return $this->img2_url;
        }
        public function setImg2URL($img2_url){
            $this->img2_url = $img2_url;
            return $this;
        }
        
        public function save(){
            $conn = Db::getConnection();
            $statement = $conn->prepare('INSERT INTO products (title, price, category_id, description, stock_amount, color, thumbnail_url, img1_url, img2_url) VALUES (:title, :price, :category_id, :description, :stock_amount, :color, :thumbnail_url, :img1_url, :img2_url)');
            $statement->bindParam(':title', $this->title);
            $statement->bindParam(':price', $this->price);
            $statement->bindParam(':category_id', $this->category_id);
            $statement->bindParam(':description', $this->description);
            $statement->bindParam(':stock_amount', $this->stock_amount);
            $statement->bindParam(':color', $this->color);
            $statement->bindParam(':thumbnail_url', $this->thumbnail_url);
            $statement->bindParam(':img1_url', $this->img1_url);
            $statement->bindParam(':img2_url', $this->img2_url);
            return $statement->execute();
        }

        public static function getAll(){
            $conn =  Db::getConnection();
            $statement = $conn->prepare('SELECT * FROM products');
            $statement->execute();
            $products = $statement->fetchALL(\PDO::FETCH_ASSOC);
            return $products;
        }

        public static function getByCategory($category_id){
            $conn = Db::getConnection();
            $statement = $conn->prepare('SELECT * FROM products WHERE category_id = :category_id');
            $statement->bindParam(':category_id', $category_id);
            $statement->execute();
            $products = $statement->fetchALL(\PDO::FETCH_ASSOC);
            return $products;
        }        
    }
?>