<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

$title = 'Ajout de vaccin';

$sql = "SELECT * FROM vac_vaccins";
$query = $pdo->prepare($sql);
$query->execute();
$namevacs = $query->fetchall();
// debug($namevacs);
// debug($_SESSION);
// debug($_POST);

$errors = array();

$user_id=$_SESSION['user']['id'];
if(!empty($_POST['submitvac'])) {
  // Faille XSS
  $date       = cleanXss($_POST['date_vaccin']);
  $vaccin_id  = cleanXss($_POST['vaccins']);
  $numero_lot = cleanXss($_POST['numero_lot']);
  $rappel = cleanXss($_POST['rappel']);


  $errors = validationText($errors,$numero_lot,'numero_lot',4,20);
  if (empty($date))
  {
    $errors['date_vaccin'] = 'Veuillez renseigner une date';
  }
  if (empty($vaccin_id))
  {
      $errors['vaccins'] = 'Veuillez séléctionner un vaccin';
  }
      if (count($errors)==0) {
        $sql = "INSERT INTO user_vaccin (user_id, vaccin_id, fait_at, numero_lot, rappel)
                VALUES (:user_id, :vaccin_id, '$date', :dose, :rappel)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':user_id',$user_id,PDO::PARAM_INT);
        $query->bindValue(':vaccin_id',$vaccin_id,PDO::PARAM_INT);
        $query->bindValue(':dose',$numero_lot,PDO::PARAM_STR);
        $query->bindValue(':rappel',$rappel,PDO::PARAM_STR);
        $query->execute();

        header('Location: carnet.php');
      }


}
include('inc/header.php'); ?>

<h1>Ajouter un vaccin à votre carnet</h1>

<form  action="addvaccin.php" method="post">
  <!-- date de la vaccination -->
  <label for="date_vaccin">Date de la vaccination:</label>
  <input id="date_vaccin" type="date" name="date_vaccin" value="<?php if(!empty($_POST['date_vaccin'])) {echo $_POST['date_vaccin'];} ?>">
  <span class="error"><?php if(!empty($errors['date_vaccin'])){echo $errors['date_vaccin'];} ?></span>





  <!-- Nom du vaccin -->
  <label for="vaccins">Sélectionner un vaccin:</label>
  <select id="vaccins" name="vaccins">
    <option value="">--Séléctionner un vaccin--</option>
        <?php foreach ($namevacs as $namevac) { ?>
          <option value="<?php echo $namevac['id']; ?>"<?php if(!empty($_POST['vaccins'])) {if($_POST['vaccins']== $namevac['id']) {echo 'selected="selected"';}} ?>><?php echo $namevac['name']; ?></option>
        <?php } ?>
      </select>
      <span class="error"><?php if(!empty($errors['vaccins'])) {echo $errors['vaccins'];} ?></span>

    <?php
     //debug($errors);
    ?>

  <!-- numéro de lot -->
  <label for="numero_lot">Numéro du lot:</label>
  <input id="numero_lot" type="text" name="numero_lot" value="<?php if(!empty($_POST['numero_lot'])) {echo $_POST['numero_lot'];} ?>" placeholder="Numéro de lot:">
  <span class="error"><?php if(!empty($errors['numero_lot'])){echo $errors['numero_lot'];} ?></span>
  <!-- rappel ? -->

  <label for="rappel">s'agit il d'un rappel:</label>
  <input id="rappel" type="checkbox" name="rappel" value="rappel">

  <!-- submit -->
  <input type="submit" name="submitvac" value="Insérer mon vaccin">
</form>

<?php include('inc/footer.php');
