<?php
session_start();


include('inc/pdo.php');
include('inc/function.php');



include('inc/header.php');

?>

<h1>Accueil</h1>
<h2>steven</h2>

  <div class="contact">
    <?php if(isLogged()) { ?>
    <p>Besoin d'aide ? Posez-vos <a href="contact.php">questions</a></p>
    <p><a href="mesquestions.php">Mes questions</a></p>
    <?php } ?>
  </div>







<?php include('inc/footer.php');
