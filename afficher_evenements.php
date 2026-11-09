<?php

session_start();

require_once("connexion.php");
//si l’utilisateur n’est pas connecté :redirection vers login
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

//récupère tous les événements
$sql = "SELECT * FROM Events";
$stmt = $pdo->query($sql); //exécute directement (SELECT simple)

?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des événements</title>

    <style>

        body{
            margin:0;
            font-family: Arial;
            background:white;
        }

        /* NAVBAR */

        .navbar{
            background: linear-gradient(90deg, #500c47, #59797a);
            padding: 15px 40px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 2px 10px rgba(0,0,0,0.2);
        }

        .logo{
            color:white;
            font-size:24px;
            font-weight:bold;
        }

        .menu{
            display:flex;
            gap:20px;
        }

        .menu a{
            color:white;
            text-decoration:none;
            font-size:16px;
            padding:8px 14px;
            border-radius:8px;
            transition:0.3s;
        }

        .menu a:hover{
            background:rgba(255,255,255,0.2);
        }

        h1{
            text-align:center;
            margin-top:30px;
            color:#333;
        }

        /* TABLE */

        table{
            border-collapse: collapse;
            width: 90%;
            margin: 30px auto;
            background:white;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 4px 15px rgba(75, 46, 46, 0.1);
        }

        th, td{
            padding:15px;
            text-align:center;
            border-bottom:1px solid #eee;
        }

        th{
            background:#333;
            color:white;
        }

        tr:hover{
            background:#f9f9f9;
        }

        /* TOOLTIPS */

        .tooltip{
            position: relative;
            display: inline-block;
            margin: 0 8px;
        }

        .tooltip .text{
            visibility: hidden;
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 5px 8px;
            border-radius: 6px;

            position: absolute;
            z-index: 10;
            bottom: 120%;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            font-size: 12px;
        }

        .tooltip:hover .text{
            visibility: visible;
        }

        .actions a{
            text-decoration:none;
            font-size:20px;
            transition:0.2s;
        }

        .actions a:hover{
            transform:scale(1.2);
        }

    </style>

</head>

<body>

    <!-- NAVBAR -->

    <div class="navbar">

        <div class="logo">
            EventManagement
        </div>

        <div class="menu">

            <a href="afficher_evenements.php">🏠 Accueil</a>

            <a href="historique.php">📜 Mon historique</a>

            <a href="ajouter_event.php">➕ Ajouter un événement</a>

            <a href="deconnexion.php">🚪 Déconnexion</a>

        </div>

    </div>

    <h1>Liste des événements</h1>

    <table>

        <tr>
            <th>Titre</th>
            <th>Date</th>
            <th>Lieu</th>
            <th>Prix étudiant</th>
            <th>Prix public</th>
            <th>Actions</th>
        </tr>

        <?php 
        //afficher plusieurs événements
        //tant qu il reste des lignes 
        while($event = $stmt->fetch()){   //fetch() récupère une ligne du résultat SQL
        ?>

        <tr>

            <td><?= $event['titre'] ?></td><!--affiche le titre-->

            <td><?= $event['date_event'] ?></td>

            <td><?= $event['lieu'] ?></td>

            <td><?= $event['prix_etudiant'] ?> MAD</td>

            <td><?= $event['prix_public'] ?> MAD</td>

            <td class="actions">
                 <!--$event contient une ligne de la base de données
            //L’ID est envoyé dans l’URL pour identifier l’événement.”-->
                <span class="tooltip">
                    <a href="modifier_event.php?id=<?= $event['id_event'] ?>">✏️</a>
                    <span class="text">Modifier</span>
                </span>

                <span class="tooltip">
                    <a href="supprimer_event.php?id=<?= $event['id_event'] ?>">🗑️</a>
                    <span class="text">Supprimer</span>
                </span>

                <span class="tooltip">
                    <a href="ajouter_panier.php?id=<?= $event['id_event'] ?>">🛒</a>
                    <span class="text">Ajouter au panier</span>
                </span>

            </td>

        </tr>

        <?php
        }
        ?>

    </table>

</body>
</html>