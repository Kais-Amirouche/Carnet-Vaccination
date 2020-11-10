<?php
include('../inc/pdo.php');
include('../inc/function.php');

$errors = array();























include('inc/header-back.php'); ?>

<form action="" method="post">

  <label for="nom">Nom</label>
  <input type="text" id="nom" name="nom" value="">
  <span class="error"></span>

  <label for="description">Description</label>
  <input type="text" id="description" name="description" value="">
  <span class="error"></span>

  <label for="age">Age</label>
  <input type="number" id="age" name="age" value="">
  <span class="error"></span>

  <input type="submit" name="submitted" value="Ajouter">









</form>









<?php include('inc/footer-back.php');
