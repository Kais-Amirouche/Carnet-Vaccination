<?php
// connexion
session_start();
include('inc/pdo.php');
include('inc/function.php');
$errors = array();
$switch = false;
// if form soumis
if(!empty($_POST['submitmdp'])) {
  $login    = cleanXss($_POST['login']);

  if(!empty($login) && !empty($password)) {
    // request  users si il ya un user qui a soit email
    $sql = "SELECT * FROM vac_users WHERE email = :login";
    $query = $pdo->prepare($sql);
    $query->bindValue(':login',$login,PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();
    // debug($user);
    // die();
    if(!empty($user)) { // $user existe pas => $error = 'erreur credentials'

      $switch = true;
    } else {
      $errors['login'] = 'Error credentials';
    }
  } else {
    $errors['login'] = 'Veuillez renseigner les champs';
  }

}


include('inc/header.php'); ?>
<?php if ($switch==false) { ?>
<form action="" method="post">
  <!-- LOGIN -->
    <input type="text" id="login" name="login" value="<?php if(!empty($_POST['login'])) { echo $_POST['login']; } ?>" placeholder="Email">
    <span class="error"><?php if(!empty($errors['login'])) { echo $errors['login']; } ?></span>

  <input type="submit" name="submitmdp" value="Nouveau mot de passe" />
</form>

<?php }else { ?>
  <a href="modifmdp.php?email=<?php echo $email ?>&token=<?php echo $token ?>"></a>
<?php } ?>
