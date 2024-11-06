<?php 
    include_once(__DIR__."/classes/Db.php");   
    function canLogin($p_email, $p_password){
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

        //if(User::canLogin($email, $password)){  GO, maak sessie + redirect naar home  }
    }   

    if(!empty($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(canLogin($email, $password)){
            session_start();
            $_SESSION['loggedin'] = true;
            header('Location: index.php');
            echo "logged in.";
        }else{
            $error = true;
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Accessorize</title>
    <link rel="stylesheet" href="css/style_signup-login.css">
</head>
<body>
<div class="form_field">
        <form action="" method="post">

            <h2>Login to Accessorize</h2>
            
            <?php if(isset($error)): ?> 
                <div class="error">
                    <p>
                        Hmm, your e-mail or password must be wrong. Please try again.
                    </p>
                </div>
            <?php endif; ?>

            <div>					
                <label for="Email">E-mail</label>
				<input type="text" name="email">
			</div>

			<div>
				<label for="Password">Password</label>
				<input type="password" name="password">
			</div>

			<div>
				<input type="submit" value="Sign in" class="btn_submit">	
				<!-- <input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Remember me</label> -->
			</div>

            <p>Don't have an account yet? <a href="signup.php">Create one here!</a></p>

        </form>
    </div>
</body>
</html>