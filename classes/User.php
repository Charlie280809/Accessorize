<?php
    include_once("Db.php");
    class User{
        private $id; //automatisch gegenereerd
        private $username; //deze word ingevuld door de gebruiker zelf in de signup
        private $email; //deze word ingevuld door de gebruiker zelf in de signup
        private $password; //deze word ingevuld door de gebruiker zelf in de signup
        private $is_admin; //deze word ingevuld door de gebruiker zelf in de signup
        private $currency_balance;
        private $created_at;
        private $updated_at;
        private $active = 1; //standaard op 1 (als de gebruiker zich afmeld/het account verwijderd, dan wordt deze 0)
        private $street_number;
        private $street_name;
        private $postal_code;
        private $country;


        public function getUsername(){
            return $this->username;
        }
        public function setUsername($username){
            if(empty($username)){
                throw new Exception("Please fill in a username.");
            }
            $this->username = $username;
            return $this;
        }
        public function getEmail(){
            return $this->email;
        }
        public function setEmail($email){
            if(empty($email)){
                throw new Exception("Please fill in your email.");
            }
            $this->email = $email;
            return $this;
        }

        public function getPassword(){
            return $this->password;
        }
        public function setPassword($password){
            if(empty($password)){
                throw new Exception("Please fill in a password.");
            }

            $options = [
                'cost' => 10, 
            ];
            $hash = password_hash($password, PASSWORD_DEFAULT, $options); 

            $this->password = $hash;
            return $this;
        }

        public function getIs_admin(){
                return $this->is_admin;
        }
        public function setIs_admin($is_admin){
            $this->is_admin = $is_admin;
            if($is_admin ==='on'){
                $this->is_admin = 1;
            }else{
                $this->is_admin = 0;
            }
        }

        
        public function save (){         
            $conn = Db::getConnection();

            $statement = $conn->prepare("INSERT INTO users(username, email, password, is_admin, currency_balance, active) VALUES (:username, :email, :password, :is_admin, 1000, 1);"); //accounts toevoegen in de databank
            $statement->bindValue(":username", $this->getUsername());
            $statement->bindValue(":email", $this->getEmail()); 
            $statement->bindValue(":password", $this->getPassword());
            $statement->bindValue(":is_admin", $this->getIs_admin(), PDO::PARAM_INT);

            return $statement->execute();

            if (!$statement->execute()) {
                $errorInfo = $statement->errorInfo();
                throw new Exception("Failed to save user: " . $errorInfo[2]);
            }
        }
}
?>