<?php
require_once "app/req/connect.php";  // Connexion à la base de données

if (isset($_POST['search_name']) && !empty($_POST['search_name'])) {
    $searchName = htmlspecialchars($_POST['search_name']);

    // Requête SQL pour rechercher un nom avec un code promo
    $query = "SELECT nom, code_promo, nombre_fois_utilise FROM promotions WHERE nom LIKE :searchName LIMIT 1";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':searchName', "%$searchName%", PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Si un résultat est trouvé, retourner les informations via AJAX
        echo json_encode([
            'success' => true,
            'nom' => $result['nom'],
            'code_promo' => $result['code_promo'],
            'usage_count' => $result['nombre_fois_utilise']
        ]);
    } else {
        // Si aucun résultat n'est trouvé
        echo json_encode([
            'success' => false,
            'message' => 'Aucun résultat trouvé pour ce nom.'
        ]);
    }
} else {
    // Si le champ de recherche est vide
    echo json_encode([
        'success' => false,
        'message' => 'Le champ de recherche est vide.'
    ]);
}
