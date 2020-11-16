<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

$title = 'Information sur le vaccin';

$errors = array();

if(!empty($_GET['id']) && is_numeric($_GET['id']))
{
  $id = $_GET['id'];
  $sql = "SELECT * FROM vac_vaccins WHERE id = :id";
  $var = $pdo->prepare($sql);
  $var->bindValue(':id',$id,PDO::PARAM_INT);
  $var->execute();
  $vaccin = $var->fetch();
  // debug($vaccin);
  if (empty($vaccin))
  {
    echo '404';
  }
} else {
  echo '404';
}
include('inc/header.php'); ?>


<div class="info-vaccin">
  <p><?php echo $vaccin['name']; ?></p>
  <p><?php echo $vaccin['age']; ?></p>
  <p><?php echo $vaccin['description']; ?></p>
  <p><?php echo $vaccin['rappel']; ?></p>
  <p><?php echo $vaccin['statuts']; ?></p>
</div>


<?php include('inc/footer.php');
