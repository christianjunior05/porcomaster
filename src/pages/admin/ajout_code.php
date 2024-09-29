<?php

  require_once "../../app/inc/connect.php";

  require_once "../../app/inc/functions.php";

  function gererUtilisateur($nom, $phone) {
    
    global $pdo;

    $codePromo = genererCodePromo(); // Génére un code promo aléatroire de 7 caractères

    // Vérifier si l'utilisateur existe déjà en fonction du numéro de téléphone
    $requeteUtilisateur = $pdo->prepare('SELECT id FROM utilisateurs WHERE numero = ?');
    $requeteUtilisateur->execute([$phone]);
    $utilisateur = $requeteUtilisateur->fetch();

    if ($utilisateur) {

        // Utilisateur existe déjà, ajouter un nouveau code promo
        $requeteCodePromo = $pdo->prepare('INSERT INTO codes_promo (utilisateur_id, code) VALUES (?, ?)');
        $requeteCodePromo->execute([$utilisateur['id'], $codePromo]);

        echo json_encode("Nouveau code promo ajoute pour l'utilisateur : $codePromo");

      } else {
        // Utilisateur n'existe pas, créer le compte et ajouter un code promo
        $motDePasse = genererMotDePasse(); // Génère un mot de passe aléatoire de 8 caractères

        // Insertion du nouvel utilisateur
        $requeteNouvelUtilisateur = $pdo->prepare('INSERT INTO utilisateurs (nom, numero, mot_de_passe) VALUES (?, ?, ?)');
        $requeteNouvelUtilisateur->execute([$nom, $phone, password_hash($motDePasse, PASSWORD_BCRYPT)]);

        $nouvelUtilisateurId = $pdo->lastInsertId();

        // Insertion du code promo initial
        $requeteCodePromo = $pdo->prepare('INSERT INTO codes_promo (utilisateur_id, code) VALUES (?, ?)');
        $requeteCodePromo->execute([$nouvelUtilisateurId, $codePromo]);

        echo json_encode("Compte cree avec succes. Code promo : $codePromo, Mot de passe : $motDePasse");
    }

  }


  if (isset($_POST) && !empty($_POST)) {

    extract($_POST); // Extraction des postes pour en faire des variables
    
    gererUtilisateur($name, $phone);
  
  }