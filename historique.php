<?php

session_start();
require_once("connexion.php");

//empêche accès sans connexion
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}
//récupère l’ID utilisateur connecté
$id_user = (int) $_SESSION['user']; // force en entier

$sql = "SELECT i.*, e.titre, e.date_event, e.lieu
        FROM inscription i
        JOIN Events e ON i.id_evenement = e.id_event
        WHERE i.id_utilisateur = ?"; //affiche seulement les inscriptions de l’utilisateur connecté
//remplace ? par l’ID utilisateur
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_user]);

echo "<h1 style='text-align:center;font-family:Arial'>📜 Mon historique</h1>";

echo "<style>
table{
    width:85%;
    margin:auto;
    border-collapse: collapse;
    font-family: Arial;
    margin-top:20px;
}

th, td{
    border:1px solid #ccc;
    padding:12px;
    text-align:center;
}

th{
    background:#333;
    color:white;
}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 15px;
    background:#007bff;
    color:white;
    text-decoration:none;
    border-radius:6px;
}
</style>";

echo "<table>";

echo "<tr>
        <th>Titre</th>
        <th>Date événement</th>
        <th>Lieu</th>
        <th>Date inscription</th>
        <th>Prix payé</th>
      </tr>";

$found = false;
//affiche chaque inscription
while($row = $stmt->fetch()){
    $found = true;

    echo "<tr>";
    echo "<td>".$row['titre']."</td>";
    echo "<td>".$row['date_event']."</td>";
    echo "<td>".$row['lieu']."</td>";
    echo "<td>".$row['date_inscription']."</td>";
    echo "<td>".$row['prix_applique']." MAD</td>";
    echo "</tr>";
}

if(!$found){ //SI AUCUNE DONNÉE
    echo "<tr><td colspan='5'>Aucune inscription</td></tr>";
}

echo "</table>";

echo "<div style='text-align:center;margin-top:20px'>
        <a class='btn' href='afficher_evenements.php'>⬅ Retour</a>
      </div>";

?>