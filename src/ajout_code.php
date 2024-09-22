<?php

  require_once "app/req/connect.php";

  if (isset($_POST) && !empty($_POST)) {

    extract($_POST);

    var_dump($_POST);

    $req_code = $pdo->prepare("INSERT INTO  promotions SET nom = ?, numero_telephone = ?, code_promo = ?");

    $req_code->execute([$name, $phone, $code_promo]);

  }