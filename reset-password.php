<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');
$errors = array();
debug($_SESSION);
$id = $_SESSION['user']['id'];
if(!empty($_GET['email']) && !empty($_GET['token'])) {
  $email = $_GET['email'];
  $token = $_GET['token'];
  $switch2=true;
  $switch='paix';
  if (!empty($_POST['submittoken'])) {
    $token_user  = cleanXss($_POST['token']);
    $Newpassword = cleanXss($_POST['Newpassword']);
    $errors = ValidationText($errors,$token_user,'token',120,121);
    $errors = ValidationText($errors,$Newpassword,'Newpassword',5,120);
    if(count($errors) == 0) {
        if ($token_user==$token) {
          $hashPassword = password_hash($Newpassword,PASSWORD_DEFAULT);
          $token = generateRandomString(120);
          $sql = "UPDATE vac_users SET token=:token, password=:password WHERE id=:id";
          $query = $pdo->prepare($sql);
          $query->bindValue(':token',$token,PDO::PARAM_STR);
          $query->bindValue(':password',$hashPassword,PDO::PARAM_STR);
          $query->bindValue(':id',$id,PDO::PARAM_INT);
          $query->execute();
        }else {
          die('not');
        }
    }
  }
}


include('inc/header.php');?>



<?php if ($switch2==true) { ?>
<form action="" method="post" novalidate>
  <!-- token -->
    <input type="text" id="token" name="token" value="<?php if(!empty($_POST['token'])) { echo $_POST['token']; } ?>" placeholder="collé le ici">
    <span class="error"><?php if(!empty($errors['token'])) { echo $errors['token']; } ?></span>
  <!-- Newpassword -->
    <input type="password" name="Newpassword" id="Newpassword" class="form-control" value="" placeholder="Nouveau Mot De Passe"/>

  <input type="submit" name="submittoken" value="Nouveau mot de passe" />
</form>
<?php } ?>
  </div>
