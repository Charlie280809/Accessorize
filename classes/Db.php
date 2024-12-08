<?php

    namespace App\Accessorize;

    class Db {
        private static $conn;
        const SETTINGS = [
            "user" => "root", 
            "password" => "vXFrGMoRTCLUzDsRsqCIZZkVoqSpreNi", 
            "host" => "autorack.proxy.rlwy.net:40269/railway", 
            "db" => "railway",
            "ssl_ca" => __DIR__ . "./cacert.pem"
        ];


        public static function getConnection(){
        if (self::$conn === null) {
            $options = [
                \PDO::MYSQL_ATTR_SSL_CA => self::SETTINGS['ssl_ca'],
                \PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false // For testing purposes only
            ];
            try {
                self::$conn = new \PDO(
                    "mysql:host=".self::SETTINGS["host"].";dbname=".self::SETTINGS["db"],
                    self::SETTINGS["user"],
                    self::SETTINGS["password"],
                    $options
                );
            } catch (\PDOException $e) {
                // Handle the exception (e.g., log the error, rethrow, etc.)
                throw new \Exception("Database connection error: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
    }

//via localhost/phpmyadmin
// namespace App\Accessorize;
//     class Db{
//         private static $conn = null;

//         public static function getConnection(){
//             if(self::$conn == null){
//                 echo "👾";
//                 self::$conn = new \PDO("mysql:host=localhost;dbname=accessorize","root","root");
//                 return self::$conn;
//             }
//             else{
//                echo "❗";
//                 return self::$conn;
//             }
//         }
//     }




//via Azure
    // namespace App\Accessorize;
    // class Db{
    //     private static $conn;
    //     const SETTINGS = [
    //         "user" => "accessorizeCharlieVBE",
    //         "password" => "TvRgb4yURr.b-7B",
    //         "host" => "accessorize.mysql.database.azure.com",
    //         "db" => "accessorize",
    //         "ssl_ca" => __DIR__ . "./cacert.pem"

    //     ];
    //     public static function getConnection(){
    //         if(self::$conn == null){
    //             $options[\PDO::MYSQL_ATTR_SSL_CA] = self::SETTINGS['ssl_ca'];
    //                 self::$conn = new \PDO('mysql:host='.self::SETTINGS["host"].';dbname='.self::SETTINGS["db"].'',self::SETTINGS["user"],self::SETTINGS["password"], $options);
    //             return self::$conn;
    //         }
    //         else{
    //             return self::$conn;
    //         }
    //     }
    // }
?>