<?php

session_start();

// vérifie si un id est envoyé dans l’URL
if(!isset($_GET['id'])){
    die("ID manquant");  //arrete le script avec un mssg
}
//RÉCUPÉRER ID
$id = (int) $_GET['id'];

// initialiser panier si besoin,si panier n’existe pas :on crée un tableau vide
if(!isset($_SESSION['panier'])){
    $_SESSION['panier'] = [];
}

// éviter doublon-vérifie si l’id existe déjà
if(!in_array($id, $_SESSION['panier'])){
    $_SESSION['panier'][] = $id;  //si non présent :ajoute l’id dans le panier
}

// DEBUG (temporaire)
var_dump($_SESSION['panier']);//affiche le contenu du panier

// redirection vers panier
header("Location: afficher_panier.php");
exit;
// ajoute un événement dans le panier
// utilise la session
// évite les doublons
// redirige vers le panier
?>
