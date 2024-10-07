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

		///////////////////////////
		// connexion par cookies //
		///////////////////////////

  if (!isset($_SESSION['client_id']) && isset($_COOKIE['porco']) && !empty($_COOKIE['porco'])) {

    /////////////////////////////////////////
    // initialisation du tableau d'erreurs //
    /////////////////////////////////////////

    $errors = [];

    $rememberToken = $_COOKIE['catrans'];

    $reqClients = $pdo->prepare("SELECT * FROM clients WHERE remember_token = '$rememberToken'");

    $reqClients->execute(array());

    $clientsCol = $reqClients->fetch();

    $clientsNum = $clientsCol['num'];

    $clientsId = $clientsCol['id'];

    if ($clientsCol) {

      $_SESSION["auth"] = $user;

      $newRememberToken = bin2hex(random_bytes(32));
      
      $pdo->prepare("UPDATE clients SET remember_token = ? WHERE num = ?")->execute([$cookie, $clientsNum]);
      
      setcookie("catrans", $newRememberToken, time() + 60*60*24*7, '/');

      redirect("../home/index.php?id_cli=".$clientsId);
      
      exit();

    }

  }

  /////////////////////////////////////////////////
  // vérifions que les postes ne soient pas vide //
  /////////////////////////////////////////////////

  if(!empty($_POST) && !empty($_POST["telephone"]) && !empty($_POST["motdepasse"])){

    /////////////////////////////////////////////////
    // vérification de la soumission du formulaire //
    /////////////////////////////////////////////////

    $pass = $_POST['motdepasse'];

    $user = $_POST['telephone'];

    /////////////////////////////////////////
    // initialisation du tableau d'erreurs //
    /////////////////////////////////////////

    $errors = [];

    /////////////////////////////////////
    // protection contre la faille xss //
    /////////////////////////////////////

    $num = xss($user);

    $pass = xss($pass);

    // Recherche de l'utilisateur dans les deux tables (admins & utilisateurs)

    $sel = $pdo->query("SELECT *, 'utilisateur' AS type_user FROM utilisateurs WHERE numero = '$num' UNION SELECT *, 'admin' AS type_user FROM admins WHERE numero = '$num'");

    $posted = $sel->fetch();

    $data = !empty($posted['mot_de_passe']) ? $posted['mot_de_passe'] : NULL;
    // wmv0nnpR

    if(password_verify($pass, $data)){

      $id = $posted['id'];

      $nom = $posted['nom'];

      $_SESSION["auth"] = $num;
      
      // $rememberToken = bin2hex(random_bytes(32));
      
      // $pdo->prepare("UPDATE admins SET remember_token = ? WHERE numero = ?")->execute([$rememberToken, $num]);

      // $pdo->prepare("UPDATE utilisateurs SET remember_token = ? WHERE numero = ?")->execute([$rememberToken, $num]);
      
      // setcookie("porco", $rememberToken, time() + 60*60*24*7, '/');
      
      // echo json_encode(['redirect' => "users/pages/home/index.php?id_cli=".$clientsId]);
      // redirect("../home/index.php?id_cli=".$clientsId);
      
      $msgs[] = "Connexion en cours...";

      
      // Vérifier si l'utilisateur provient de la table 'admins' ou 'utilisateurs'
      if ($posted['type_user'] == 'admin') {

        echo "admin/index.php?id=".$id;

      } elseif ($posted['type_user'] == 'utilisateur') {

        echo "users/index.php?id=".$id;
      }
      
      exit();


    }else{

      $errors[] = "Identifiants incorrectes, vérifier (Numéro ou Mot de passe)!";

    }

  }else {
    $errors[] = "Remplissez Numéro / Mot de passe!";
  }

	if(!empty($errors)){
    
		?>											
		
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
			<ul class="mb-0">
				<?php

					foreach ($errors as $error) {
				
						?>
            
							<li><i aria-hidden="true" class="fa fa-warning me-2"></i><?=$error?></li>

						<?php

					}
			
				?>
			
			</ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
		
		<?php
		
	}

	if(!empty($msgs)){

		?>								
		
    <div class="alert alert-success alert-dismissible fade show" role="alert">
			<ul class="mb-0">
				<?php

					foreach ($msgs as $msg) {
				
						?>
            
							<li><i aria-hidden="true" class="fa fa-check-circle-o me-2"></i><?=$msg?></li>

						<?php

					}
			
				?>
			
			</ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
		
		<?php
		
	}
	
?>
