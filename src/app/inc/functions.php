<?php

  define('WEBURL', 'https://www.porcomaster.com');

  define('WEBNAME', 'Porco');

  define('AUTHOR', 'Random , 1he%, c2Vuc2Vp');

  define('WEBDESCR', 'Porco, sites de reservation du vrai procodjo');

  define('KEY', 'Porc, cochon, viande, grillade, four, abidjan, Afrique, Cote D\'ivoire');

  define('ROOT', $_SERVER['REQUEST_URI']);

  define('ASSETS','/porcomaster/src/assets/');

  define('TMP','/porcomaster/src/tmp/');

  ////////////////////////////////////////////////
  // vérification de l'existence de la fonction //
  ////////////////////////////////////////////////

  if (!function_exists('xss')) {

    /////////////////////////////
    // création de la fonction //
    /////////////////////////////

    function xss($chaine){


      if ($chaine) {

        //////////////////////////////////
        // protection contre faille xss //
        //////////////////////////////////

        return htmlspecialchars($chaine);

      }

    }

  }

  ////////////////////////////////////////////////
  // vérification de l'existence de la fonction //
  ////////////////////////////////////////////////

  if (!function_exists('redirect')) {

    /////////////////////////////
    // création de la fonction //
    /////////////////////////////

    function redirect($page){

      /////////////////
      // redirection //
      /////////////////

      header('location: '.$page);

      exit();

    }

  }

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