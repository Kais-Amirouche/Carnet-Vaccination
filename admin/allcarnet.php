<?php
session_start();
include('../inc/pdo.php');
include('../inc/function.php');
if(isLogged()){
  if ($_SESSION['user']['role']!='admin'){
    header('Location: ../connexion.php#action');
    die();
  }
}else {
  header('Location: ../connexion.php#action');
  die();
}

$title = 'Carnets';

// affiche tous les carnets, de tous les users
$sql = "SELECT * FROM user_vaccin ORDER BY id ASC";
$var = $pdo->prepare($sql);
$var->execute();
$carnets = $var->fetchAll();
// debug($carnets);

include('inc/header-back.php'); ?>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Carnets</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Utilisateur</th>
                          <th>Vaccin</th>
                          <th>Fait le</th>
                          <th>Rappel</th>
                          <th>Dose</th>
                      </tr>

                  </thead>
                  <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Utilisateur</th>
                        <th>Vaccin</th>
                        <th>Fait le</th>
                        <th>Rappel</th>
                        <th>Dose</th>
                      </tr>
                  </tfoot>
                  <tbody>
                <?php foreach ($carnets as $carnet) { ?>
                      <tr>
                          <td><?php echo $carnet['id']; ?></td>
                          <td><?php echo $carnet['user_id']; ?></td>
                          <td><?php echo $carnet['vaccin_id']; ?></td>
                          <td><?php echo formatageDate2($carnet['fait_at']); ?></td>
                          <td><?php echo $carnet['rappel']; ?></td>
                          <td><?php echo $carnet['numero_lot']; ?></td>
                      </tr>
                <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>


<?php include('inc/footer-back.php');
