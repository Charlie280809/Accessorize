<?php
    namespace App\Accessorize;
    class Db{
        private static $conn;
        const SETTINGS = [
            "user" => "accessorizeCharlieVBE",
            "password" => "TvRgb4yURr.b-7B",
            "host" => "accessorize.mysql.database.azure.com",
            "db" => "accessorize",
            "ssl_ca" => __DIR__ . "./cacert.pem"

        ];
        public static function getConnection(){
            if(self::$conn == null){
                $options[\PDO::MYSQL_ATTR_SSL_CA] = self::SETTINGS['ssl_ca'];
                    self::$conn = new \PDO('mysql:host='.self::SETTINGS["host"].';dbname='.self::SETTINGS["db"].'',self::SETTINGS["user"],self::SETTINGS["password"], $options);
                return self::$conn;
            }
            else{
                return self::$conn;
            }
        }
    }
?>