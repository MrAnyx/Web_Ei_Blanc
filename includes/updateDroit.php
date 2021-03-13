<?php

$db = require __DIR__ . "/DBConnection.php";

sleep(2);

$stmt = $db->prepare("UPDATE ei2_utilisateurs SET droits = ? WHERE id = ?");
$droits = $_POST["droit"];
$id = $_POST["id"];
$stmt->bindParam(1, $droits);
$stmt->bindParam(2, $id);
$stmt->execute();

$stmt = $db->prepare("SELECT id, login, derniere_connexion, droits FROM ei2_utilisateurs");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


header("Content-Type: application/json");

echo json_encode($users);
