<?php

$db = require __DIR__ . "/DBConnection.php";

$stmt = $db->prepare("INSERT INTO ei2_utilisateurs (login, pass, derniere_connexion, droits) VALUES (?, ?, ?, ?)");
$login = $_POST["login"];
$pass = password_hash($_POST["pass"], PASSWORD_BCRYPT);
$deriere_connexion = null;
$droits = "adherent";

$stmt->bindParam(1, $login);
$stmt->bindParam(2, $pass);
$stmt->bindParam(3, $deriere_connexion);
$stmt->bindParam(4, $droits);

$stmt->execute();

header("Location: ../connexion.php");


