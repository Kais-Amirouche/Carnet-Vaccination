<?php
include('../inc/pdo.php');
include('../inc/function.php');

if (!empty($_GET['id']) && is_numeric($_GET['id']))
{
  $id = $_GET['id'];
  $sql = "SELECT * FROM vac_vaccins WHERE id = :id";
  $var = $pdo->prepare($sql);
  $var->bindValue(':id',$id,PDO::PARAM_INT);
  $var->execute();
  $vaccin = $var->fetch();
  // debug($vaccin);

  if (!empty($vaccin))
  {
    $sql = "DELETE FROM vac_vaccins WHERE id = :id";
    $var = $pdo->prepare($sql);
    $var->bindValue(':id',$id,PDO::PARAM_INT);
    $var->execute();
    header('Location: vaccins.php');
  }else {
    header('Location: 404.php');
    die();
  }
}else {
  header('Location: 404.php');
  die();
}
