<?php

	/////////////////////////
	// demarrer la session //
	/////////////////////////

	session_start();

	//////////////////////////////////////////////////////////////
	// inclure le fichier de fonction et de connection à la bdd //
	//////////////////////////////////////////////////////////////

    require_once "../../app/inc/connect.php";

    require_once "../../app/inc/functions.php";

    $plugins = "../../assets/plugins/";
    
    $js = "../../assets/js/";

    $css = "../../assets/css/";

    $img = "../../assets/img/";

	if(isset($_SESSION['auth'])){

		$user = $_SESSION['auth'];

		$reqUser = $pdo->query("SELECT * FROM utilisateurs WHERE numero = $user");

		$userFetch = $reqUser->fetch();

		$userId = $userFetch['id'];

		////////////////////////////
		// Récupération des infos //
		////////////////////////////

		require('view/index.php');

	}elseif (!isset($_SESSION["auth"])){

  	redirect('../logout.php');

	}

?>

