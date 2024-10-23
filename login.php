<?php 
    function canLogin($p_email, $p_password){
        $conn = new PDO('mysql:host=localhost;dbname=accessorize', 'root', 'root');
        $statement = $conn->prepare("SELECT * FROM `users` WHERE `email` = :email"); //preparen zodat men niet kan sjoemelen met die ':email'
		$statement->bindValue(':email', $p_email); //':email' binden aan $p_email
        $statement->execute();

        // $user = $statement->fetch(PDO::FETCH_ASSOC); //user linken met de databank
        // if($user){
		// 	$hash = $user['password']; //hash van user is password uit de databank

		// 	if(password_verify($p_password, $hash)){
		// 		return true;
		// 	}else{
		// 		return false;
		// 	}
		// }else{
		// 	//not found
		// 	return false;
		// }



        //if(User::canLogin($email, $password)){  GO, maak sessie + redirect naar home  }
    }   


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Accessorize</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
<div class="form form_login">
        <form action="" method="post">
            
            <!-- <//?php if(isset($error)): ?> als de variabele 'error' bestaat, voer code block uit
                <div class="error">
                    <p>
                        Hmm, your e-mail or password must be wrong. Please try again.
                    </p>
                </div>
            <//?php endif; ?> -->

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
				<!-- <input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Remember me</label> -->
			</div>

        </form>
    </div>
</body>
</html>