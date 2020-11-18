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

$title = 'Vaccins';

// afficher les détails vaccins
$sql = "SELECT * FROM vac_vaccins ORDER BY id ASC";
$var = $pdo->prepare($sql);
$var->execute();
$vaccins = $var->fetchAll();
// debug($vaccins);

include('inc/header-back.php'); ?>

  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Vaccins</h6>
          <p>[<a href="addvaccin.php">Ajout de vaccin</a>]</p>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Nom</th>
                          <th>A quel âge</th>
                          <th>Description</th>
                          <th>Rappel</th>
                          <th>Statut</th>
                      </tr>

                  </thead>
                  <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>A quel âge</th>
                        <th>Description</th>
                        <th>Rappel</th>
                        <th>Statut</th>
                      </tr>
                  </tfoot>
                  <tbody>
                <?php foreach ($vaccins as $vaccin) { ?>
                      <tr>
                          <td><?php echo $vaccin['id']; ?></td>
                          <td><?php echo $vaccin['name']; ?><br>[<a href="editvaccin.php?id=<?php echo $vaccin['id']; ?>">edit</a>][<a href="deletevaccin.php?id=<?php echo $vaccin['id']; ?>">delete</a>]</td>
                          <td><?php echo $vaccin['age']; ?></td>
                          <td><?php echo $vaccin['description']; ?></td>
                          <td><?php echo $vaccin['rappel']; ?></td>
                          <td><?php echo $vaccin['statuts']; ?></td>
                          </tr>
                <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>

<?php  include('inc/footer-back.php');
