<?php
//✔ afficher un formulaire
//récupérer les données
// insérer dans la base
//rediriger vers la list
session_start();
require_once("connexion.php");

//si pas connecté :retour login
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

// si formulaire envoyé
if(isset($_POST['ajouter'])){//vérifie si on a cliqué sur “Ajouter”
//récupère ce que l’utilisateur a écrit
    $titre = $_POST['titre'];
    $date = $_POST['date_event'];
    $lieu = $_POST['lieu'];
    $prix_etudiant = $_POST['prix_etudiant'];
    $prix_public = $_POST['prix_public'];
//ajoute un événement dans la base
    $sql = "INSERT INTO Events (titre, date_event, lieu, prix_etudiant, prix_public)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $date, $lieu, $prix_etudiant, $prix_public]);

    header("Location: afficher_evenements.php");
    exit;//✔ stop le script
}

?>

<h2 style="text-align:center">Ajouter un événement</h2>

<style>
form{
    width: 400px;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px #ccc;
    font-family: Arial;
}

input{
    width: 100%;
    padding: 10px;
    margin: 8px 0;
}

button{
    width: 100%;
    padding: 10px;
    background: #28a745;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover{
    background: #218838;
}
</style>

<form method="POST">

    Titre :
    <input type="text" name="titre" required>

    Date :
    <input type="date" name="date_event" required>

    Lieu :
    <input type="text" name="lieu" required>

    Prix étudiant :
    <input type="number" name="prix_etudiant" required>

    Prix public :
    <input type="number" name="prix_public" required>

    <div style="display:flex; gap:10px; justify-content:center; margin-top:15px;">

    <button type="submit" name="ajouter"
        style="
        background:#28a745;
        color:white;
        border:none;
        padding:10px 15px;
        border-radius:8px;
        cursor:pointer;
        ">
        Ajouter
    </button>

    <a href="afficher_evenements.php"
       style="
       background:#dc3545;
       color:white;
       padding:10px 15px;
       border-radius:8px;
       text-decoration:none;
       ">
       Annuler
    </a>

</div>
    
</form>



