<?php
include_once(__DIR__."/classes/User.php");

    if(!empty($_POST)){ //als de POST niet leeg is, dus als er iets gesubmit is
        try{
            $user = new User();
            $user->setUsername($_POST['username']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setIs_admin($_POST['admin']??'');
            $user->save();
            
            $succes = "User saved";
        }
        catch(Exception $e){
            $error = $e->getMessage();
        }
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up to Accessorize</title>
    <link rel="stylesheet" href="css/style_signup-login.css">
</head>
<body>
    <div class="form_field">
        <form action="" method="post">
                      
            <h2>Sign up to Accessorize!</h2>

            <div>
                <?php if(isset($error)): ?> 
                    <div class="error">
                        <p class="error">
                            <?php echo $error; ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <div>					
                <label for="Username">Username</label>
				<input type="text" name="username">
			</div>

            <div>					
                <label for="Email">E-mail</label>
				<input type="text" name="email">
			</div>

			<div>
				<label for="Password">Password</label>
				<input type="password" name="password">
			</div>

            <div class="admin">
                <label for="Admin">Do you want to be an admin?</label>
                <input type="checkbox" name="admin" title="Being an admin allows you to add, update and delete your own products to the shop.">
            </div>

			<div>
				<input type="submit" value="Sign up" class="btn_submit">	
			</div>

            <p>Already have an account? <a href="login.php">Login here!</a></p>

        </form>
    </div>
</body>
</html>