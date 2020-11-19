<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

if(isLogged()){
  if (($_SESSION['user']['role']=='admin') || $_SESSION['user']['role']=='abonne'){
    header('Location: connexion.php');
    die();
  }
}else {
  header('Location: connexion.php');
  die();
}

$title = 'Mon Profil';

if(!empty($_SESSION['user']['id'])) {
    $sql = "SELECT * FROM vac_users WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($_SESSION['user']['id']));
    $user = $query->fetch();
    // debug($user);
    $token =$user['token'];
    $email= $user['email'];
    if(isset($_POST['prenom']) AND !empty($_POST['prenom']) AND $_POST['prenom'] != $user['prenom']) {
       $newprenom = cleanXss($_POST['prenom']);
       $insertprenom = $pdo->prepare("UPDATE vac_users SET prenom = ? WHERE id = ?");
       $insertprenom->execute(array($newprenom, $user['id']));
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
             $errors['avatar'] = "Erreur durant l'importation de votre photo de profil.";
          }
       } else {
          $errors['avatar'] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png.";
       }
    } else {
       $errors['avatar'] = "Votre photo de profil ne doit pas dépasser 2Mo.";
    }
   }
}




include('inc/header.php');?>

<h1 id="action">Edition de mon profil</h1>
<form method="POST" action="" enctype="multipart/form-data">
  <label for="prenom">prenom :<?php if(!empty($valid)){ echo $valid; } ?></label>
  <input type="text" id="prenom" name="prenom" id="prenom" class="form-control" value="<?php if(!empty($_POST['prenom'])) { echo $_POST['prenom']; }else {echo $user['prenom'];} ?>" placeholder="prenom" />
  <span class="error"><?php if(!empty($errors['prenom'])) { echo $errors['prenom']; } ?></span>
  <label for="email"for>Email :<?php if(!empty($valid)){ echo $valid; } ?></label>
  <input type="text" id="email"name="newmail" placeholder="Email" value="<?php echo $user['email']; ?>" /><br /><br />
  <!-- Newpassword -->
  <label for="tok" class="copier">copier ceci pour modifié votre mot de passe:</label>
  <textarea id="tok" class="tokencopié" name="tokencopié" rows="8" cols="80"> <?php echo $user['token'] ?></textarea>
  <a class="redirect" href="reset-password.php?email=<?php echo $email ?>&token=<?php echo $token ?>">changez de mot de passe</a><br /><br />
  <!-- photo de profil -->
  <label for="avatar" class="label-file"><p>changez votre avatar</p><img class="avatarimg" src="asset/img/avatar.png" alt=""></label>
  <input type="file" class="input-file" id="avatar" name="avatar" value="">
  <span class="error"><?php if(!empty($errors['avatar'])) { echo $errors['avatar']; } ?></span>
  <input type="submit" name="submitprofil" value="Mettre à jour mon profil !" />
</form>









<?php include('inc/footer.php');
