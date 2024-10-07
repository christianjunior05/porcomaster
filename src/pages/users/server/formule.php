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

    if (isset($_POST['code']) && isset($_POST['formule'])) {
        
    extract($_POST);

        // Requête pour vrécupérer l'id de la formule
        $req = $pdo->prepare("SELECT * FROM formules_partage WHERE nom = ?");
        $req->execute([$formule]);
        $reqFetch = $req->fetch();
        $formuleId = $reqFetch['id'];

        // Requête pour vérifier si la formule a déjà été choisie
        $req = $pdo->prepare("SELECT * FROM codes_promo WHERE code = ?");
        $req->execute([$code]);
        $reqFetch = $req->fetch();
        $formulePartageId = $reqFetch['formules_partage_id'];

        if($formulePartageId == NULL){
        
            // Requête pour mettre à jour le nombre d'utilisations
            $stmt = $pdo->prepare("UPDATE codes_promo SET formules_partage_id = ? WHERE code = ?");
            if ($stmt->execute([$formuleId, $code])) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }

        }else {

            echo json_encode('deja');

        }
        
    } else {
        echo json_encode(['success' => false]);
    }

}elseif (!isset($_SESSION["auth"])){

    redirect('logout.php');

}