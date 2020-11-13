<?php
// connexion
session_start();
include('inc/pdo.php');
include('inc/function.php');
$errors = array();
// if form soumis
if(!empty($_POST['submitconnexion'])) {
  // Faille XSS
  $login    = cleanXss($_POST['login']);
  $password = cleanXss($_POST['password']);
  if(!empty($login) && !empty($password)) {
    // request  users si il ya un user qui a soit email
    $sql = "SELECT * FROM vac_users WHERE email = :login";
    $query = $pdo->prepare($sql);
    $query->bindValue(':login',$login,PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();
    debug($user);
    // die();
    if(!empty($user)) { // $user existe pas => $error = 'erreur credentials'
      // password_verify()
      // die();
      if (password_verify($password, $user['password'])) {
        // die();
        // ok connexion possible
          // nourrir $_SESSION avec des données
        $_SESSION['user'] = array(
          'id'     => $user['id'],
          'email'  => $user['email'],
          'prenom' => $user['prenom'],
          'role'   => $user['role'],
          'avatar' => $user['avatar'],
          'ip'     => $_SERVER['REMOTE_ADDR'] // ::1
        );
        // redirection index.php
        header('Location: index.php');
        die();
      } else {
        $errors['login'] = 'Error credentials';
      }
    } else {
      $errors['login'] = 'Error credentials';
    }
  } else {
    $errors['login'] = 'Veuillez renseigner les champs';
  }
}

include('inc/header.php'); ?>
<h1>Connexion</h1>
  <form action="" method="post">
    <!-- LOGIN -->
      <input type="text" id="login" name="login" value="<?php if(!empty($_POST['login'])) { echo $_POST['login']; } ?>" placeholder="Email">
      <span class="error"><?php if(!empty($errors['login'])) { echo $errors['login']; } ?></span>
    <!-- PASSWORD -->
      <input type="password" name="password" id="password" class="form-control" value="" placeholder="Mot De Passe"/>

    <input type="submit" name="submitconnexion" value="Connexion" />
  </form>
  <div class="mdp">
    <a href="modifmdp.php">mot de passe oublié ?</a>
  </div>
<?php include('inc/footer.php');
