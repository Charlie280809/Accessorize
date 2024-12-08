<?php
  namespace App\Accessorize;
  require_once __DIR__.'/bootstrap.php';
  use App\Accessorize\User;
  $currentUser = User::getUserByEmail($_SESSION['email']);
  if($_SESSION['role'] == 0){
    $customer = true;
  }
?><nav class="navbar">
  <div class="navbar_top">
    <a href="index.php" class="logo"><img src="Moon_Logo.png" alt="logo"></a>
    <h2>Accessorize</h2>
    <div class="user_links">
      <p><a href="userInfo.php" >Go to profile [<?php echo $currentUser['username']; ?>]</a></p>
        
      <?php if($customer): //als de gebruiker geen admin is ?> 
        <p><?php echo 'Your balance: €'.htmlspecialchars($currentUser['currency_balance']); ?></p>
      <?php endif; ?>
      
      <?php if($customer): ?>
        <p><a href="cart.php" class="user_links">Cart🛒</a></p>
      <?php endif; ?>
      
      <div>
        <p><a href="logout.php" class="user_links">Logout</a></p>
      </div>
    </div>
  </div>

  <div class="navbar_bottom">
    <a href="index.php" class="navbar__link">Home</a>
    <a href="index.php?category=1" class="navbar__link">Earrings</a>
    <a href="index.php?category=2" class="navbar__link">Rings</a>
    <a href="index.php?category=3" class="navbar__link">Necklaces</a>
    <a href="index.php?category=4" class="navbar__link">Bracelets</a>
  </div>
</nav>