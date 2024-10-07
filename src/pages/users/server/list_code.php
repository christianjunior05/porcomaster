<?php

    /////////////////////////
    // demarrer la session //
    /////////////////////////

    session_start();

	//////////////////////////////////////////////////////////////
	// inclure le fichier de fonction et de connection à la bdd //
	//////////////////////////////////////////////////////////////

    require_once "../../../app/inc/connect.php";

    if ($_SESSION['auth']) {

        $num = $_SESSION['auth'];
 
        ////////////////////////////////////
		// Récupération des infos clients //
		////////////////////////////////////

		$reqClients = $pdo->prepare("SELECT * FROM utilisateurs WHERE numero = '$num'");

        $reqClients->execute(array());
  
        $clients = $reqClients->fetch();
  
        $clientsId = $clients['id'];
  
        $clientsNom = $clients['nom'];
  
        $clientsNum = $clients['numero'];

        if (isset($_POST) && !empty($_POST)) {

            extract($_POST);

            // requête pour recordsTotal (sans filtre de recherche)
            $reqTotal = "SELECT COUNT(*) AS total FROM codes_promo WHERE utilisateur_id = ?";
            $statementTotal = $pdo->prepare($reqTotal);
            $statementTotal->execute([$clientsId]);
            $totalRow = $statementTotal->fetch();
            $recordsTotal = $totalRow['total'];

            // Requête filtrée
            $reqFiltred = "SELECT cp.utilisateur_id, cp.code, cp.date_creation, cp.nombre_utilisations, f.nom 
            FROM codes_promo cp 
            LEFT JOIN formules_partage f 
            ON f.id = cp.formules_partage_id 
            WHERE cp.utilisateur_id = '$clientsId' ";

            if (isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])) {
                $searchValue = $_POST["search"]["value"];
                $reqFiltred .= 'AND cp.code LIKE "%' . $searchValue . '%" ';
                $reqFiltred .= 'OR cp.nombre_utilisations LIKE "%' . $searchValue . '%" ';
                $reqFiltred .= 'OR f.nom LIKE "%' . $searchValue . '%" ';
            }

            // Mapping des colonnes pour le tri
            $columns = [
                0 => 'code',
                1 => 'nom',
                2 => 'date_creation',
                3 => 'nombre_utilisations'
            ];

            if (isset($_POST["order"]) && !empty($_POST["order"])) {
                $columnIndex = $_POST['order']['0']['column']; // Index de la colonne sur laquelle trier
                $columnSortOrder = $_POST['order']['0']['dir']; // ASC ou DESC
                $orderByColumn = $columns[$columnIndex]; // Récupérer le nom de la colonne à trier
                $reqFiltred .= "ORDER BY " . $orderByColumn . " " . $columnSortOrder . " ";
            } else {
                $reqFiltred .= "ORDER BY cp.date_creation DESC "; // Par défaut, trier par date de création
            }

            if ($_POST["length"] != -1) {
                $reqFiltred .= "LIMIT " . $_POST['start'] . ", " . $_POST['length'];
            }

            // Exécution de la requête filtrée
            $filtre = $pdo->prepare($reqFiltred);
            $filtre->execute([]);
            $result = $filtre->fetchAll();
            $filtered_rows = $filtre->rowCount();
            $data = array();

            // Préparation des données à envoyer au DataTable
            foreach ($result as $row) {
                $sub_array = array();

                if ($row['nom'] == NULL) {

                    $nom = '<p class="text-sm font-weight-bold mb-0">
                        <span class="badge badge-sm bg-gradient-secondary">Non définit</span></p>';

                } else {
                    
                    $nom = '<p class="text-sm font-weight-bold mb-0">
                        <span class="badge badge-sm bg-gradient-warning">'.$row['nom'].'</span></p>';

                }
                $sub_array[] = '<div class="d-flex px-2">
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">'.$row["code"].'</h6>
                                        </div>
                                    </div>';
                $sub_array[] = $nom;
                $sub_array[] = '<span class="text-xs font-weight-bold">'.$row['date_creation'].'</span>';
                $sub_array[] = '<div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">'.$row['nombre_utilisations'].'0%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="'.$row['nombre_utilisations'].'0" aria-valuemin="0" aria-valuemax="100" style="width: '.$row['nombre_utilisations'].'0%;"></div>
                                            </div>
                                        </div>
                                    </div>';
                $data[] = $sub_array;
            }

            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $filtered_rows,
                "data" => $data,
            );

            header('Content-Type: application/json');
            echo json_encode($output);
        }
        
    }elseif (!isset($_SESSION["auth"])){

        redirect('logout.php');
  
    }
