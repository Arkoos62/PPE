<?php
session_start();
include('C:\UwAmp\www\formulaire\db\connexionDB.php');

if (!isset($_SESSION['id'])){
    header('Location: index.php');
    exit;
}

// On récupère les informations de l'utilisateur connecté
$afficher_profil = $DB->query("SELECT * 
        FROM utilisateur 
        WHERE id = ?",
    array($_SESSION['id']));
$afficher_profil = $afficher_profil->fetch();

if(!empty($_POST)){
    extract($_POST);
    $valid = true;

    if (isset($_POST['modification'])){
        $nom = htmlentities(trim($nom));
        $prenom = htmlentities(trim($prenom));
        $mail = htmlentities(strtolower(trim($mail)));

        if(empty($nom)){
            $valid = false;
            $er_nom = "Il faut mettre un nom";
        }

        if(empty($prenom)){
            $valid = false;
            $er_prenom = "Il faut mettre un prénom";
        }

        if(empty($mail)){
            $valid = false;
            $er_mail = "Il faut mettre un mail";

        }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)){
            $valid = false;
            $er_mail = "Le mail n'est pas valide";

        }else{
            $req_mail = $DB->query("SELECT mail 
                    FROM utilisateur 
                    WHERE mail = ?",
                array($mail));
            $req_mail = $req_mail->fetch();

            if ($req_mail['mail'] <> "" && $_SESSION['mail'] != $req_mail['mail']){
                $valid = false;
                $er_mail = "Ce mail existe déjà";
            }
        }

        if ($valid){

            $DB->insert("UPDATE utilisateur SET prenom = ?, nom = ?, mail = ? 
                    WHERE id = ?",
                array($prenom, $nom,$mail, $_SESSION['id']));

            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['mail'] = $mail;

            header('Location:  profil.php');
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
    <title>Modifier votre profil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="custom.css">
</head>
<body>
<?php include('header.inc.php'); ?>
<div class="page-modifier-profil">
<h1>Modification</h1>
<form method="post">
    <div class="form-group">
    <?php
    if (isset($er_nom)){
        ?>
        <div><?= $er_nom ?></div>
        <?php
    }
    ?>
    <input type="text" class="form-control" placeholder="Votre nom" name="nom" value="<?php if(isset($nom)){ echo $nom; }else{ echo $afficher_profil['nom'];}?>" required>
    </div>
    <div class="form-group">
    <?php
    if (isset($er_prenom)){
        ?>
        <div><?= $er_prenom ?></div>
        <?php
    }
    ?>
    <input type="text" class="form-control" placeholder="Votre prénom" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; }else{ echo $afficher_profil['prenom'];}?>" required>
    </div>
    <div class="form-group">
    <?php
    if (isset($er_mail)){
        ?>
        <div><?= $er_mail ?></div>
        <?php
    }
    ?>
    <input type="email" class="form-control" placeholder="Adresse mail" name="mail" value="<?php if(isset($mail)){ echo $mail; }else{ echo $afficher_profil['mail'];}?>" required>
    </div>
    <button class="btn btn-primary" type="submit" name="modification">Modifier</button>
</div>
</form>
﻿<?php include('footer.inc.php'); ?>
</body>
</html>
