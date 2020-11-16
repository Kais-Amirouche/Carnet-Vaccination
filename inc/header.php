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
      <div class="top">
        <div class="wrap">
        <nav class="nav">
          <div class="logo">
            <img class="logohome" src="asset/img/logo.png"  alt="">
          </div>
          <div class="menu">
            <ul>
                <?php if(isLogged()) { ?>
                <li><a href="monprofil.php#action"><img class="imgprofil" src="membres/avatars/<?php echo $_SESSION['user']['avatar']; ?>" alt="logo profil"></a></li>
                <?php } ?>
                <li><a href="index.php">Accueil</a></li>
               <?php if(isLogged()) { ?>
                 <?php if ($_SESSION['user']['role']=='admin'){ ?>
                   <li><a href="admin/index.php">admin</a></li>
                 <?php } ?>
                <li><a href="logout.php">Deconnexion</a></li>
               <?php } else { ?>
                <li><a href="inscription.php#action">Inscription</a></li>
                <li><a href="connexion.php#action">Connexion</a></li>
              <?php } ?>
              <div class="dropdown">
                <li class="dropdown">
                  <a href="javascript:void(0)" class="dropbtn">Dropdown</a>
                  <div class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 4</a>
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
    <img class="backgroundheader" src="asset/img/vac-vac.jpeg" alt="">
        <div class="presentation">
   <div style="position:absolute;top:360px; width:600px; height:400px;">
      <center><b>Mon carnet de vaccination électronique
Pour être mieux vacciné, sans défaut ni excès.
Le carnet de vaccination est un carnet dans lequel sont notées toutes les vaccinations d’une personne. Le professionnel de santé qui vous vaccine (médecin ou infirmier) écrit dans ce carnet :

le nom du vaccin ;
la date de l’injection ;
le numéro du lot (étiquette) ;
la date du prochain vaccin à faire.
Ce carnet est très pratique : il vous permet de savoir quelles vaccinations vous avez reçues et si vous êtes à jour de vos vaccinations. Il faut donc le ranger précieusement pour ne pas le perdre et ne pas oublier de le présenter au professionnel de santé à chaque fois que vous vous faites vacciner. Il est valable toute la vie !

Pour l’obtenir, il suffit de le demander aux professionnels de santé. Il est gratuit.

À noter : Pour les enfants, le carnet de santé sert aussi de carnet de vaccination. Le carnet de vaccination remplace le carnet de santé lorsque l’on est adulte (surtout si on ne retrouve plus son carnet de santé).</b></center>
    </div>
</div>
  </header>
  <div class="container">
