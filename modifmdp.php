<?php
// connexion
session_start();
include('inc/pdo.php');
include('inc/function.php');
$errors = array();
$switch = false;
$switch2=false;

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
        $id = $user['id'];
        $token = $user['token'];
        if(!empty($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['token'])) {
          $switch2 = true;
          echo 'copié le: '.$token;
        }else {

          }
      } else {
        $errors['login'] = 'Error credentials';
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

<?php }else { ?>
  <a href="modifmdp.php?id=<?php echo $id ?>&token=<?php echo $token ?>">changez de mot de passe</a>
<?php $switch2 = true; } ?>
<?php if ($switch2==true) { ?>
<form action="" method="post" novalidate>
  <!-- token -->
    <input type="text" id="token_user" name="token_user" value="<?php if(!empty($_POST['token_user'])) { echo $_POST['token_user']; } ?>" placeholder="collé le ici">
    <span class="error"><?php if(!empty($errors['token_user'])) { echo $errors['token_user']; } ?></span>
  <!-- PASSWORD -->
    <input type="password" name="password" id="password" class="form-control" value="" placeholder="Nouveau Mot De Passe"/>

  <input type="submit" name="submittoken" value="Nouveau mot de passe" />
</form>
<?php } ?>
