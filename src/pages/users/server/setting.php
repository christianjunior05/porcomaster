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

    if (isset($_POST['ancien_mdp']) && isset($_POST['nouveau_mdp'])) {
        
        $aMdp = $_POST['ancien_mdp'];
        
        $nMdp = $_POST['nouveau_mdp'];

        // Requête pour récupérer les infos utilisateurs

        $reqUser = $pdo->prepare("SELECT mot_de_passe FROM utilisateurs WHERE id = ?");

        $reqUser->execute([$clientsId]);

        $userFetch = $reqUser->fetch();

        $userMdp = $userFetch['mot_de_passe'];

        if(!password_verify($nMdp, $userMdp)){
        
            // création de la requete SQL
            $req = $pdo->prepare("UPDATE `utilisateurs` SET mot_de_passe = ? WHERE id = ?");

            ////////////////////
            // hashage du mdp //
            ////////////////////

            $password = password_hash($nMdp, PASSWORD_BCRYPT);

            if ($req->execute([$password, $clientsId])) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }

        }else {

            echo json_encode('utilise');

        }
        
    } else {
        echo json_encode(['success' => false]);
    }

}
