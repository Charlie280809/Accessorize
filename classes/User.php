<?php
    namespace App\Accessorize;
    include_once(__DIR__."/Db.php");
    class User { //implements Interfaces\iUser
        private $id; //automatisch gegenereerd
        private $username; //deze word ingevuld door de gebruiker zelf in de signup
        private $email; //deze word ingevuld door de gebruiker zelf in de signup
        private $password; //deze word ingevuld door de gebruiker zelf in de signup
        private $is_admin; //deze word automatisch op 0 gezet, tenzij de gebruiker een admin is
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
        public static function getCurrencyBalanceByEmail($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT currency_balance FROM users WHERE email = :email");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $result = $statement->fetch(\PDO::FETCH_ASSOC);

            return $result['currency_balance'];
        }

        public function save (){         
            $conn = Db::getConnection();

            $statement = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password);"); 
            $statement->bindValue(":username", $this->getUsername());
            $statement->bindValue(":email", $this->getEmail()); 
            $statement->bindValue(":password", $this->getPassword());

            $result = $statement->execute();
            return $result;
        }

        public static function canLogin($p_email, $p_password){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM `users` WHERE `email` = :email"); //preparen zodat men niet kan sjoemelen met die ':email'
            $statement->bindValue(":email", $p_email); //':email' binden aan $p_email
            $statement->execute();
    
            $user = $statement->fetch(\PDO::FETCH_ASSOC); //user linken met de databank
            if($user){ //als de user gevonden is in de databank 
                $hash = $user['password']; //hash van user is password uit de databank
    
                if(password_verify($p_password, $hash)){
                    //als $p_password gelijk is aan $hash
                     return true;
                }else{
                     return false;
                }
            }else{
                //not found
                return false;
            }
        }

        public static function getRole($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT is_admin FROM users WHERE email = :email");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            
            return $result['is_admin'];
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
}
?>