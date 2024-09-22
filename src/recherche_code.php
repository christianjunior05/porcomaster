<?php
require_once "app/req/connect.php";  // Connexion à la base de données

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = htmlspecialchars($_POST['search']);

    // Requête SQL pour rechercher un nom avec un code promo
    $query = "SELECT id, nom, code_promo, nombre_fois_utilise FROM promotions WHERE nom LIKE :search OR code_promo LIKE :search";
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
