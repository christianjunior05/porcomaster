<?php

  function genererMotDePasse($longueur = 8) {
    // Définir l'ensemble de caractères : lettres majuscules, minuscules et chiffres
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    
    // Mélanger les caractères et sélectionner de façon aléatoire
    $motDePasse = '';
    $tailleMax = strlen($caracteres) - 1;
    
    for ($i = 0; $i < $longueur; $i++) {
        $motDePasse .= $caracteres[rand(0, $tailleMax)];
    }
    
    return $motDePasse;
  }

  function genererCodePromo() {
    // Génère une chaîne aléatoire et extrait les caractères après le "0."
    $codePromo = substr(strtoupper(base_convert(rand(100000000, 999999999), 10, 36)), 0, 7);
    return $codePromo;
  }