<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');
$title = 'Tous les vaccins';
 
$sql = "SELECT * FROM vac_vaccins";
$var = $pdo->prepare($sql);
$var->execute();
$vaccins = $var->fetchAll();
// debug($vaccins);
include('inc/header.php');

foreach ($vaccins as $vaccin) { ?>

  <div class="part-vaccin">
    <a href="singlevaccin.php?id=<?php echo $vaccin['id']; ?>"><?php echo $vaccin['name']; ?></a>
  </div>

<?php }
include('inc/footer.php');
