<?php

session_start();
require_once("connexion.php");

if(!isset($_SESSION['panier']) || empty($_SESSION['panier'])){ //si vide
    echo "Panier vide";
    exit;
}

// recuperer les IDs (tableau)
$ids = $_SESSION['panier'];    // [1,2,3,4,..]

// convertir en nombres (sécurité)
$ids = array_map('intval', $ids);  

$ids_list = implode(",", $ids);  ////1,2,3,4... utilité  f sql

// sécurité si vide
if(empty($ids_list)){
    echo "Panier vide";
    exit;
}
//récupère plusieurs événements en même temps
$sql = "SELECT * FROM Events WHERE id_event IN ($ids_list)"; //in(1,2,3..)
$stmt = $pdo->query($sql);//execute

$total = 0;//initialiser total=0

echo "<h2>Mon panier</h2>";

echo "<table border='1' width='80%'>";

echo "<tr>
<th>Titre</th>
<th>Prix étudiant</th>
<th>Prix public</th>
</tr>";

while($event = $stmt->fetch()){//affiche chaque événement

    echo "<tr>";
    echo "<td>".$event['titre']."</td>";
    echo "<td>".$event['prix_etudiant']."</td>";
    echo "<td>".$event['prix_public']."</td>";
    echo "</tr>";

    $total += $event['prix_etudiant'];
}

echo "</table>";

echo "<h3>Total : $total MAD</h3>";

echo "<br><a href='confirmer_inscription.php'>Confirmer inscription</a>";

?>