<?php
    session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessorize Profile</title>
    <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
    <?php include_once("nav.inc.php") ?>
    <div class="profile">
        <h2>Profile</h2>
        <h4>Hello there, <?php echo htmlspecialchars($_SESSION['email']);?>. You are an admin, that means you can also create, update and delete your own products.</h4>
        <p>testing testing testing...</p>

    </div>
    <a href="logout.php" class="logoutbtn">Log out?</a>
</body>
</html>