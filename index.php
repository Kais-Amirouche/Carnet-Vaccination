<?php
session_start();

include('inc/pdo.php');
include('inc/function.php');

include('inc/header.php');?>
<img class="backgroundheader" src="asset/img/vac-vac.jpeg" alt="image de fond">
<div class="presentation">
  <h3>Mon carnet de vaccination électronique</h3>
  <h4>  Pour être mieux vacciné, sans défaut ni excès.</h4>
  <div class="texteheader">
    <p>|Le carnet de vaccination est un carnet dans lequel sont notées toutes les vaccinations d’une personne|</p>
    <p>|Le professionnel de santé qui vous vaccine écrit dans ce carnet|</p>
    <p>|le nom du vaccin|</p>
    <p>|la date de l’injection|</p>
    <p>|le numéro du lot|</p>
    <p>|la date du prochain vaccin à faire|</p>

    <?php if(!isLogged()) { ?>
  </div>
</div>
<div class="connexion">
  <ul>
    <h2>Vous n'êtes toujours pas connecté?</h2>

    <li><a href="connexion.php#action">Cliquez ici.</a></li>

  </ul>

</div>
<!-- <h1>Accueil</h1> -->





<?php include('inc/footer.php');
