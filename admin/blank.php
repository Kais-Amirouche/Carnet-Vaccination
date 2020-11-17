<?php
session_start();
include('../inc/pdo.php');
include('../inc/function.php');
if(isLogged()){
  if ($_SESSION['user']['role']!='admin'){
    header('Location: ../connexion.php#action');
    die();
  }
}else {
  header('Location: ../connexion.php#action');
  die();
}
$title = 'Blank';
include('inc/header-back.php'); ?>

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>

<?php include('inc/footer-back.php');
