<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="asset/css/style.css">
  <title>mon carnet santé</title>
</head>
<body>

  <header>
    <div class="top">
      <nav>
        <ul>
          <div class="log">
            <img src="asset/img/logo.png" width="50px" alt="">
          </div>
          <div class="menu">
            <li><a href="index.php">Accueil</a></li>
           <?php if(isLogged()) { ?>
             <?php if ($_SESSION['user']['role']=='admin'){ ?>
               <li><a href="admin\index.html">admin</a></li>
             <?php } ?>
            <li><a href="logout.php">Deconnexion</a></li>
            <li><p class="Bonjour">Bonjour <?php echo ucfirst($_SESSION['user']['prenom']); ?></p></li>
           <?php } else { ?>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="connexion.php">Connexion</a></li>
          <?php } ?>
          </div>
        </ul>
      </nav>
    </div>
  </header>
  <div class="container">
