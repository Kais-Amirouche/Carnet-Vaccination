<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

$title = 'Mon Carnet';


include('inc/header.php'); ?>
  <div class="carnet">

    <h2>Mon Carnet de Vaccination</h2>

    <table>
      <thead>
        <tr>
          <th>Vaccin</th>
          <th>Couleur(à changer)</th>
          <th>Rappel</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php //echo $user['id']; ?></td>
          <td><?php //echo $user['id']; ?></td>
          <td><?php //echo $user['id']; ?></td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <th><a href="addvaccin.php">Ajouter un vaccin</a></th>
        </tr>
      </tfoot>
    </table>

  </div>


<?php
include('inc/footer.php');
