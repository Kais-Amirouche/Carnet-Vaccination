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

$title = 'Editer les vaccins';

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
  // debug($_POST);

  if(!empty($vaccin))
  {
    if (!empty($_POST['submitted']))
    {
      $name = cleanXss($_POST['name']);
      $description = cleanXss($_POST['description']);
      $age = cleanXss($_POST['age']);
      $rappel = cleanXss($_POST['rappel']);
      $statuts = cleanXss($_POST['statuts']);

      $errors = validationText($errors,$name,'name',2,150);
      $errors = validationText($errors,$description,'description',20,5000);
      $errors = validationText($errors,$age,'age',2,80);
      $errors = validationText($errors,$rappel,'rappel',2,5000);

      if(count($errors) == 0)
      {
        $sql = "UPDATE vac_vaccins SET name = :name, description = :description, age = :age, rappel = :rappel, statuts = :statuts WHERE id = :id";
        $var = $pdo->prepare($sql);
        $var->bindValue(':id',$id,PDO::PARAM_INT);
        $var->bindValue(':name',$name,PDO::PARAM_STR);
        $var->bindValue(':description',$description,PDO::PARAM_STR);
        $var->bindValue(':age',$age,PDO::PARAM_STR);
        $var->bindValue(':rappel',$rappel,PDO::PARAM_STR);
        $var->bindValue(':statuts',$statuts,PDO::PARAM_STR);
        $var->execute();

        header('Location: vaccins.php');
      }
    }
  }
}

include('inc/header-back.php'); ?>

  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Edit de vaccin</h6>
      </div>
      <div class="card-body">
          <form action="" method="post">

            <label for="name">Nom: </label>
            <input type="text" id="name" name="name" value="<?php if(!empty($_POST['name'])) {echo $_POST['name'];} else{echo $vaccin['name'];} ?>">
            <span class="errorform"><?php if(!empty($errors['name'])) {echo $errors['name'];} ?></span>
            <br>

            <label for="name">Description: </label>
            <textarea name="description" id="description"><?php if(!empty($_POST['description'])) {echo $_POST['description'];} else{echo $vaccin['description'];} ?></textarea>
            <span class="errorform"><?php if(!empty($errors['description'])) {echo $errors['description'];} ?></span>
            <br>

            <label for="name">Age: </label>
            <input type="text" id="age" name="age" value="<?php if(!empty($_POST['age'])) {echo $_POST['age'];} else{echo $vaccin['age'];}?>" placeholder="Age pour faire le vaccin">
            <span class="errorform"><?php if(!empty($errors['age'])) {echo $errors['age'];} ?></span>
            <br>

            <label for="name">Rappel: </label>
            <input type="text" id="rappel" name="rappel" value="<?php if(!empty($_POST['rappel'])) {echo $_POST['rappel'];} else{echo $vaccin['rappel'];}?>">
            <span class="errorform"><?php if(!empty($errors['rappel'])) {echo $errors['rappel'];} ?></span>
            <br>

            <input type="radio" id="obligatoire" name="statuts" value="obligatoire">
            <label for="statuts">Obligatoire</label>

            <input type="radio" id="facultatif" name="statuts" value="facultatif">
            <label for="statuts">Facultatif</label>
            <br>

            <input type="submit" name="submitted" value="Modifier">

          </form>
      </div>
  </div>

<?php include('inc/footer-back.php');
