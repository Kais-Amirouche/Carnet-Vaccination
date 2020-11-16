<?php
include('../inc/pdo.php');
include('../inc/function.php');

if(!empty($_GET['id']) && is_numeric($_GET['id']))
{
  $id = $_GET['id'];
  $sql = "SELECT * FROM vac_users WHERE id = :id";
  $var = $pdo->prepare($sql);
  $var->bindValue(':id',$id,PDO::PARAM_INT);
  $var->execute();
  $user = $var->fetch();
  // debug($question);

  if(!empty($user))
  {
    $sql = "UPDATE vac_users SET role = 'admin' WHERE id = :id";
    $var = $pdo->prepare($sql);
    $var->bindValue(':id',$id,PDO::PARAM_INT);
    $var->execute();
    header('Location: users.php');
  } else {
    header('Location: 404.php');
    die();
  }
} else {
  header('Location: 404.php');
  die();
}
