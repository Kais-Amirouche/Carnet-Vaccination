<?php
include('inc/pdo.php');
include('inc/function.php');
$errors = array();
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
          die('ok');
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
    <input type="text" id="token_user" name="token_user" value="<?php if(!empty($_POST['token_user'])) { echo $_POST['token_user']; } ?>" placeholder="collé le ici">
    <span class="error"><?php if(!empty($errors['token_user'])) { echo $errors['token_user']; } ?></span>
  <!-- Newpassword -->
    <input type="password" name="Newpassword" id="Newpassword" class="form-control" value="" placeholder="Nouveau Mot De Passe"/>

  <input type="submit" name="submittoken" value="Nouveau mot de passe" />
</form>
<?php } ?>
  </div>
