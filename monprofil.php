<?php
session_start();


include('inc/pdo.php');
include('inc/function.php');



if(!empty($_SESSION['user']['id'])) {
    $sql = "SELECT * FROM vac_users WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($_SESSION['user']['id']));
    $user = $query->fetch();
    debug($user);
    if(isset($_POST['prenom']) AND !empty($_POST['prenom']) AND $_POST['prenom'] != $user['prenom']) {
       $newprenom = cleanXss($_POST['prenom']);
       $insertmail = $pdo->prepare("UPDATE vac_users SET email = ? WHERE id = ?");
       $insertmail->execute(array($newprenom, $user['id']));
       $valid= '<p style="color:green;">ce champ a bien été modifié</p>';
    }
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email']) {
      $newmail = cleanXss($_POST['newmail']);
      $insertmail = $pdo->prepare("UPDATE vac_users SET email = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $user['id']));
      $valid= '<p style="color:green;">ce champ a bien été modifié</p>';
   }
   if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
    $tailleMax = 2097152;
    $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
    if($_FILES['avatar']['size'] <= $tailleMax) {
       $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
       if(in_array($extensionUpload, $extensionsValides)) {
          $chemin = "membres/avatars/".$_SESSION['user']['id'].".".$extensionUpload;
          $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
          if($resultat) {
             $updateavatar = $pdo->prepare('UPDATE vac_users SET avatar = :avatar WHERE id = :id');
             $updateavatar->execute(array(
                'avatar' => $user['id'].".".$extensionUpload,
                'id' => $user['id']
                ));
             header('Location: monprofil.php');
          } else {
             $errors = "Erreur durant l'importation de votre photo de profil";
          }
       } else {
          $errors = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
       }
    } else {
       $errors = "Votre photo de profil ne doit pas dépasser 2Mo";
    }
   }
}





include('inc/header.php');?>
<h2>Edition de mon profil</h2>
<form method="POST" action="" enctype="multipart/form-data">
  <label>prenom :<?php if(!empty($valid)){ echo $valid; } ?></label>
  <input type="text" name="prenom" id="prenom" class="form-control" value="<?php if(!empty($_POST['prenom'])) { echo $_POST['prenom']; }else {echo $user['prenom'];} ?>" placeholder="prenom" />
  <span class="error"><?php if(!empty($errors['prenom'])) { echo $errors['prenom']; } ?></span>
  <label>Email :<?php if(!empty($valid)){ echo $valid; } ?></label>
  <input type="text" name="newmail" placeholder="Email" value="<?php echo $user['email']; ?>" /><br /><br />
  <!-- PASSWORD1 -->
  <label>Mot de Passe :</label>
  <input type="password" name="password1" id="password1" class="form-control" value="" placeholder="Mot De Passe"/>
  <span class="error"><?php if(!empty($errors['password'])) { echo $errors['password']; } ?></span>
  <!-- PASSWORD2 -->
  <label>Confirmer le Mot de Passe :</label>
  <input type="password" name="password2" id="password2" class="form-control" value="" placeholder="Confirmer Le Mot De Passe"/>
  <span class="error"><?php if(!empty($errors['password2'])) { echo $errors['password2']; } ?></span>
  <!-- photo de profil -->
  <label>photo de profil:<?php if(!empty($errors['avatar'])) { echo $errors['avatar']; } ?></label>
  <input type="file" name="avatar" value="">
  <span class="error"><?php if(!empty($errors['avatar'])) { echo $errors['avatar']; } ?></span>
  <input type="submit" value="Mettre à jour mon profil !" />
</form>









<?php include('inc/footer.php');
