<?php
    include_once("Db.php");

    //::getAll --> om alle producten op de homepage te kunnen tonen
    //save();

class Product{
    public function save($title, $price){
        $conn = Db::getConnection();
        $statement = $conn->prepare('INSERT INTO products (title, price) VALUES (:title, :price)');
        $statement->bindParam(':title', $title);
        $statement->bindParam(':price', $price);
        $statement->execute();
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