<nav class="navbar">
  <div class="navbar_top">
    <a href="index.php" class="logo"><img src="moon_logo.pdf" alt="logo"></a>
    <h2>Accessorize</h2>
    <a href="logout.php" class="navbar__logout">Hey <?php echo htmlspecialchars($_SESSION['email']); ?>, logout?</a>
  </div>

  <div class="navbar_bottom">
    <a href="index.php" class="navbar__link">Home</a>
    <a href="product.php" class="navbar__link">Earrings</a>
    <a href="cart.php" class="navbar__link">Rings</a>
    <a href="cart.php" class="navbar__link">Necklaces</a>
    <a href="cart.php" class="navbar__link">Bracelets</a>
  </div>
</nav>