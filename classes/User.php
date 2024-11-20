<?php
    namespace App\Accessorize;
    include_once("/classes/Db.php");
    class User { //implements Interfaces\iUser
        private $id; //automatisch gegenereerd
        private $username; //deze word ingevuld door de gebruiker zelf in de signup
        private $email; //deze word ingevuld door de gebruiker zelf in de signup
        private $password; //deze word ingevuld door de gebruiker zelf in de signup
        private $is_admin; //deze word automatisch op 0 gezet, tenzij de gebruiker een admin is
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

        public function save (){         
            $conn = Db::getConnection();

            $statement = $conn->prepare("INSERT INTO users(username, email, password, currency_balance, active) VALUES (:username, :email, :password, 1000, 1);"); //accounts toevoegen in de databank
            $statement->bindValue(":username", $this->getUsername());
            $statement->bindValue(":email", $this->getEmail()); 
            $statement->bindValue(":password", $this->getPassword());
            // $statement->bindValue(":is_admin", $this->getIs_admin(), \PDO::PARAM_INT);

            $result = $statement->execute();
            return $result;

            // if (!$statement->execute()) {
            //     $errorInfo = $statement->errorInfo();
            //     throw new Exception("Failed to save user: " . $errorInfo[2]);
            // }
        }

        public static function getUserByEmail($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindValue(":email", $email);
            $statement->execute();
            
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            
            return $result;
        }
}
?>