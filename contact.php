<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');


$errors = array();
$succes = false;
if(!empty($_POST['submitted']))
{
  $email = cleanXss($_POST['email']);
  $message = cleanXss($_POST['message']);

  //email
  if(!empty($email))
  {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $errors['email'] = 'Veuillez renseigner un e-mail valide.';
    }
  } else {
    $errors['email'] = 'Veuillez renseigner un e-mail.';
  }

  //message
  $errors = validationText($errors,$message,'message',10,2000);

  //pas d'erreurs
  if(count($errors) == 0)
  {
    $sql = "INSERT INTO vac_contact (email,message,statuts,created_at)
            VALUES (:email,:message,'attente',NOW())";
    $var = $pdo->prepare($sql);
    $var->bindValue(':email',$email,PDO::PARAM_STR);
    $var->bindValue(':message',$message,PDO::PARAM_STR);
    $var->execute();
    $succes = true;
  }
}

include('inc/header.php'); ?>

<section>


  <a class="ask1" href="mesquestions.php?email=<?php echo $_SESSION['user']['email'];?>">Mes questions</a>
  <?php if($succes == true) {?>

    <p class="succes">Votre message a bien été envoyé !</p>

  <?php } else { ?>

    <form action="" method="post">
      <div class="form-container">
        <div class="form-group">
          <input type="email" id="email" name="email" value="<?php if(!empty($_POST['email'])) {echo $_POST['email'];} ?>" placeholder="Votre e-mail"> <br>
          <span class="error"><?php if(!empty($errors['email'])) {echo $errors['email'];} ?></span>
        </div>

        <div class="form-group">
          <textarea id="message" name="message" placeholder="Votre message" rows="6" cols="50"><?php if(!empty($_POST['message'])) {echo $_POST['message'];} ?></textarea> <br>
          <span class="error"><?php if(!empty($errors['message'])) {echo $errors['message'];} ?></span>
        </div>

        <div class="form-group">
          <input type="submit" name="submitted" value="Envoyer">
        </div>
      </div>
    </form>

  <?php } ?>









<?php include('inc/footer.php');
