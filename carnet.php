<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

$title = 'Mon Carnet';

$id = $_SESSION['user']['id'];

// affcihe le carnet pour pouvoir séléctioner l'id du vaccin
$sql = "SELECT * FROM user_vaccin WHERE user_id = :id";
$var = $pdo->prepare($sql);
$var->bindValue(':id',$id,PDO::PARAM_INT);
$var->execute();
$vaccins_user = $var->fetchall();
// debug($vaccins_user);





include('inc/header.php'); ?>
  <h1>Mon Carnet de Vaccination</h1>
  <div class="carnet">



    <table id="customers">
        <tr>
          <th>Mes Vaccins</th>
          <th>Fait le</th>
          <th>Doses</th>
          <th>Rappel</th>
        </tr>
          <?php foreach ($vaccins_user as $vaccin_user) {
            $idvac = $vaccin_user['vaccin_id'];
            // choisis l'id du vaccin pour ensuite afficher son nom
            $sql = "SELECT * FROM vac_vaccins WHERE id = :idvac";
            $var = $pdo->prepare($sql);
            $var->bindValue(':idvac',$idvac,PDO::PARAM_INT);
            $var->execute();
            $vaccins = $var->fetchAll();
            // debug($vaccins); ?>
            <tr>
                <?php foreach ($vaccins as $vaccin) { ?>
                  <td><?php echo $vaccin['name']; ?></td>
                  <td><?php echo formatageDate2($vaccin_user['fait_at']); ?></td>
                  <td><?php echo $vaccin_user['numero_lot']; ?></td>
                  <td><?php echo $vaccin_user['rappel']; ?></td>
                <?php } ?>
            </tr>
          <?php  }?>

        <tr>
          <th><a href="addvaccin.php">Ajouter un vaccin</a></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
    </table>

  </div>


<?php
include('inc/footer.php');
