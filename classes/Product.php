<?php
    include_once("Db.php");
class Product{
    private $id;
    private $title;
    private $price;
    private $category_id;
    private $description;
    private $color;
    private $stock_amount;

    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        if(empty((string)$title)){
            throw new Exception("Please fill in a title for your product.");
        }
        $this->title = $title;
        return $this;
    }

    public function getPrice(){
        return $this->price;
    }
    public function setPrice($price){
        if(empty($price)){ //als de prijs leeg is
            throw new Exception("Please fill in a price for your product.");
        }else if($price <= 0.00){ //als de prijs gelijk of kleiner is dan 0,00
            throw new Exception("Your price can't be negative!");
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
            throw new Exception("Please fill in a description for you product.");
        }
        $this->description = $description;
        return $this;
    }

    public function getColor(){
        return $this->color;
    }
    public function setColor($color){
        if(empty($color)){
            throw new Exception("Please fill in the color your product has.");
        }
        $this->color = $color;
        return $this;
    }

    public function getStock_amount(){
        return $this->stock_amount;
    }
    public function setStock_amount($stock_amount){
        if(empty($stock_amount)){
            throw new Exception("Please fill in the product's stock amount.");
        }
        $this->stock_amount = $stock_amount;
        return $this;
    }  
    
    public function save(){
        $conn = Db::getConnection();
        $statement = $conn->prepare('INSERT INTO products (title, price, description, stock_amount, color) VALUES (:title, :price, :description, :stock_amount, :color)');
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':price', $this->price);

        $statement->bindParam(':description', $this->description);
        $statement->bindParam(':stock_amount', $this->stock_amount);
        $statement->bindParam(':color', $this->color);
        return $statement->execute();
    }

    public static function getAll(){
        $conn = Db::getConnection();
        $statement = $conn->prepare('SELECT * FROM products');
        $statement->execute();
        $products = $statement->fetchALL(PDO::FETCH_ASSOC);
        return $products;
    }
} 
?>