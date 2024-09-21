<?php
require_once "app/req/connect.php";

if (isset($_POST['code_promo']) && isset($_POST['usage_count'])) {
    $codePromo = $_POST['code_promo'];
    $usageCount = (int)$_POST['usage_count'] + 1;  // Incrémente le nombre d'utilisations

    // Requête pour mettre à jour le nombre d'utilisations
    $stmt = $pdo->prepare("UPDATE promotions SET nombre_fois_utilise = ? WHERE code_promo = ?");
    if ($stmt->execute([$usageCount, $codePromo])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
