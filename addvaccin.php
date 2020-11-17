<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');
$sql = "SELECT name FROM vac_vaccins";
$query = $pdo->prepare($sql);
$query->execute();
$namevacs = $query->fetchall();
// debug($namevacs);
if(!empty($_POST['submitvac'])) {
  // Faille XSS
  $date=cleanXss($_POST['date']);
  $nom_vaccin=cleanXss($_POST['nom_vaccin']);
  $numero_lot=cleanXss($_POST['numero_lot']);
  $errors = validationText($errors,$numero_lot,'numero_lot',4,20);
  if ($errors==0) {
    $sql = "INSERT INTO ";
    $query = $pdo->prepare($sql);
    $query->execute();
    $monvaccin = $query->fetchall();
  }
}
include('inc/header.php'); ?>

<h1>Ajouter un vaccin à votre carnet</h1>

<form  action="addvaccin.php" method="post">
  <!-- date de la vaccination -->
  <label for="date">date de la vaccination:</label>
  <input id="date" type="date" name="date_vaccin" value="">
  <!-- Nom du vaccin -->
  <label for="vaccins">les vaccins:</label>
   <select name="vaccins" id="vaccins">
     <option value="vaccin">--choisir votre vaccin--</option>
   <?php foreach ($namevacs as $namevac) {
     echo '<option value="vaccin">'.$namevac['name'].'</option>';
   } ?>
   </select>
  <!-- numéro de lot -->
  <label for="numero_lot">Numéro du lot:</label>
  <input id="numero_lot" type="text" name="numero_lot" value="" placeholder="Numéro de lot:">
  <!-- rappel ? -->
  <label for="Rappel">s'agit il d'un rappel:</label>
  <input id="Rappel" type="checkbox" name="Rappel" value="">
  <!-- submit -->
  <input type="submit" name="submitvac" value="inserer mon vaccin">
</form>

<?php include('inc/footer.php');
