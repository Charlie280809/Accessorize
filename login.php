<?php
    namespace App\Accessorize;

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once __DIR__.'/classes/Db.php';
    require_once __DIR__.'/classes/User.php';

    if(!empty($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(User::canLogin($email, $password)){
            session_start(); //start session
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = User::getUserByEmail($email)['is_admin'];
            header('Location: index.php'); //go to index-page
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