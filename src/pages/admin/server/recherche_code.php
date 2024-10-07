<?php

    /////////////////////////
    // demarrer la session //
    /////////////////////////

    session_start();

    //////////////////////////////////////////////////////////////
    // inclure le fichier de fonction et de connection à la bdd //
    //////////////////////////////////////////////////////////////

    require_once "../../../app/inc/connect.php";

    require_once "../../../app/inc/functions.php";
    
    if ($_SESSION['auth']) {

        $num = $_SESSION['auth'];

        if (isset($_POST['search']) && !empty($_POST['search'])) {
            $search = htmlspecialchars($_POST['search']);

            // Requête SQL pour rechercher un nom avec un code promo
            $query = "SELECT cp.id, u.nom, u.numero, cp.code, cp.nombre_utilisations
            FROM utilisateurs u
            JOIN codes_promo cp ON u.id = cp.utilisateur_id
            WHERE cp.nombre_utilisations < 10 AND u.nom LIKE :search OR cp.code LIKE :search OR u.numero LIKE :search";
            $statement = $pdo->prepare($query);
            $statement->bindValue(':search', "%$search%", PDO::PARAM_STR);
            $statement->execute();

            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
            echo json_encode($results);  // Renvoyer un tableau JSON valide
            } else {
                echo json_encode([]);  // Renvoyer un tableau vide si aucun résultat
            }

        } else {
            // Si le champ de recherche est vide
            echo json_encode([
                'success' => false,
                'message' => 'Le champ de recherche est vide.'
            ]);
        }

    }elseif (!isset($_SESSION["auth"])){

        redirect('../../logout.php');
  
    }
