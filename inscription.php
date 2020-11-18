<?php

session_start();
// inscription.php
include('inc/pdo.php');
include('inc/function.php');
// TABLE users
// id,nom (60),email(120),password(255),created_at(datetime), token(255), role (admin, abonne)  varchar (10)
$errors = array();
if(!empty($_POST['submitinscription'])) {
  // Faille xss
  $nom    = cleanXss($_POST['nom']);
  $prenom    = cleanXss($_POST['prenom']);
  $email     = cleanXss($_POST['email']);
  $password1 = cleanXss($_POST['password1']);
  $password2 = cleanXss($_POST['password2']);
  // validation nom (3, 50, unique)
  if(!empty($nom)) {
    if(mb_strlen($nom) < 3) {
      $errors['nom'] = 'Min 3 caratères';
    } elseif(mb_strlen($nom) > 50) {
      $errors['nom'] = 'Max 50 caratères';
    } else {
      $sql = "SELECT id FROM vac_users WHERE nom = :nom";
      $query = $pdo->prepare($sql);
      $query->bindValue(':nom',$nom,PDO::PARAM_STR);
      $query->execute();
      $verifnom = $query->fetch();
    }
  } else {
    $errors['nom'] = 'Veuillez renseigner ce champ';
  }
  if(!empty($prenom)) {
    if(mb_strlen($prenom) < 3) {
      $errors['prenom'] = 'Min 3 caratères';
    } elseif(mb_strlen($prenom) > 50) {
      $errors['prenom'] = 'Max 50 caratères';
    } else {
      $sql = "SELECT id FROM vac_users WHERE prenom = :prenom";
      $query = $pdo->prepare($sql);
      $query->bindValue(':prenom',$prenom,PDO::PARAM_STR);
      $query->execute();
      $verifprenom = $query->fetch();
    }
  } else {
    $errors['prenom'] = 'Veuillez renseigner ce champ';
  }
  // validation email (email valide, unique)
  if(!empty($email)) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] =  'Veuillez renseigner un email valide';
    } else {
      $sql = "SELECT id FROM vac_users WHERE email = :email";
      $query = $pdo->prepare($sql);
      $query->bindValue(':email',$email,PDO::PARAM_STR);
      $query->execute();
      $verifEmail = $query->fetch();
      if(!empty($verifEmail)) {
        $errors['email'] = 'Cet email existe déjà';
      }
    }
  } else {
    $errors['email'] = 'Veuillez renseigner un email';
  }
  // password (min 6 , identiques)
  if(!empty($password1) && !empty($password2)) {
    if($password1 != $password2) {
      $errors['password2'] = 'Veuillez renseigner des mot de passe identiques';
    } elseif(mb_strlen($password1) < 6) {
      $errors['password'] = 'Min 6 caractères';
    }
  } else {
    $errors['password'] = 'Veuillez renseigner vos mots de passe';
  }

  // if no error
  if(count($errors) == 0) {
    // hash password
    $hashPassword = password_hash($password1,PASSWORD_DEFAULT);
    $role = 'abonne';
    $token = generateRandomString(120);
    $sql = "INSERT INTO vac_users (nom,prenom,email,password,token,created_at,role)
                          VALUES (:nom,:prenom, :email,:password,'$token',NOW(),'$role')";
    $query = $pdo->prepare($sql);
    //$query->bindValue(':title',$title,PDO::PARAM_STR);
    $query->bindValue(':nom',$nom,PDO::PARAM_STR);
    $query->bindValue(':prenom',$prenom,PDO::PARAM_STR);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->bindValue(':password',$hashPassword,PDO::PARAM_STR);
    $query->execute();


    // redirection => connexion
    header('Location: connexion.php');
    exit();
  }
}

include('inc/header.php'); ?>
<h1 id="action">Inscription</h1>
<form method="POST" action="inscription.php" id="forminscription" novalidate>
    <!-- nom -->
      <input type="text" name="nom" id="nom" class="form-control" value="<?php if(!empty($_POST['nom'])) { echo $_POST['nom']; } ?>" placeholder="nom" />
      <span class="error"><?php if(!empty($errors['nom'])) { echo $errors['nom']; } ?></span>
      <!-- nom -->
        <input type="text" name="prenom" id="prenom" class="form-control" value="<?php if(!empty($_POST['prenom'])) { echo $_POST['prenom']; } ?>" placeholder="prenom" />
        <span class="error"><?php if(!empty($errors['prenom'])) { echo $errors['prenom']; } ?></span>
    <!-- EMAIL -->
      <input type="email" name="email" id="email" class="form-control" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>" placeholder="Email" />
      <span class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></span>
    <!-- PASSWORD1 -->
      <input type="password" name="password1" id="password1" class="form-control" value="" placeholder="Mot De Passe"/>
      <span class="error"><?php if(!empty($errors['password'])) { echo $errors['password']; } ?></span>
    <!-- PASSWORD2 -->
      <input type="password" name="password2" id="password2" class="form-control" value="" placeholder="Confirmer Le Mot De Passe"/>
      <span class="error"><?php if(!empty($errors['password2'])) { echo $errors['password2']; } ?></span>
    <input type="submit" name="submitinscription" value="Je m'inscris" />
</form>
<?php include('inc/footer.php');
