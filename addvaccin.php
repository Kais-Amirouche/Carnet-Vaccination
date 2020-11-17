<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');
$sql = "SELECT * FROM vac_vaccins";
$query = $pdo->prepare($sql);
$query->execute();
$namevacs = $query->fetchall();

// debug($namevacs);
// debug($_SESSION);
$user_id=$_SESSION['user']['id'];
if(!empty($_POST['submitvac'])) {
  // Faille XSS
  $date       = cleanXss($_POST['date']);
  $vaccin_id  = cleanXss($_POST['vaccins']);
  $numero_lot = cleanXss($_POST['numero_lot']);
  $errors = validationText($errors,$numero_lot,'numero_lot',4,20);
  $errors = ValidationText($errors,$date,'date',8,9);
  if ($errors==0) {
    $sql = "INSERT INTO user_vaccin (user_id, vaccin_id, fait_at)
            VALUES (:id_user, :vaccin_id, :fait_at) WHERE id=$user_id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':user_id',$user_id,PDO::PARAM_INT);
    $query->bindValue(':vaccin_id',$vaccin_id,PDO::PARAM_INT);
    $query->bindValue(':fait_at',$fait_at,PDO::PARAM_INT);
    $query->execute();
  }
}
include('inc/header.php'); ?>

<h1>Ajouter un vaccin à votre carnet</h1>

<form  action="addvaccin.php" method="post">
  <!-- date de la vaccination -->
  <label for="date">date de la vaccination:</label>
  <input id="date" type="date" name="date_vaccin" value="">
  <span class="error"><?php if(!empty($errors['date'])){echo $errors['date'];} ?></span>

  <!-- Nom du vaccin -->
  <label for="vaccins">les vaccins:</label>
   <select name="vaccins" id="vaccins">
     <option value="vaccin">--choisir votre vaccin--</option>
   <?php foreach ($namevacs as $namevac) {
     echo '<option value="vaccin">'.$namevac['name'].'</option>';
   } ?>
   </select>
   <span class="error"><?php if(!empty($errors['vaccins'])){echo $errors['vaccins'];} ?></span>
  <!-- numéro de lot -->
  <label for="numero_lot">Numéro du lot:</label>
  <input id="numero_lot" type="text" name="numero_lot" value="" placeholder="Numéro de lot:">
  <span class="error"><?php if(!empty($errors['numero_lot'])){echo $errors['numero_lot'];} ?></span>
  <!-- rappel ? -->
  <label for="Rappel">s'agit il d'un rappel:</label>
  <input id="Rappel" type="checkbox" name="Rappel" value="">
  <!-- submit -->
  <input type="submit" name="submitvac" value="inserer mon vaccin">
</form>

<?php include('inc/footer.php');
