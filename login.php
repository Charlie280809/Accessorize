<?php
    namespace App\Accessorize;
    require_once __DIR__.'./bootstrap.php';
    use App\Accessorize\User;

    if(!empty($_POST)){ //als er iets in de post zit
        $email = $_POST['email']; //de waarde van het email-inputveld
        $password = $_POST['password']; //de waarde van het password-inputveld

        if(User::canLogin($email, $password)){
            session_start(); //sessie wordt gestart
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = User::getUserByEmail($email)['is_admin'];
            header('Location: index.php'); //doorverwijzing naar de indexpagina
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
                    <p class="error">
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
			</div>

            <p>Don't have an account yet? <a href="signup.php">Create one here!</a></p>

        </form>
    </div>
</body>
</html>