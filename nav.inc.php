<nav class="navbar">
  <div class="navbar_top">
    <a href="index.php" class="logo"><img src="Moon_Logo.png" alt="logo"></a>
    <h2>Accessorize</h2>
    <a href="logout.php" class="navbar__logout">Hello <?php echo htmlspecialchars($_SESSION['email']);?>!</a>
  </div>

  <div class="navbar_bottom">
    <a href="index.php" class="navbar__link">Home</a>
    <a href="#" class="navbar__link">Earrings</a>
    <a href="#" class="navbar__link">Rings</a>
    <a href="#" class="navbar__link">Necklaces</a>
    <a href="#" class="navbar__link">Bracelets</a>
    <form class="search" action="" method="get">
      <input type="text" name="search" placeholder="Looking for something?">
    </form>
  </div>
</nav>