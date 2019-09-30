<?php
// Permet de savoir s'il y a une session.
// C'est à dire si un utilisateur c'est connecté à votre site
session_start();

// Fichier PHP contenant la connexion à votre BDD
include('C:\UwAmp\www\formulaire\db\connexionDB.php');
?>


<!DOCTYPE html>
<html>
﻿<head>
    ﻿<meta charset="utf-8"/>
    ﻿<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
﻿<body>
﻿<?php include('header.inc.php'); ?>

<div class="carousel">
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div style="border:solid" class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="http://localhost/formulaire/img/garderie.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="http://localhost/formulaire/img/garderie.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="http://localhost/formulaire/img/garderie.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
</div>

<div class="card-group">
    <div class="card">
        <img class="card-img-top" src="http://localhost/formulaire/img/garderie.jpg" height="400" alt="garderie1">
        <div class="card-body">
            <h5 class="card-title">Le multi-accueil</h5>
            <p class="card-text">Priorité aux parents du territoire, composé d'une crèche et d'une halte-garderie de 25 places.</p>
        </div>
        <div class="card-footer">
            <small class="text-muted">En savoir plus</small>
        </div>
    </div>
    <div class="card">
        <img class="card-img-top" src="http://localhost/formulaire/img/garderie2.jpg" height="400" alt="Card image 2">
        <div class="card-body">
            <h5 class="card-title">Le Relais Assistantes Maternelles (RAM)</h5>
            <p class="card-text"> Il bénéficie d'un espace avec bureau et salle d'activité. Le RAM utilise également la salle de motricité du multi-accueil.</p>
        </div>
        <div class="card-footer">
            <small class="text-muted">En savoir plus</small>
        </div>
    </div>
    <div class="card">
        <img class="card-img-top" src="http://localhost/formulaire/img/garderie3.jpg" height="400" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Les  permanences</h5>
            <p class="card-text">Permanence de la CAF, du CMP (Centre Médico-Psychologique) et des assistantes sociales du Conseil Général
                Avec </p>
        </div>
        <div class="card-footer">
            <small class="text-muted">En savoir plus</small>
        </div>
    </div>
</div>

            <div>
                <?php
                if(isset($_SESSION['id'])){
                    echo 'ID : ' . $_SESSION['id'] . ', Nom : ' . $_SESSION['nom'] . ", prénom : " .
                        $_SESSION['prenom'] . ", mail : " . $_SESSION['mail'];
                }
                ?>
            </div>
        </div>
    </div>


</div>
﻿<?php include('footer.inc.php'); ?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
﻿</html>