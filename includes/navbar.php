<ul>
   <?php if(isset($_SESSION["user"])): ?>
      <li><a href="deconnexion.php">Déconnexion</a></li>
   <?php else: ?>
      <li><a href="inscription.php">Inscription</a></li>
      <li><a href="connexion.php">Connexion</a></li>
   <?php endif ?>

   <?php if(isset($_SESSION["user"]) && $_SESSION["role"] === "admin"): ?>
      <li><a href="dashboard.php">Dashboard</a></li>
   <?php endif ?>

</ul>