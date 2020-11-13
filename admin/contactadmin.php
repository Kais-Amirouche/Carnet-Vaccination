<?php
include('../inc/pdo.php');
include('../inc/function.php');

$title = 'Questions';

// afficher toutes les questions en attente
$sql = "SELECT * FROM vac_contact WHERE statuts = 'attente' ORDER BY created_at ASC";
$var = $pdo->prepare($sql);
$var->execute();
$questions = $var->fetchAll();

// afficher toutes les questions ok
$sql = "SELECT * FROM vac_contact WHERE statuts = 'ok' ORDER BY created_at ASC";
$var = $pdo->prepare($sql);
$var->execute();
$questionsOk = $var->fetchAll();

include('inc/header-back.php'); ?>

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Questions</h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">En attente</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>E-mail</th>
                          <th>Question</th>
                          <th>Statut</th>
                          <th>Répondre</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>E-mail</th>
                        <th>Question</th>
                        <th>Statut</th>
                        <th>Répondre</th>
                      </tr>
                  </tfoot>
                  <tbody>
                <?php foreach ($questions as $question) { ?>
                      <tr>
                          <td><?php echo $question['email']; ?></td>
                          <td><?php echo $question['message']; ?></td>
                          <td><?php echo $question['statuts']; ?></td>
                          <td><a href="editcontact.php?id=<?php echo $question['id']; ?>">Répondre</a></td>
                      </tr>
                <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Répondue</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>E-mail</th>
                          <th>Question</th>
                          <th>Statut</th>
                          <th>Réponse</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>E-mail</th>
                        <th>Question</th>
                        <th>Statut</th>
                        <th>Réponse</th>
                      </tr>
                  </tfoot>
                  <tbody>
                <?php foreach ($questionsOk as $questionOk) { ?>
                      <tr>
                          <td><?php echo $questionOk['email']; ?></td>
                          <td><?php echo $questionOk['message']; ?></td>
                          <td><?php echo $questionOk['statuts']; ?></td>
                          <td><?php echo $questionOk['answer']; ?></td>
                      </tr>
                <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>

<?php include('inc/footer-back.php');
