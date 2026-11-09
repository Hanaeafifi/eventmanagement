
<link rel="stylesheet" href="style.css">
<?php

session_start();

require_once("connexion.php");

// sécurité
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

// récupérer l'id
$id = $_GET['id'];

// si on a cliqué sur le bouton modifier
if(isset($_POST['update'])){

    $titre = $_POST['titre'];
    $date = $_POST['date_event'];
    $lieu = $_POST['lieu'];
    $prix_etudiant = $_POST['prix_etudiant'];
    $prix_public = $_POST['prix_public'];

    $sql = "UPDATE Events 
            SET titre=?, date_event=?, lieu=?, prix_etudiant=?, prix_public=? 
            WHERE id_event=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $date, $lieu, $prix_etudiant, $prix_public, $id]);

    header("Location: afficher_evenements.php");
    exit;
}

// récupérer les données actuelles
$sql = "SELECT * FROM Events WHERE id_event=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$event = $stmt->fetch();

?>

<h2>Modifier événement</h2>
<div class="container">
<form method="POST">

Titre : <br>
<input type="text" name="titre" value="<?= $event['titre'] ?>"><br><br>

Date : <br>
<input type="date" name="date_event" value="<?= $event['date_event'] ?>"><br><br>

Lieu : <br>
<input type="text" name="lieu" value="<?= $event['lieu'] ?>"><br><br>

Prix étudiant : <br>
<input type="text" name="prix_etudiant" value="<?= $event['prix_etudiant'] ?>"><br><br>

Prix public : <br>
<input type="text" name="prix_public" value="<?= $event['prix_public'] ?>"><br><br>

<button type="submit" name="update">Modifier</button>

</form>
</div>