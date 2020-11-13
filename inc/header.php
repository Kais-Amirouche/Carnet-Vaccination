<!DOCTYPE html>
<html lang="fr">
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
            <img class="logohome" src="asset/img/logo.png"  alt="">
          </div>
          <div class="menu">
            <ul>
                <?php if(isLogged()) { ?>
                <li><a href="monprofil.php"><img class="imgprofil" src="membres/avatars/<?php echo $_SESSION['user']['avatar']; ?>" alt="logo profil"></a></li>
                <?php } ?>
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
                <li><a href="singlevaccin.php?id=">Information vaccins</a></li>
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
