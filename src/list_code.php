<?php

require_once "app/req/connect.php";

if (isset($_POST) && !empty($_POST)) {

    extract($_POST);

    // requête pour recordsTotal (sans filtre de recherche)
    $reqTotal = "SELECT COUNT(*) AS total FROM promotions";
    $statementTotal = $pdo->prepare($reqTotal);
    $statementTotal->execute([]);
    $totalRow = $statementTotal->fetch();
    $recordsTotal = $totalRow['total'];

    // Requête filtrée
    $reqFiltred = "SELECT * FROM promotions ";

    if (isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])) {
        $searchValue = $_POST["search"]["value"];
        $reqFiltred .= 'WHERE nom LIKE "%' . $searchValue . '%" ';
        $reqFiltred .= 'OR numero_telephone LIKE "%' . $searchValue . '%" ';
        $reqFiltred .= 'OR code_promo LIKE "%' . $searchValue . '%" ';
    }

    // Mapping des colonnes pour le tri
    $columns = [
        0 => 'nom',
        1 => 'numero_telephone',
        2 => 'code_promo',
        3 => 'nombre_fois_utilise'
    ];

    if (isset($_POST["order"]) && !empty($_POST["order"])) {
        $columnIndex = $_POST['order']['0']['column']; // Index de la colonne sur laquelle trier
        $columnSortOrder = $_POST['order']['0']['dir']; // ASC ou DESC
        $orderByColumn = $columns[$columnIndex]; // Récupérer le nom de la colonne à trier
        $reqFiltred .= "ORDER BY " . $orderByColumn . " " . $columnSortOrder . " ";
    } else {
        $reqFiltred .= "ORDER BY id DESC "; // Par défaut, trier par ID
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
        $sub_array[] = wordwrap($row["nom"], 15, '<br/>', true);
        $sub_array[] = $row['numero_telephone'];
        $sub_array[] = $row['code_promo'];
        $sub_array[] = $row['nombre_fois_utilise'];
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
