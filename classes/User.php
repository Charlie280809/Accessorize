<?php
    namespace App\Accessorize;
    include_once("/classes/Db.php");
    abstract class User { //implements Interfaces\iUser --> nog toevoegen
        protected $id; //automatisch gegenereerd
        protected $username; //deze word ingevuld door de gebruiker zelf in de signup
        protected $email; //deze word ingevuld door de gebruiker zelf in de signup
        protected $password; //deze word ingevuld door de gebruiker zelf in de signup
        protected $created_at;
        protected $updated_at;
        protected $active = 1; //standaard op 1 (als de gebruiker zich afmeld/het account verwijderd, dan wordt deze 0)
        protected $street_number;
        protected $street_name;
        protected $postal_code;
        protected $country;


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
                'cost' => 10, 
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
    
            $user = $statement->fetch(PDO::FETCH_ASSOC); //user linken met de databank
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
            $conn = \App\Accessorize\Db::getConnection();

            $statement = $conn->prepare("INSERT INTO users(username, email, password, is_admin, currency_balance, active) VALUES (:username, :email, :password, :is_admin, 1000, 1);"); //accounts toevoegen in de databank
            $statement->bindValue(":username", $this->getUsername());
            $statement->bindValue(":email", $this->getEmail()); 
            $statement->bindValue(":password", $this->getPassword());
            $statement->bindValue(":is_admin", $this->getIs_admin(), \PDO::PARAM_INT);

            return $statement->execute();

            if (!$statement->execute()) {
                $errorInfo = $statement->errorInfo();
                throw new Exception("Failed to save user: " . $errorInfo[2]);
            }
        }
}
?>