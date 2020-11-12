<?php
// connexion
session_start();
include('inc/pdo.php');
include('inc/function.php');
$errors = array();
$switch = false;
$switch2= false;

// if form soumis
if(!empty($_POST['submitmdp'])) {
  // Faille xss
  $login  = cleanXss($_POST['login']);
  // validation
  if(!empty($login)) {
    if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
      $errors['login'] =  'Veuillez renseigner un email valide';
    } else {
      // tout va bien
    }
  } else {
    $errors['login'] = 'Veuillez renseigner un email';
  }
  // si no error
  if(count($errors) == 0) {
    if(!empty($login)) {
      // request  users si il ya un user qui a  email
      $sql = "SELECT * FROM vac_users WHERE email = :login";
      $query = $pdo->prepare($sql);
      $query->bindValue(':login',$login,PDO::PARAM_STR);
      $query->execute();
      $user = $query->fetch();
      debug($user);
      // die();
      if(!empty($user)) { // $user existe pas => $error = 'erreur credentials'
        $switch=true;
        $email = $user['email'];
        $token = $user['token'];
        $switch='lien';
      } else {
        $errors['login'] = 'Error credentials';
        }
    }
  }
}

if(!empty($_GET['email']) && !empty($_GET['token'])) {
  $email_user = $_GET['email'];
  $token_user = $_GET['token'];
  $switch2=true;
  $switch='paix';
  if (!empty($_POST['submittoken'])) {
    $token_user  = cleanXss($_POST['token_user']);
    $Newpassword = cleanXss($_POST['Newpassword']);
    $errors = ValidationText($errors,$token_user,'token_user',120,121);
    $errors = ValidationText($errors,$Newpassword,'Newpassword',5,120);
    if(count($errors) == 0) {
      if ($token_user==$token) {
        $hashPassword = password_hash($Newpassword,PASSWORD_DEFAULT);
        $token = generateRandomString(120);
        $sql = "UPDATE vac_users SET token = :token, password = :hashPassword WHERE email=$email";
        $query->bindValue(':token',$token,PDO::PARAM_STR);
        $query->bindValue(':hashPassword',$hashPassword,PDO::PARAM_STR);
        $query->execute();

      }
    }
  }
}

include('inc/header.php'); ?>
<?php if ($switch==false) { ?>
<form action="" method="post" novalidate>
  <!-- LOGIN -->
    <input type="text" id="login" name="login" value="<?php if(!empty($_POST['login'])) { echo $_POST['login']; } ?>" placeholder="Email">
    <span class="error"><?php if(!empty($errors['login'])) { echo $errors['login']; } ?></span>

  <input type="submit" name="submitmdp" value="Nouveau mot de passe" />
</form>

<?php }elseif($switch=='lien') { ?>
  <a href="modifmdp.php?email=<?php echo $email ?>&token=<?php echo $token ?>">changez de mot de passe</a>
<?php  }elseif($switch=='paix') {

} ?>

<?php if ($switch2==true) { ?>
<form action="" method="post" novalidate>
  <!-- token -->
    <input type="text" id="token_user" name="token_user" value="<?php if(!empty($_POST['token_user'])) { echo $_POST['token_user']; } ?>" placeholder="collé le ici">
    <span class="error"><?php if(!empty($errors['token_user'])) { echo $errors['token_user']; } ?></span>
  <!-- Newpassword -->
    <input type="password" name="Newpassword" id="Newpassword" class="form-control" value="" placeholder="Nouveau Mot De Passe"/>

  <input type="submit" name="submittoken" value="Nouveau mot de passe" />
</form>
<?php } ?>
