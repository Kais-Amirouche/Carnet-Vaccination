<?php
include('../inc/pdo.php');
include('../inc/function.php');

$title = 'Répondre aux questions';

$errors = array();

if(!empty($_GET['id']) && is_numeric($_GET['id']))
{
  $id = $_GET['id'];
  $sql = "SELECT * FROM vac_contact WHERE id = :id";
  $var = $pdo->prepare($sql);
  $var->bindValue(':id',$id,PDO::PARAM_INT);
  $var->execute();
  $question = $var->fetch();
  debug($question);

  if(!empty($question))
  {

    if(!empty($_POST['submitted']))
    {
      $answer = cleanXss($_POST['answer']);
      $errors = validationText($errors,$answer,'answer',10,2000);

      if(count($errors) == 0)
      {
        $sql = "UPDATE vac_contact SET statuts = 'ok', answer = :answer, updated_at = NOW() WHERE id = :id";
        $var = $pdo->prepare($sql);
        $var->bindValue(':answer',$answer,PDO::PARAM_STR);
        $var->bindValue(':id',$id,PDO::PARAM_INT);
        $var->execute();

        header('Location: contactadmin.php');
        die();
      }
    }
  } else {
    // header('Location: 404.php');
    // die();
  }

} else {
  // header('Location: 404.php');
  // die();
}

include('inc/header-back.php'); ?>

  <div class="question">
    <h3>Répondre à la question.</h3>
    <p>De: <?php if(!empty($_POST['email'])) {echo $_POST['email'];}else {echo $question['email'];} ?></p>
    <p>Question: <?php if(!empty($_POST['message'])) {echo $_POST['message'];}else {echo $question['message'];} ?></p>
    <p>Publié le: <?php if(!empty($_POST['created_at'])) { echo formatageDate($_POST['created_at']);}else { echo formatageDate($question['created_at']);} ?></p>
  </div>



<form action="" method="post">

  <textarea id="answer" name="answer" placeholder="Répondre à la question"></textarea>
  <span class="error"><?php if(!empty($errors['answer'])) {echo $errors['answer'];} ?></span>

  <input type="submit" name="submitted" value="Répondre">

</form>



<?php include('inc/footer-back.php');
