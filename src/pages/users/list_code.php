<?php

require_once "../../app/inc/connect.php";

if (isset($_POST) && !empty($_POST)) {

    extract($_POST);

    // requête pour recordsTotal (sans filtre de recherche)
    $reqTotal = "SELECT COUNT(*) AS total FROM codes_promo";
    $statementTotal = $pdo->prepare($reqTotal);
    $statementTotal->execute([]);
    $totalRow = $statementTotal->fetch();
    $recordsTotal = $totalRow['total'];

    // Requête filtrée
    $reqFiltred = "SELECT cp.code, cp.date_creation, cp.nombre_utilisations, f.nom
    FROM codes_promo cp
    JOIN formules_partage f
    ON f.id = cp.formules_partage_id ";

    if (isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])) {
        $searchValue = $_POST["search"]["value"];
        $reqFiltred .= 'WHERE cp.code LIKE "%' . $searchValue . '%" ';
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
        $sub_array[] = wordwrap($row["code"], 15, '<br/>', true);
        $sub_array[] = $row['nom'];
        $sub_array[] = $row['date_creation'];
        $sub_array[] = $row['nombre_utilisations'];
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
