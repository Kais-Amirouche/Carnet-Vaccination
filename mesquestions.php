<?php

session_start();
include('inc/pdo.php');
include('inc/function.php');

if(!isLogged()){
  header('Location: connexion.php');
}


$title = 'Mes Questions';

$email = $_SESSION['user']['email'];

$sql = "SELECT * FROM vac_contact WHERE email = :email AND statuts = 'attente'";
$var = $pdo->prepare($sql);
$var->bindValue(':email',$email,PDO::PARAM_STR);
$var->execute();
$asksAttente = $var->fetchAll();
// debug($asksAttente);

$sql = "SELECT * FROM vac_contact WHERE email = :email AND statuts = 'ok'";
$var = $pdo->prepare($sql);
$var->bindValue(':email',$email,PDO::PARAM_STR);
$var->execute();
$asksOk = $var->fetchAll();
// debug($asksOk);



include('inc/header.php'); ?>
<div class="ask-attente">
  <h2>En attente:</h2>
    <div class="content-ask">
   <!-- afficher les questions en attente de l'utilisateur
   si l'email correspondont à l'email de lutilisateur, alors on affiche ses questions 'attente' / sinon on affiche rien -->
    <?php foreach ($asksAttente as $askAttente) { ?>
      <p>Votre question:</p>
      <p><?php echo $askAttente['message']; ?></p>
      <p><?php echo formatageDate($askAttente['created_at']); ?></p>
    <?php } ?>
    </div>
</div>

<div class="ask-update">
  <h2>A jour:</h2>
    <div class="content-ask">
  <!-- afficher les questions ok de l'utilisateur
  si l'email correspondont à l'email de lutilisateur, alors on affiche ses questions 'ok' / sinon on affiche rien -->
    <?php foreach ($asksOk as $askOk) { ?>
      <h3>Votre question:</h3>
      <p><?php echo $askOk['message']; ?></p>
      <p><?php echo formatageDate($askOk['created_at']); ?></p>
      <h3>La réponse:</h3>
      <p><?php echo $askOk['answer']; ?></p>
      <p><?php echo formatageDate($askOk['updated_at']); ?></p>
    <?php } ?>
    </div>
</div>

<?php include('inc/footer.php');
