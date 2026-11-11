<?php
//✔ se connecter à la base de données MySQL
//créer un objet $pdo utilisable partout
// gérer les erreurs de connexion

$host = "localhost";//server xampp
$dbname = "eventmanagement";
$user = "root";
$password = "";

try {//crée la connexion avec la base

//PDO = interface PHP pour SQL
//permet SELECT / INSERT / UPDATE / DELETE
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname",
        $user,
        $password
    );
     //vggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg
     //vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
//active les erreurs PDO,si SQL bug → message d’erreur visible
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) { //si la connexion échoue :arrêt du script affiche l’erreur
    die("Erreur connexion : " . $e->getMessage());
}

?>
