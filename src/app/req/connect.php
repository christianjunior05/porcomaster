<?php

// Au cas où la config PHP ini n'affiche pas les errors de syntaxe niveau server, decommenter le code ci-dessous
// ini_set('display_errors',1);
// ini_set('displau=y_startup_errors',1);
// error_reporting(E_ALL);

  try{
      $pdo = new PDO('mysql:host=localhost;dbname=porco', 'root', '');
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }catch(PDOException $e){
      // header("location: inc/install.php?install=oui");
      // exit;
      echo $e->getMessage();
    }