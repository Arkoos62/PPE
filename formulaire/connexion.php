<?php
session_start();
include('C:\UwAmp\www\formulaire\db\connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD

// S'il y a une session alors on ne retourne plus sur cette page
if (isset($_SESSION['id'])){
    header('Location: index.php');
    exit;
}

// Si la variable "$_Post" contient des informations alors on les traitres
if(!empty($_POST)){
    extract($_POST);
    $valid = true;

    if (isset($_POST['connexion'])){
        $mail = htmlentities(strtolower(trim($mail)));
        $mdp = trim($mdp);

        if(empty($mail)){ // Vérification qu'il y est bien un mail de renseigné
            $valid = false;
            $er_mail = "Il faut mettre un mail";
        }

        if(empty($mdp)){ // Vérification qu'il y est bien un mot de passe de renseigné
            $valid = false;
            $er_mdp = "Il faut mettre un mot de passe";
        }

        // On fait une requête pour savoir si le couple mail / mot de passe existe bien car le mail est unique !
        $req = $DB->query("SELECT * 
                FROM utilisateur 
                WHERE mail = ? AND mdp = ?",
            array($mail, crypt($mdp, "$6$rounds=5000$macleapersonnaliseretagardersecret$")));
        $req = $req->fetch();

        // Si on a pas de résultat alors c'est qu'il n'y a pas d'utilisateur correspondant au couple mail / mot de passe
        if ($req['id'] == ""){
            $valid = false;
            $er_mail = "Le mail ou le mot de passe est incorrecte";
        }

        // S'il y a un résultat alors on va charger la SESSION de l'utilisateur en utilisateur les variables $_SESSION
        if ($valid){
            $_SESSION['id'] = $req['id']; // id de l'utilisateur unique pour les requêtes futures
            $_SESSION['nom'] = $req['nom'];
            $_SESSION['prenom'] = $req['prenom'];
            $_SESSION['mail'] = $req['mail'];

            header('Location:  index.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion</title>
    <link rel="stylesheet" href="custom.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php include('header.inc.php'); ?>
<div class="page-connexion">
<h1>Se connecter</h1>
<form method="post">
    <div class="form-group">
    <?php
    if (isset($er_mail)){
        ?>
        <div><?= $er_mail ?></div>
        <?php
    }
    ?>
    <input type="email" class="form-control" placeholder="Adresse mail" name="mail" value="<?php if(isset($mail)){ echo $mail; }?>" required>
    </div>
    <div class="form-group">
    <?php
    if (isset($er_mdp)){
        ?>
        <div><?= $er_mdp ?></div>
        <?php
    }
    ?>
    <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" value="<?php if(isset($mdp)){ echo $mdp; }?>" required>
    </div>
    <button  class="btn btn-primary" type="submit" name="connexion">Se connecter</button>
    <div>
        <?php
        if(!isset($_SESSION['id'])){
            ?>

            <a href="motdepasse.php">Mot de passe oublié</a>

            <?php
        }
        ?>
    </div>
    ﻿
</form>
</div>
<?php include('footer.inc.php'); ?>
</body>
</html>
