<?php

    require_once "../app/inc/connect.php";

    $plugins = "../assets/plugins/";
    
    $js = "../assets/js/";

    $css = "../assets/css/";

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page de Connexion</title>
    <!-- BOOTSTRAP CSS -->
    <!--===============================================================================================-->
    <link id="style" href="<?=$plugins?>bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Inclure Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div id="connexion" class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Connexion</h2>
        <div class="row" id="erreurLogin">
                <!-- les erreurs seront ici -->
        </div>
        <form id="loginValue" class="needs-validation" novalidate="" method="post" action="" autocomplete="off">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="telephone">Numéro de téléphone</label>
                <input
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    type="tel" id="telephone" name="telephone" placeholder="Votre numéro de téléphone" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 mb-2" for="motdepasse">Mot de passe</label>
                <input
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    type="password" id="motdepasse" name="motdepasse" placeholder="Votre mot de passe" required>
            </div>
            <button id="submitLogin" name="login" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-200"
                type="submit">Se connecter</button>
        </form>
    </div>
    <!-- SCRIPTS -->
    <!-- JQUERY JS -->
    <script src="<?=$js?>jquery.min.js"></script>
    <!--===============================================================================================-->
    <!-- BOOTSTRAP JS -->
    <script src="<?=$plugins?>bootstrap/js/bootstrap.min.js"></script>
    <script>

        $(document).ready(function(){

            $('#submitLogin').click(function(e){
                e.preventDefault();//pour éviter le rechargement de la page par défaut
                
                // Récupérer les données des inputs dans la balise
                var formData = $('#loginValue').serializeArray();

                // Faire une requête Ajax
                $.ajax({
                    type: 'POST',
                    url: 'server/login.php',
                    data: formData,
                    success: function(r){

                        if (r.startsWith('users/index.php?id=')) {

                            window.location.href = r;
                            
                        } else if (r.startsWith('admin/index.php?id=')){

                            window.location.href = r; 

                        } else {

                            $('#erreurLogin').html(r);

                        }
                    }
                })

            });

        });

    </script>
</body>

</html>