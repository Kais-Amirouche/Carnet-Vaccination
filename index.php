<?php
session_start();


include('inc/pdo.php');
include('inc/function.php');

include('inc/header.php');?>
<img class="backgroundheader" src="asset/img/vac-vac.jpeg" alt="image de fond">
<div class="presentation">
  <h3>Mon carnet de vaccination électronique</h3>
  <h4>  Pour être mieux vacciné, sans défaut ni excès.</h4>
  <p> Le carnet de vaccination est un carnet dans lequel sont notées toutes les vaccinations d’une personne. Le professionnel de santé qui vous vaccine (médecin ou infirmier) écrit dans ce carnet :

    le nom du vaccin ;
    la date de l’injection ;
    le numéro du lot (étiquette) ;
    la date du prochain vaccin à faire.
    Ce carnet est très pratique : il vous permet de savoir quelles vaccinations vous avez reçues et si vous êtes à jour de vos vaccinations. Il faut donc le ranger précieusement pour ne pas le perdre et ne pas oublier de le présenter au professionnel de santé à chaque fois que vous vous faites vacciner. Il est valable toute la vie !

    Pour l’obtenir, il suffit de le demander aux professionnels de santé. Il est gratuit.

    À noter : Pour les enfants, le carnet de santé sert aussi de carnet de vaccination. Le carnet de vaccination remplace le carnet de santé lorsque l’on est adulte (surtout si on ne retrouve plus son carnet de santé).</p>
</div>

<!-- <h1>Accueil</h1> -->





<?php include('inc/footer.php');
