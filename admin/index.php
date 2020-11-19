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

$title = 'Dashboard';

include('inc/header-back.php'); ?>


                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Connectés -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Nombre d'utilisateurs connectés</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                              <?php
                                              echo '?';
                                              ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Utilisateurs -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Nombre d'utilisateurs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                              <?php
                                              // nombre d'utilisateurs inscrit sur notre site
                                              $sql = "SELECT * FROM vac_users";
                                              $var = $pdo->prepare($sql);
                                              $var->execute();
                                              $usersAll = $var->rowCount();
                                              echo $usersAll;
                                              ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Vaccins -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nombre de vaccin recensé sur le site
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                      <?php
                                                      $sql = "SELECT * FROM vac_vaccins";
                                                      $var = $pdo->prepare($sql);
                                                      $var->execute();
                                                      $vaccinsAll = $var->rowCount();
                                                      echo $vaccinsAll;
                                                      ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Questions -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Questions en attente</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                              <?php
                                              // nombre d'utilisateurs inscrit sur notre site
                                              $sql = "SELECT * FROM vac_contact WHERE statuts = 'attente'";
                                              $var = $pdo->prepare($sql);
                                              $var->execute();
                                              $asksAll = $var->rowCount();
                                              echo $asksAll;
                                              ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                            <!-- Avancement -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projets</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">La base de données<span
                                            class="float-right">100%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Affichage des tableaux<span
                                            class="float-right">98%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 98%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Inscription/Connexion/Deconnexion<span
                                            class="float-right">100%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 100%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Questions/Réponses<span
                                            class="float-right">100%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Profil utilisateur<span
                                            class="float-right">100%</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>


<?php include('inc/footer-back.php');
