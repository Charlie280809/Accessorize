<?php
    namespace App\Accessorize;
    require_once __DIR__."./Db.php";
    class User {
        private $username; //gets created by user in signup
        private $email; //gets created by user in signup
        private $password; //gets created by user in signup
        private $currency_balance; //deze word automatisch op 1000 gezet
        private $street_number;
        private $street_name;
        private $postal_code;
        private $country;

        public function getUsername(){
            return $this->username;
        }
        public function setUsername($username){
            if(empty($username)){
                throw new \Exception("Please fill in a username.");
            }
            $this->username = $username;
            return $this;
        }
        
        public function getEmail(){
            return $this->email;
        }
        public function setEmail($email){
            if(empty($email)){
                throw new \Exception("Please fill in your email.");
            }
            $this->email = $email;
            return $this;
        }

        public function getPassword(){
            return $this->password;
        }
        public function setPassword($password){
            if(empty($password)){
                throw new \Exception("Please fill in a password.");
            }
            $options = [
                'cost' => 12, 
            ];
            $hash = password_hash($password, PASSWORD_DEFAULT, $options); 
            $this->password = $hash;
            return $this;
        }

        public function getCurrency_balance(){
            return $this->currency_balance;
        }
        public function setCurrency_balance($currency_balance){
            $this->currency_balance = $currency_balance;
            return $this;
        }

        public static function updateCurrencyBalance($new_balance, $userId){
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE users SET currency_balance = :currency_balance WHERE id = :id");
            $statement->bindValue(":currency_balance", $new_balance);
            $statement->bindValue(":id", $userId);
            $statement->execute();
        }

        public static function emailExists($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT COUNT(*) AS count FROM users WHERE email = :email");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            
            return $result['count'] > 0; //check if the email is already in use
        }

        public static function canLogin($p_email, $p_password){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM `users` WHERE `email` = :email");
            $statement->bindValue(":email", $p_email);
            $statement->execute();
    
            $user = $statement->fetch(\PDO::FETCH_ASSOC);
            if($user){ //if user is found in db
                $hash = $user['password']; //get hash from user from db
    
                if(password_verify($p_password, $hash)){
                     return true;//if p_password = hash, return true
                }else{
                     return false;
                }
            }else{ //if user isn't found in db
                return false;
            }
        }

        public static function getUserByEmail($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            
            return $result;
        }

        public static function changePassword($email, $new_password){
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE users SET password = :password WHERE email = :email");
            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", $new_password);
            $statement->execute();
        }

        public function save (){         
            $conn = Db::getConnection();

            if (self::emailExists($this->getEmail())) {
                throw new \Exception("This email address is already in use. Please use a different one.");
            }

            $statement = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password);"); 
            $statement->bindValue(":username", $this->getUsername());
            $statement->bindValue(":email", $this->getEmail()); 
            $statement->bindValue(":password", $this->getPassword());
            $result = $statement->execute();

            return $result;
        }
    }
?>