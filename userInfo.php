<?php
    include_once(__DIR__."/classes/Db.php");
    include_once(__DIR__."/classes/User.php"); 
    session_start();
    
    if($_SESSION['loggedin']!== true){
        header('Location: login.php');
    }
    else{
        $user = App\Accessorize\User::getUserByEmail($_SESSION['email']);
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($_SESSION['email']). ' details'?></title>
    <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
    <?php include_once("nav.inc.php") ?>
    <div class="profile">
        
        <div class="change_password">
            <form action="" method="post" class="new_product">
            <h3>Change password?</h3>

            <div>					
                <label for="Oldassword">Enter your current password</label>
				<input type="text" name="current_password">
							
                <label for="NewPassword">Enter your new password</label>
				<input type="text" name="new_password">
			
                <input type="submit" value="Change my password" class="changebtn">
            </div>
        </div>

            <!-- <div>
                <?php //if(isset($error)): ?> 
                    <div class="error">
                        <p class="error">
                            <?php //echo $error; ?>
                        </p>
                    </div>
                <?php //endif; ?>
            </div> -->
            

            
            <!-- <div>					
                <label for="category">Choose a category</label>
                <select name="category" id="category">
                    <option value="1">Earrings</option>
                    <option value="2">Rings</option>
                    <option value="3">Necklaces</option>
                    <option value="4">Bracelets</option>
                </select>
			</div> -->
    
            <div><?php echo $succes ?></div>
        </form>
            <br>
        <!-- <p>Change password (?)</p> -->
            <br>
        <!-- <p>Deactivate account (?)</p> -->
        <a href="logout.php" class="logoutbtn">Log out?</a>
    </div>
</body>
</html>