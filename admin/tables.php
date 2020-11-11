<?php
include('../inc/pdo.php');
include('../inc/function.php');

$title = 'Tableaux';

$sql = "SELECT * FROM vac_users ORDER BY created_at ASC";
$var = $pdo->prepare($sql);
$var->execute();
$users = $var->fetchAll();
// debug($users);

$sql = "SELECT * FROM vac_vaccins ORDER BY id ASC";
$var = $pdo->prepare($sql);
$var->execute();
$vaccins = $var->fetchAll();
// debug($vaccins);


include('inc/header-back.php'); ?>


                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tableaux</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

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
                                            <td><?php echo $user['role']; ?></td>
                                            <td><?php echo $user['created_at']; ?></td>
                                        </tr>
                                  <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Vaccins</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>A quel âge</th>
                                            <th>Description</th>
                                        </tr>

                                    </thead>
                                    <tfoot>
                                        <tr>
                                          <th>Nom</th>
                                          <th>A quel âge</th>
                                          <th>Description</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                  <?php foreach ($vaccins as $vaccin) { ?>
                                        <tr>
                                            <td><?php echo $vaccin['name']; ?></td>
                                            <td><?php echo $vaccin['date']; ?></td>
                                            <td><?php echo $vaccin['date']; ?></td>
                                            </tr>
                                  <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


<?php include('inc/footer-back.php');
