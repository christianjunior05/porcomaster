<?php
require_once "../../app/inc/connect.php";

if (isset($_POST['code_promo']) && isset($_POST['usage_count'])) {
    $codePromo = $_POST['code_promo'];
    $usageCount = (int)$_POST['usage_count'] + 1;  // Incrémente le nombre d'utilisations

    // Requête pour vérifier le nombre d'utilisations
    $req = $pdo->prepare("SELECT nombre_utilisations FROM codes_promo WHERE code = ?");
    $req->execute([$codePromo]);
    $req_nombre = $req->fetch();

    $nombre = $req_nombre['nombre_utilisations'];

    if($nombre < 10){
    
        // Requête pour mettre à jour le nombre d'utilisations
        $stmt = $pdo->prepare("UPDATE codes_promo SET nombre_utilisations = ? WHERE code = ?");
        if ($stmt->execute([$usageCount, $codePromo])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }

    }else {

        echo json_encode('sup');

    }
    
} else {
    echo json_encode(['success' => false]);
}
