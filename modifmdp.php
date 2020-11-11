<?php
// connexion
session_start();
include('inc/pdo.php');
include('inc/function.php');
$errors = array();
$switch = false;
// if form soumis
if(!empty($_POST['submitmdp'])) {
  // Faille xss
  $login  = trim(strip_tags($_POST['login']));
  // validation
  $errors = ValidationText($errors,$login,'login',3,100);
  // si no error
  if(count($errors) == 0) {
    if(!empty($login)) {
      // request  users si il ya un user qui a soit email
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

      } else {
        $errors['login'] = 'Error credentials';
        }
    }
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
  <a href="modifmdp.php?email=<?php echo $email ?>&token=<?php echo $token ?>">changez de mot de passe</a>
<?php } ?>
