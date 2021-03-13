<?php

$db = require __DIR__ . "/DBConnection.php";

$stmt = $db->prepare("SELECT * FROM ei2_utilisateurs WHERE login = ?");
$login = $_POST["login"];
$stmt->bindParam(1, $login);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$pass = $_POST["pass"];

if(password_verify($pass, $user["pass"])) {

   $stmt = $db->prepare("UPDATE ei2_utilisateurs SET derniere_connexion = ? WHERE login = ?");
   $login = $_POST["login"];
   $derniere_connexion = date("d/m/y H:i:s");
   $stmt->bindParam(1, $derniere_connexion);
   $stmt->bindParam(2, $login);
   $stmt->execute();

   session_start();
   $_SESSION["user"] = $login;
   $_SESSION["role"] = $user["droits"];
   header("Location: ../index.php");
} else {
   header("Location: ../connexion.php?error=credentials");
}

