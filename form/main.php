<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css"> 
    <title>Page d'acceuil</title>
</head>
<body>
    <form method="post" action="conn.php">
        <h3>Connexion</h3>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button name="envoyer">Connexion</button>
        <button onClick="javascript:document.location.href='../index.php'">Retour</button>
    </form>
</styel>

        <?php

include 'db.php';
//Execution du code si on appuie sur 'envoyer'
if(isset($_POST['envoyer'])) {
   $email = $_POST['email'];
   $password =$_POST['password'];
   if(!empty($email) AND !empty($password)) {

      //Récupération des données de la table 'user'
      $r = "SELECT * FROM user WHERE mail = '$email' ";
      $req = $conn->prepare($r);
      $req->execute();
      $userinfo = $req->fetch();
      if($userinfo) {

         //Hashage de mots de passe
         $passwordHash = $userinfo['Mdp'];
         //echo $password." ".$passwordHash;

         //Vérification du mots de passe hashé
         if(password_verify($password, $passwordHash)){

            //Création de la SESSION
            // $_SESSION['id'] = $userinfo['ID_User'];
            // $_SESSION['nom'] = $userinfo['Nom'];
            // $_SESSION['prenom'] = $userinfo['Prenom'];
            // $_SESSION['email'] = $userinfo['Mail'];
            // $_SESSION['id_role'] = $userinfo['adresse'];


            header("Location: ../index.php?id=".$_SESSION['id']);
         }else{
             echo "<label>Mauvais email ou mot de passe !</label>";
         }
      } else {
         echo "impossible de se connecter";
      }

   } else {
      echo "Tous les champs doivent être complétés !";
   }
}
?>    
    </form>
</body>
</html>