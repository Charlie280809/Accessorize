<nav class="navbar">
  <div class="navbar_top">
    <a href="index.php" class="logo"><img src="Moon_Logo.png" alt="logo"></a>
    <h2>Accessorize</h2>
    <div class="user_links">
      <div>
        <a href="userInfo.php" class="navbar__logout">Profile <?php echo $currentUser['username']; ?></a>
      </div>
      <?php if($_SESSION['role'] == 0): //als de gebruiker geen admin is ?> 
        <p><?php echo 'Your balance: €'.htmlspecialchars($_SESSION['currency_balance']); ?></p>
      <?php endif; ?>
      <div>
        <a href="cart.php" class="navbar__logout">Cart🛒</a>
      </div>
      <div>
        <a href="logout.php" class="navbar__logout">Logout</a>
      </div>
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