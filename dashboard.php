<?php
session_start();
if($_SESSION["role"] !== "admin") {
   header("Location: index.php");
}

$db = require __DIR__ . "/includes/DBConnection.php";

$stmt = $db->prepare("SELECT id, login, derniere_connexion, droits FROM ei2_utilisateurs");
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>Admin Dashboard</title>
</head>
<body>

   <?php require __DIR__ . "/includes/navbar.php" ?>

   <table>
      <thead>
         <td>Login</td>
         <td>Dernière connexion</td>
         <td>Droits</td>
         <td>Options</td>
      </thead>
      <tbody id="table-body">

         <?php foreach($users as $user) :?>
            <tr id="tr_<?= $user["id"] ?>">
               <td><?= $user["login"] ?></td>
               <td><?= $user["derniere_connexion"] ?></td>
               <td><?= $user["droits"] ?></td>
               <?php if($_SESSION["user"] !== $user["login"]): ?>
                  <td>
                     <?php if($user["droits"] === "admin"): ?>
                        <button onclick="updateDroits(<?= $user['id'] ?>, 'adherent')">Adherent</button>
                     <?php else: ?>
                        <button onclick="updateDroits(<?= $user['id'] ?>, 'admin')">Admin</button>
                     <?php endif ?>

                  </td>
               <?php endif ?>
            </tr>
         <?php endforeach ?>
      </tbody>
   </table>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script>

function updateDroits(idUser, droit) {
   document.getElementById(`tr_${idUser}`).style.backgroundColor = "yellow"
   $.post("includes/updateDroit.php",{
      id: idUser,
      droit: droit
   }, function (data, status) {
      tableBody = document.getElementById("table-body")
      let newTable = "";
      data.forEach(function(user) {
         newTable += `<tr id=\"tr_${user['id']}\">`
         newTable += `<td>${user["login"]}</td>`
         newTable += `<td>${user["derniere_connexion"] === null ? '' : user["derniere_connexion"]}</td>`
         newTable += `<td>${user["droits"]}</td>`
         if(user["login"] !== '<?= $_SESSION["user"] ?>') {
            if(user["droits"] === "admin") {
               newTable += `<td><button onclick="updateDroits(${user["id"]}, 'adherent')">Adherent</button></td>`
            }  else {
               newTable += `<td><button onclick="updateDroits(${user["id"]}, 'admin')">Admin</button></td>`
            }
         }
         newTable += "</tr>"
      })

      tableBody.innerHTML = newTable

   });
}

</script>

</html>