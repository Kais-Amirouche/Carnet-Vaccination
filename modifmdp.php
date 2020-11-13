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
      // debug($user);
      // die();
      if(!empty($user)) { // $user existe pas => $error = 'erreur credentials'
        $switch=true;
        $_SESSION['user'] = array(
          'id'     => $user['id'],
          'email' => $user['email'],
          'token'   => $user['token'],
          'ip'     => $_SERVER['REMOTE_ADDR'] // ::1
        );
        $token =$user['token'];
        $email= $user['email'];
        $switch='lien';
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
  <div class="loginn">
    <input type="text" id="login" name="login" value="<?php if(!empty($_POST['login'])) { echo $_POST['login']; } ?>" placeholder="Email">
    <span class="error"><?php if(!empty($errors['login'])) { echo $errors['login']; } ?></span>

  <input type="submit" name="submitmdp" value="recevoir un mail" />
</form>

<?php }elseif($switch=='lien') { echo '<p class=token><span>copié ceci:</span><br>'.$token.'</p>';?>
  <div class="newmdp">
      <a href="reset-password.php?email=<?php echo $email ?>&token=<?php echo $token ?>">changez de mot de passe</a>
  </div>
<?php  }elseif($switch=='paix') {

} ?>
