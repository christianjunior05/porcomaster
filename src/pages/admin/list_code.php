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
    $reqFiltred = "SELECT u.nom, u.numero, cp.code, cp.nombre_utilisations, f.nom AS formule
    FROM utilisateurs u
    JOIN codes_promo cp
    ON u.id = cp.utilisateur_id
    LEFT JOIN formules_partage f
    ON cp.formules_partage_id = f.id ";

    if (isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])) {
        $searchValue = $_POST["search"]["value"];
        $reqFiltred .= 'WHERE u.nom LIKE "%' . $searchValue . '%" ';
        $reqFiltred .= 'OR u.numero LIKE "%' . $searchValue . '%" ';
        $reqFiltred .= 'OR cp.code LIKE "%' . $searchValue . '%" ';
    }

    // Mapping des colonnes pour le tri
    $columns = [
        0 => 'nom',
        1 => 'numero',
        2 => 'code',
        3 => 'formule',
        4 => 'nombre_utilisations'
    ];

    if (isset($_POST["order"]) && !empty($_POST["order"])) {
        $columnIndex = $_POST['order']['0']['column']; // Index de la colonne sur laquelle trier
        $columnSortOrder = $_POST['order']['0']['dir']; // ASC ou DESC
        $orderByColumn = $columns[$columnIndex]; // Récupérer le nom de la colonne à trier
        $reqFiltred .= "ORDER BY " . $orderByColumn . " " . $columnSortOrder . " ";
    } else {
        $reqFiltred .= "ORDER BY cp.date_creation DESC "; // Par défaut, trier par ID
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
        $sub_array[] = $row['numero'];
        $sub_array[] = $row['code'];
        $sub_array[] = $row['formule'];
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
