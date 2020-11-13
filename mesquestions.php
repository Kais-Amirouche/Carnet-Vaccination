<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

$title = 'Mes Questions';




include('inc/header.php'); ?>

<h2>En attente</h2>
<?php// afficher les questions en attente de l'utilisateur
// si l'email correspondont à l'email de lutilisateur, alors on affiche ses questions 'attente' / sinon on affiche rien
?>
<h2>Répondue</h2>
<?php// afficher les questions ok de l'utilisateur
// si l'email correspondont à l'email de lutilisateur, alors on affiche ses questions 'ok' / sinon on affiche rien
?>

<?php include('inc/footer.php');
