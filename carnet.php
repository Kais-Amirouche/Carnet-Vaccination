<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

$title = 'Mon Carnet';

debug($_SESSION);

include('inc/header.php'); ?>
  <div class="carnet">

    <h2>Mon Carnet de Vaccination</h2>

    <table id="customers">
        <tr>
          <th>Mes Vaccin</th>
          <th>status</th>
          <th>Doses</th>
          <th>Rappel</th>
        </tr>
        <tr>
          <td><?php echo $_SESSION['user']['id']; ?></td>
          <td><?php echo $_SESSION['user']['id']; ?></td>
          <td><?php echo $_SESSION['user']['id']; ?></td>
          <td><?php echo $_SESSION['user']['id']; ?></td>
        </tr>
        <tr>
          <th><a href="addvaccin.php">Ajouter un vaccin</a></th>
        </tr>
    </table>

  </div>


<?php
include('inc/footer.php');
