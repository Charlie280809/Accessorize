<nav class="navbar">
  <div class="navbar_top">
    <a href="index.php" class="logo"><img src="Moon_Logo.png" alt="logo"></a>
    <h2>Accessorize</h2>
    <div>
      <a href="logout.php" class="navbar__logout">Hello <?php echo htmlspecialchars($_SESSION['email']);?>!</a>
      <?php if($_SESSION['role'] == 0): ?> 
        <p><?php echo 'Your balance: €'.htmlspecialchars($_SESSION['currency_balance']); ?></p>
      <?php endif; ?>
    </div>
  </div>

  <div class="navbar_bottom">
    <a href="index.php" class="navbar__link">Home</a>
    <a href="index.php?category=1" class="navbar__link">Earrings</a>
    <a href="index.php?category=2" class="navbar__link">Rings</a>
    <a href="index.php?category=3" class="navbar__link">Necklaces</a>
    <a href="index.php?category=4" class="navbar__link">Bracelets</a>
    <form class="search" action="" method="get">
      <input type="text" name="search" placeholder="Looking for something?">
    </form>
  </div>
</nav>