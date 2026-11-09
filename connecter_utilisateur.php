<?php

session_start();//demarrer session pour garder la cnnx de l user
require_once("connexion.php");  //inclut le fichier et utiliser $pdo

//recuperer les infos
$login = $_POST['login'];
$mdp = $_POST['mdp'];

$sql = "SELECT * FROM utilisateur WHERE login=? AND mdp=?";


$stmt = $pdo->prepare($sql);//sécuriser la requête et éviter les attaques SQL
$stmt->execute([$login, $mdp]);//Remplace les ? par les vraies valeurs et lance la requête

$user = $stmt->fetch();//recupere resultat

if($user){ //si trouvé
//memoriser l user dans tous les pages
    $_SESSION['user'] = $user['id_user'];
    $_SESSION['login'] = $user['login'];

    header("Location: afficher_evenements.php");//rediriger ver 
    exit;

}else{

    header("Location: login.php?erreur=1"); //retourne vers login.php
    exit; //arreter de s'exécuter après la redirection.
}

?>

//Cette page ne s'affiche pas à l'écran.

Son rôle est de :

recevoir le login et le mot de passe du formulaire
vérifier s'ils existent dans la base de données
créer une session si l'utilisateur est valide
rediriger vers la page principale