<?php
    include_once(__DIR__."/classes/Db.php");
    include_once(__DIR__."/classes/User.php"); 
    session_start();
    
    if($_SESSION['loggedin']!== true){
        header('Location: login.php');
    }
    else{
        $user = App\Accessorize\User::getUserByEmail($_SESSION['email']);
        
        if(!empty($_POST)){
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            if(empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                $error = "Please fill in all fields.";
            }elseif($newPassword !== $confirmPassword) {
                $error = "Your new passwords do not match.";
            }else{
                if (!password_verify($currentPassword, $user['password'])) {
                    $error = "Your current password is incorrect.";
                } else {
                    $options = ['cost' => 12];
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT, $options);
        
                    App\Accessorize\User::changePassword($_SESSION['email'], $hashedPassword);
                    $succes = "New password saved!";
                }
            }
        }        
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $user['username']. ' details'?></title>
    <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
    <?php include_once("nav.inc.php") ?>
    <div class="profile">
        
        <div class="change_password">
            <form action="" method="post">
            <h3>Change password?</h3>
            
                <?php if(isset($error)): ?> 
                    <div class="error">
                        <p class="error">
                            <?php echo $error; ?>
                        </p>
                    </div>
                <?php endif; ?>
    
            <div><?php echo $succes ?></div>

            <div>					
                <label for="Oldpassword">Enter your current password</label>
				<input type="text" name="current_password">
							
                <label for="NewPassword">Enter your new password</label>
				<input type="text" name="new_password">

                <label for="confirmPassword">Enter your new password</label>
				<input type="text" name="confirm_password">
			
                <input type="submit" value="Change my password" class="changebtn">
            </div>
        </div>

            
        </form>
            <br>
        <!-- <p>Change password (?)</p> -->
            <br>
        <!-- <p>Deactivate account (?)</p> -->
        <a href="logout.php" class="logoutbtn">Log out?</a>
    </div>
</body>
</html>