<?php

require_once "../../app/inc/connect.php";

if (isset($_POST['ancien_mdp']) && isset($_POST['nouveau_mdp'])) {
    
    $aMdp = $_POST['ancien_mdp'];
    
    $nMdp = $_POST['nouveau_mdp'];

    // Requête pour récupérer les infos utilisateurs

    $reqUser = $pdo->prepare("SELECT mot_de_passe FROM utilisateurs");

    $reqUser->execute([]);

    $userFetch = $reqUser->fetch();

    $userMdp = $userFetch['mot_de_passe'];

    if(!password_verify($nMdp, $userMdp)){
    
        // création de la requete SQL
        $req = $pdo->prepare("UPDATE `utilisateurs` SET mot_de_passe = ?");

        ////////////////////
        // hashage du mdp //
        ////////////////////

        $password = password_hash($aMdp, PASSWORD_BCRYPT);

        if ($req->execute([$password])) {
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
