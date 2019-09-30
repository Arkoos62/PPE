<?php
session_start();
include('C:\UwAmp\www\formulaire\db\connexionDB.php');
// S'il n'y a pas de session alors on ne va pas sur cette page
if(!isset($_SESSION['id'])){
header('Location: index.php');
exit;
}
// On récupère les informations de l'utilisateur connecté
$afficher_profil = $DB->query("SELECT *
FROM utilisateur
WHERE id = ?",
array($_SESSION['id']));

$afficher_profil = $afficher_profil->fetch();
?>

<html lang="fr">
<head>
    <meta charset="utf-8">
    ﻿<meta http-equiv="X-UA-Compatible" content="IE=edge">
    ﻿<meta name="viewport" content="width=device-width, initial-scale=1">
    ﻿<title>Mon profil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="custom.css">
</head>
<body>
<?php include('header.inc.php'); ?>
<div class="page-profil">
<h1>Mon profil</h1>
﻿<h2>Voici le profil de <?= $afficher_profil['nom'] . " " . $afficher_profil['prenom']; ?></h2>
﻿<div>Quelques informations sur vous : </div>
    ﻿<ul>
    ﻿<li>Votre id est : <?= $afficher_profil['id'] ?></li>
    <li>Votre mail est : <?= $afficher_profil['mail'] ?></li>
    ﻿<li>Votre compte a été crée le : <?= $afficher_profil['date_creation_compte'] ?></li>
</ul>
<button onclick="window.location.href='modifier-profil.php'" class="btn btn-primary">Modifier mon profil</button>
</div>
﻿<?php include('footer.inc.php'); ?>
﻿</body>
</html>