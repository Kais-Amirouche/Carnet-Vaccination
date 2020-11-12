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
    <div class="wrap">
      <div class="top">
        <nav class="nav">
          <div class="logo">
            <img src="asset/img/logo.png" width="70px" alt="">
          </div>
          <div class="menu">
            <ul>
                <li><a href="index.php">Accueil</a></li>
               <?php if(isLogged()) { ?>
                 <?php if ($_SESSION['user']['role']=='admin'){ ?>
                   <li><a href="admin/index.php">admin</a></li>
                 <?php } ?>
                <li><a href="logout.php">Deconnexion</a></li>
               <?php } else { ?>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connexion.php">Connexion</a></li>
              <?php } ?>
            </ul>
          </div>
        </nav>
        <?php if(isLogged()) { ?>
        <div class="Bonjour"><p>Bonjour <?php echo ucfirst($_SESSION['user']['prenom']); ?></p></div>
       <?php } ?>
      </div>
    </div>

  </header>
  <div class="container">
