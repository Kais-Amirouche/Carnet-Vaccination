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

$title = 'Utilisateurs';

// afficher les détails utilisateurs
$sql = "SELECT * FROM vac_users ORDER BY created_at ASC";
$var = $pdo->prepare($sql);
$var->execute();
$users = $var->fetchAll();
// debug($users);




include('inc/header-back.php'); ?>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Utilisateurs</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Date de naissance</th>
                                            <th>E-mail</th>
                                            <th>Role</th>
                                            <th>Date d'inscription</th>
                                            <th>Carnet</th>
                                        </tr>

                                    </thead>
                                    <tfoot>
                                        <tr>
                                          <th>ID</th>
                                          <th>Nom</th>
                                          <th>Prénom</th>
                                          <th>Date de naissance</th>
                                          <th>E-mail</th>
                                          <th>Role</th>
                                          <th>Date d'inscription</th>
                                          <th>Carnet</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                  <?php foreach ($users as $user) { ?>
                                        <tr>
                                            <td><?php echo $user['id']; ?></td>
                                            <td><?php echo $user['nom']; ?></td>
                                            <td><?php echo $user['prenom']; ?></td>
                                            <td><?php echo $user['birth_date']; ?></td>
                                            <td><?php echo $user['email']; ?></td>
                                            <td><?php echo $user['role'];
                                              if($user['role'] == 'admin') { ?>
                                                <a href="deleteadmin.php?id=<?php echo $user['id']; ?>">[passer abonne]</a>
                                              <?php } else {?>
                                                <a href="upadmin.php?id=<?php echo $user['id']; ?>">[passer admin]</a>
                                              <?php } ?>
                                            </td>
                                            <td><?php echo $user['created_at']; ?></td>
                                            <td>[<a href="carnetadmin.php?id=<?php echo $user['id']; ?>">voir son carnet</a>]</td>
                                        </tr>
                                  <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


<?php include('inc/footer-back.php');
