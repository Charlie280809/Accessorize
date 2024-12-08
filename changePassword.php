<?php
    namespace App\Accessorize;
    require_once __DIR__.'/bootstrap.php';
    use App\Accessorize\User;

    if($_SESSION['loggedin']!== true){
        header('Location: login.php');
    }
    else{
        $currentUser = User::getUserByEmail($_SESSION['email']); //get user by email
        
        if(!empty($_POST)){ //if the POST is not empty
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            if(empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                $error = "Please fill in all fields."; //check if fields are empty
            }elseif($newPassword !== $confirmPassword) {
                $error = "Your new passwords do not match."; //check if new passwords match
            }else{
                if (!password_verify($currentPassword, $currentUser['password'])) {
                    $error = "Your current password is incorrect."; //check if current password is correct
                } else {
                    $options = ['cost' => 12];
                    $hash = password_hash($newPassword, PASSWORD_DEFAULT, $options);
        
                    User::changePassword($_SESSION['email'], $hash);
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
    <title><?php echo $currentUser['username']. ' details'?></title>
    <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
    <?php include_once("nav.inc.php") ?>
    <div class="change_password">
        <form action="" method="post">
            <h3>Change password?</h3>
            
                <?php if(isset($error)): ?> 
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>
    
            <div><?php echo $succes ?></div>

            <div class="input">					
                <label for="Oldpassword">Enter your current password</label>
                <input type="text" name="current_password">
                            
                <label for="NewPassword">Enter your new password</label>
                <input type="text" name="new_password">

                <label for="confirmPassword">Enter your new password</label>
                <input type="text" name="confirm_password">
            
                <input type="submit" class="changePasswordBTN" value="Change my password" class="changebtn">
            </div>
        </form>
    </div>
</body>
</html>