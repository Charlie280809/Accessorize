<?php
namespace App\Accessorize;
    class Db{
        private static $conn = null;

        public static function getConnection(){
            if(self::$conn == null){
                echo "👾";
                self::$conn = new \PDO("mysql:host=localhost;dbname=accessorize","root","root");
                return self::$conn;
            }
            else{
               echo "❗";
                return self::$conn;
            }
        }
    }
?>