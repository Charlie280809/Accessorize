<nav class="navbar">
    <a href="index.php" class="logo">LOGO</a>
    <a href="index.php">Home</a>
    
    <form action="" method="get">
      <input type="text" name="search">
    </form>
    
    <a href="logout.php" class="navbar__logout">Hi USERNAMEE <?php //echo htmlspecialchars($_SESSION['email']); ?>, logout?</a>
</nav>