<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="asset/css/style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<<<<<<< HEAD
  <title>vaccitek</title>
=======
  <title>Vaccitek | <?php echo $title; ?></title>
>>>>>>> dd2559685c5e7fb23ecca851783fddf40128f8b7
</head>
<body>
  <header>
      <div class="top">
        <div class="wrap">
        <nav class="nav">
          <div class="logo">
            <a href="index.php"><img class="logohome" src="asset/img/logo.png"  alt=""></a>
          </div>
          <div class="menu">
            <ul>
                <?php if(isLogged()) { ?>
                <li><a href="monprofil.php#action"><img class="imgprofil" src="membres/avatars/<?php echo $_SESSION['user']['avatar']; ?>" alt="logo profil"></a></li>
                <?php } ?>
                <li><a href="index.php">Accueil</a></li>
               <?php if(isLogged()) { ?>
                 <?php if ($_SESSION['user']['role']=='admin'){ ?>
                   <li><a href="admin/index.php">Admin</a></li>
                 <?php } ?>
                 <li><a href="carnet.php">Mon Carnet</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
               <?php } else { ?>
                <li><a href="inscription.php#action">Inscription</a></li>
                <li><a href="connexion.php#action">Connexion</a></li>
              <?php } ?>
              <div class="dropdown">
                <li class="dropdown">
                  <a href="javascript:void(0)" class="dropbtn">Informations</a>
                  <div class="dropdown-content">
                    <a href="#">Généralisation <br>sur les vaccins</a>
                    <a href="allvaccin.php">Les maladies <br>et leurs vaccins</a>
                    <a href="mentions.php">Les mentions<br>légales</a>
                  </div>
                </li>
              </div>
            </ul>
          </div>
        </nav>
        <?php if(isLogged()) { ?>
        <div class="Bonjour"><p class="hello">Bonjour <?php echo ucfirst($_SESSION['user']['prenom']); ?></p></div>
       <?php } ?>
      </div>
    </div>
  </header>
  <div class="container">
