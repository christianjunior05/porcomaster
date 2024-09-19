<?php

try{
  $pdo = new PDO('mysql:host=localhost;dbname=porco', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}catch(PDOException $e){
  // header("location: inc/install.php?install=oui");
  // exit;
  echo $e->getMessage();
}

if (isset($_POST) && !empty($_POST)) {

extract($_POST);

// requête pour recordsTotal (sans filtre de recherche)
$reqToal = "SELECT COUNT(*) AS total FROM promotions";

$statementTotal = $pdo->prepare($reqToal);

$statementTotal->execute([]);

$totalRow = $statementTotal->fetch();

$recordsTotal = $totalRow['total'];

$reqFiltred = "SELECT * FROM promotions ";

if(isset($_POST["search"]["value"]) AND !empty($_POST["search"]["value"])){

  $reqFiltred .= 'WHERE nom LIKE "%'.$_POST["search"]["value"].'%" ';

  $reqFiltred .= 'OR numero_telephone LIKE "%'.$_POST["search"]["value"].'%" ';

  $reqFiltred .= 'OR code_promo LIKE "%'.$_POST["search"]["value"].'%" ';

  // echo 'query : '.json_encode($reqFiltred);

}

if(isset($_POST["order"]) AND !empty($_POST["order"])){

  $reqFiltred .= 'ORDER BY '.($_POST['order']['0']['column']+1).' '.$_POST['order']['0']['dir'].' ';
  // echo 'query : '.json_encode($reqFiltred);

}else{

 $reqFiltred .= 'ORDER BY id DESC ';

}

if($_POST["length"] != -1){

 $reqFiltred .= 'LIMIT ' . $_POST['start'] . ',' . $_POST['length'];

}

// echo 'query : '.json_encode($reqFiltred);

$filtre = $pdo->prepare($reqFiltred);
$filtre->execute([]);
$result = $filtre->fetchAll();
$filtered_rows = $filtre->rowCount();
$data = array();

foreach($result as $row){
  
  $nom = wordwrap($row["nom"], 15, '<br/>', true);
  
  $sub_array = array();
  
  $sub_array[] = $nom;

  $sub_array[] = $row['numero_telephone'];

  $sub_array[] = $row['code_promo'];
                  
  $sub_array[] = $row['nombre_fois_utilise'];
  
  $data[] = $sub_array;

}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => $recordsTotal,
 "data"    => $data,
);

header('Content-Type:application/json');

echo json_encode($output);


}