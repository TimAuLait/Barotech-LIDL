<?php

$user= 'root';
$password='';

try{
    $conn = new PDO('mysql:host=localhost;dbname=gsb_bdd;charset=utf8', $user, $password );
    // echo'Connexion réussi';
} catch(PDOException $e){
    die('Erreur: impossible de se connecter');
}

?>