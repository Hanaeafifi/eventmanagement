<?php
//prend les événements du panier
//les enregistre dans la table inscription
// vide le panier
// confirme l’inscription
session_start();
require_once("connexion.php");

if(!isset($_SESSION['panier']) || empty($_SESSION['panier'])){
    echo "Panier vide";
    exit;
}
//recuperer les ids et transformer de [1,2,..]au 1,2,3
$ids = $_SESSION['panier'];
$ids = array_map('intval', $ids);
$ids_list = implode(",", $ids);
//récupère tous les événements du panier
$sql = "SELECT * FROM Events WHERE id_event IN ($ids_list)";
$stmt = $pdo->query($sql);//executer

//parcourir chaque event
while($event = $stmt->fetch()){

    $sql_insert = "INSERT INTO inscription 
    (id_utilisateur, id_evenement, date_inscription, prix_applique)
    VALUES (?, ?, NOW(), ?)";   //now =date actuelle

    $stmt_insert = $pdo->prepare($sql_insert);

    $stmt_insert->execute([//insère dans la base
        $_SESSION['user'],
        $event['id_event'],
        $event['prix_etudiant']
    ]);
}

// vider panier pour eviter doublons
unset($_SESSION['panier']);

echo "✔ Inscription confirmée avec succès";
echo "<br><a href='afficher_evenements.php'>Retour</a>";

?>