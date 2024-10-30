<?php
    include_once(__DIR__."/Db.php");
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

        
    //     public function save (){         
    //         $conn = Db::getConnection();

    //         $statement = $conn->prepare("INSERT INTO users(username, email, password) VALUES (:username, :email, :password);"); //accounts toevoegen in de databank
    //         $statement->bindValue(":username", $this->getUsername());
    //         $statement->bindValue(":email", $this->getEmail()); 
    //         $statement->bindValue(":password", $this->getPassword());
    //         return $statement->execute();
    //     }

    // }


    public function save (){         
        $conn = Db::getConnection();
    
        $statement = $conn->prepare("INSERT INTO users(username, email, password) VALUES (:username, :email, :password);");
        $statement->bindValue(":username", $this->getUsername());
        $statement->bindValue(":email", $this->getEmail()); 
        $statement->bindValue(":password", $this->getPassword());
    
        if (!$statement->execute()) {
            throw new Exception("Failed to save user.");
        }
        return true;
    }
}
?>