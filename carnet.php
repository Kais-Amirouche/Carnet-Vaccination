<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');



$id = $_SESSION['user']['id'];

$sql = "SELECT * FROM user_vaccin";
$query = $pdo->prepare($sql);
$query->execute();
$vaccin_user = $query->fetchall();
debug($vaccin_user);
foreach ($vaccin_user as $idvac) {
  debug($idvac['vaccin_id']);
}

$sql = "SELECT * FROM vac_vaccins WHERE id = :vaccin_id";
$query = $pdo->prepare($sql);
$query->bindValue(':vaccin_id',$idvac['vaccin_id'],PDO::PARAM_INT);
$query->execute();
$vaccins = $query->fetchall();
debug($vaccins);
include('inc/header.php'); ?>
  <div class="carnet">

    <h1>Mon Carnet de Vaccination</h1>

    <table id="customers">
        <tr>
          <th>Mes Vaccins</th>
          <th>status</th>
          <th>Doses</th>
          <th>Rappel</th>
        </tr>
        <tr>
          <?php echo '<td></td>
                      <td></td>
                      <td></td>
                      <td></td>'; ?>
        </tr>
        <tr>
          <th><a href="addvaccin.php">Ajouter un vaccin</a></th>
        </tr>
    </table>

  </div>


<?php
include('inc/footer.php');
