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
<<<<<<< HEAD
  </div>
</div>
<div class="connexion">
  <ul>
    <h2>Vous n'êtes toujours pas inscris?</h2>
    <?php if(isLogged()) { ?>
    <li><a href="inscription.php#action">Cliquez ici.</a></li>
=======
    <?php if(!isLogged()) { ?>
    <h3>Vous n'êtes toujours pas inscrit?</h3>
    <p><a href="inscription.php#action">Cliquez ici.</a></p>
>>>>>>> bb0bd5af79996b4b1ac6b4fe0905543d66028c93
    <?php } ?>
  </div>
</div>
<!-- <h1>Accueil</h1> -->





<?php include('inc/footer.php');
