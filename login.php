<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            background-color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial;
        }

        .login-box{
            background: white;
            padding: 40px;
            width: 350px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        .login-box h2{
            margin-bottom: 20px;
            color: #333;
        }

        .login-box input{
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .login-box button{
            width: 100%;
            padding: 12px;
            background: #5b1464;
            border: none;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-box button:hover{
            background: #480961;
        }

        .title{
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="login-box">

    <div class="title">Connexion</div>
<?php
//Cette page sert à :
// permettre à l’utilisateur de se connecter
//saisir login + mot de passe
//envoyer les données vers PHP pour vérification

if(isset($_GET['erreur'])){  //msg erreur=1 dans url
    echo "<p style='color:red; margin-bottom:15px;'>
            ❌ Login ou mot de passe incorrect
          </p>";
}
?>
    <form action="connecter_utilisateur.php" method="POST">

        <input type="text" name="login" placeholder="Login" required>

        <input type="password" name="mdp" placeholder="Mot de passe" required>

        <button type="submit">S connecter</button>

    </form>

</div>

</body>

</html>

//test git modification

