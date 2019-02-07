<?php
echo '<p id= "welcome"><a href="index.php">Camagru</a></p>
    <div class="header">
                            <ul class="menu">
                            <li class="dropdown"><span>Voir mon compte</span>
  <ul class="features-menu">' ?>
      <?php if ($_SESSION['logged_on_user'] != 1) : ?>
      <li><a href="login.php">Se connecter</a></li>
      <?php endif;?>
      <?php echo '<li><a href="my_account.php">Mon compte</a></li>' ?>
      <?php if ($_SESSION['logged_on_user'] == 1) : ?>
      <li><a href="user/logout_user.php">Se deconnecter</a></li>
      <?php endif;?>
 <?php echo '</ul>
</li>
<li class="dropdown"><span>Photos</span>
  <ul class="features-menu">
  <li><a href="galerie.php">Galerie</a></li>
  <li><a href="webcam.php">Webcam</a></li>
  </ul>
</li>
</ul>
<hr></div>';
?>