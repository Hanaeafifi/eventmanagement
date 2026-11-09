<?php
//active l’affichage de toutes les erreurs PHP
error_reporting(E_ALL);
//montre à l’écran pour faciliter le débogage.
ini_set('display_errors', 1);//1 = ON activer

session_start();

require_once("connexion.php");

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

// vérifier si id existe
if(!isset($_GET['id'])){
    die("ID manquant"); //exit
}

$id = $_GET['id'];

$sql = "DELETE FROM Events WHERE id_event = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: afficher_evenements.php");
exit;

?>