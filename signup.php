<?php
    if(!empty($_POST)){ //als de POST niet leeg is, dus als er iets gesubmit is
        $email = $_POST['email'];
        $password = $_POST['password']; 

        $options = [
            'cost' => 15, 
        ];
        $hash = password_hash($password, PASSWORD_DEFAULT, $options); 
        
        $conn = new PDO('mysql:host=localhost;dbname=accessorize', 'root', password: 'root');
        $statement = $conn->prepare("INSERT INTO `users`(`email`, `password`) VALUES (:email, :password)"); //accounts toevoegen in de databank
        $statement->bindValue(":email", $email); 
        $statement->bindValue(":password", $hash);
        $statement->execute();
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up to Accessorize</title>
    <link rel="stylesheet" href="css/style_signup.css">
</head>
<body>
    <div class="form form_login">
        <form action="" method="post">
                      
            <h2>Sign up to Accessorize!</h2>

            <!-- <div>
                <p>
                    wachtwoord moet dit en dit en dit zijn..
                </p>
            </div> -->

            <div class="form_field">					
                <label for="Email">E-mail</label>
				<input type="text" name="email">
			</div>

			<div class="form_field">
				<label for="Password">Password</label>
				<input type="password" name="password">
			</div>

			<div class="form_field">
				<input type="submit" value="Sign in" class="btn_submit">	
			</div>

        </form>
    </div>
</body>
</html>