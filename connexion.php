<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Connexion</title>
</head>
<body>

   <?php require __DIR__ . "/includes/navbar.php" ?>

   <h1>Connexion</h1>
   <form action="includes/connexion.inc.php" method="POST">

      <?php if(isset($_GET["error"]) && $_GET["error"] === "credentials"): ?>
         <h2 style="color: red">Veuillez réessayer</h2>
      <?php endif ?>

      <div style="display: block;">
         <label for="login">Login</label>
         <input type="text" name="login" id="login">
      </div>

      <div style="display: block;">
         <label for="pass">Password</label>
         <input type="password" name="pass" id="pass">
      </div>

      <button type="submit">Se connecter</button>

   </form>
   
</body>
</html>