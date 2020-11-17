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

$title = 'Ajouter un vaccin';

$errors = array();
if(!empty($_POST['submitted']))
{
  $name = cleanXss($_POST['name']);
  $description = cleanXss($_POST['description']);
  $age = cleanXss($_POST['age']);
  $rappel = cleanXss($_POST['rappel']);
  $statuts = cleanXss($_POST['statuts']);

  $errors = validationText($errors,$name,'name',2,150);
  $errors = validationText($errors,$description,'description',20,5000);
  $errors = validationText($errors,$age,'age',2,20);
  $errors = validationText($errors,$rappel,'rappel',2,5000);

  if(count($errors) == 0)
  {
    $sql = "INSERT INTO vac_vaccins (name,description,age,rappel,statuts)
            VALUES (:name,:description,:age,:rappel,:statuts)";
    $var = $pdo->prepare($sql);
    $var->bindValue(':name',$name,PDO::PARAM_STR);
    $var->bindValue(':description',$description,PDO::PARAM_STR);
    $var->bindValue(':age',$age,PDO::PARAM_STR);
    $var->bindValue(':rappel',$rappel,PDO::PARAM_STR);
    $var->bindValue(':statuts',$statuts,PDO::PARAM_STR);
    $var->execute();

    header('Location: index.php');
  }
}

include('inc/header-back.php'); ?>

  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Ajout de vaccin</h6>
      </div>
      <div class="card-body">
          <form action="" method="post">

            <input type="text" id="name" name="name" value="<?php if(!empty($_POST['name'])) {echo $_POST['name'];} ?>" placeholder="Nom du virus">
            <span class="errorform"><?php if(!empty($errors['name'])) {echo $errors['name'];} ?></span>

            <input type="text" id="description" name="description" value="<?php if(!empty($_POST['description'])) {echo $_POST['description'];} ?>" placeholder="Description du virus">
            <span class="errorform"><?php if(!empty($errors['description'])) {echo $errors['description'];} ?></span>

            <input type="text" id="age" name="age" value="<?php if(!empty($_POST['age'])) {echo $_POST['age'];} ?>" placeholder="Age pour faire le vaccin">
            <span class="errorform"><?php if(!empty($errors['age'])) {echo $errors['age'];} ?></span>

            <input type="text" id="rappel" name="rappel" value="<?php if(!empty($_POST['rappel'])) {echo $_POST['rappel'];} ?>" placeholder="Les rappels">
            <span class="errorform"><?php if(!empty($errors['rappel'])) {echo $errors['rappel'];} ?></span>

            <input type="radio" name="statuts" value="obligatoire">
            <label for="statuts">Obligatoire</label>

            <input type="radio" name="statuts" value="facultatif">
            <label for="statuts">Facultatif</label>

            <input type="submit" name="submitted" value="Ajouter">

          </form>
      </div>
  </div>

<?php include('inc/footer-back.php');
