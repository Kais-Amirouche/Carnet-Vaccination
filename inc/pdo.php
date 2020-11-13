<?php
  try {
<<<<<<< HEAD
    $pdo = new PDO('mysql:host=localhost;dbname=phpmyadmin', "root", "", array(
=======
    $pdo = new PDO('mysql:host=localhost;dbname=vaccin', "root", "root", array(
>>>>>>> 4df7636922f89cb0f9744b2c74b2053064b47840
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ));
  }
  catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
  }
