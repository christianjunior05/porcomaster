<?php

	/////////////////////////
	// demarrer la session //
	/////////////////////////

	session_start();

	//////////////////////////////////////////////////////////////
	// inclure le fichier de fonction et de connection à la bdd //
	//////////////////////////////////////////////////////////////

	require_once "../app/inc/connect.php";
	
	require_once "../app/inc/functions.php";

		///////////////////////////
		// connexion par cookies //
		///////////////////////////
  
  if (!isset($_SESSION['id']) && isset($_COOKIE['porco']) && !empty($_COOKIE['catrans'])) {
    
    /////////////////////////////////////////
    // initialisation du tableau d'erreurs //
    /////////////////////////////////////////

    $errors = [];

    $rememberToken = $_COOKIE['porco'];

    $reqClients = $pdo->prepare("SELECT * FROM clients WHERE remember_token = '$rememberToken'");

    $reqClients->execute(array());

    $clientsCol = $reqClients->fetch();

    $clientsNum = $clientsCol['num'];

    $clientsId = $clientsCol['client_id'];

    // echo $clientsId;
  
    if ($clientsCol) {

      $_SESSION["auth"] = $clientsNum;

      $newRememberToken = bin2hex(random_bytes(32));
      
      $pdo->prepare("UPDATE clients SET remember_token = ? WHERE num = ?")->execute([$newRememberToken, $clientsNum]);
      
      setcookie("catrans", $newRememberToken, time() + 60*60*24*7, '/');

      redirect("users/pages/home/index.php?id_cli=".$clientsId);
      
      exit();

    }
  }

  require('view/index.php');
	
?>
