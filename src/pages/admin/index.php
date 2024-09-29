<?php

    $plugins = "../../assets/plugins/";
    
    $js = "../../assets/js/";

    $css = "../../assets/css/";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!--===============================================================================================-->
    <!-- BOOTSTRAP CSS -->
    <!--===============================================================================================-->
    <link id="style" href="<?=$plugins?>bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- DATATABLE CSS -->
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?=$plugins?>DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?=$plugins?>DataTables-1.10.20/css/buttons.dataTables.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?=$plugins?><?=$plugins?>DataTables-1.10.20/css/responsive.dataTables.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?=$css?>mon.css">
    <style>
        /* Couleur personnalisée */
        .bg-custom {
            background-color: #ffde59;
        }
        .text-custom {
            color: #ffde59;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100">

    <div class="flex flex-col lg:flex-row">
        <!-- Sidebar -->
        <div class="bg-green-700 h-20 lg:h-screen p-5 pt-8 w-full lg:w-72 text-white flex items-center lg:block">
            <h2 class="text-xl font-bold">Sidebar</h2>
        </div>

        <!-- Contenu principal -->
        <div class="p-7 w-full">
            <div class="container">
                <div class="row">
                    <!-- Premier formulaire : Générer un code promo -->
                    <div class="col-md-6">
                        <form id="promoForm" class="bg-light p-4 rounded-lg shadow-sm">
                            <h2 class="text-primary mb-4">Générer un Code Promo</h2>
                            
                            <div class="form-group">
                                <label for="name" class="form-label font-weight-bold">Nom :</label>
                                <input type="text" id="name" name="name" required class="form-control" placeholder="Entrez le nom">
                            </div>

                            <div class="form-group mt-3">
                                <label for="phone" class="form-label font-weight-bold">Numéro de téléphone :</label>
                                <input type="tel" id="phone" name="phone" required class="form-control" placeholder="Entrez le numéro">
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-4">Soumettre</button>

                            <!-- Zone d'affichage du succès ou des erreurs -->
                            <div id="message" class="mt-4"></div>
                        </form>
                    </div>

                    <!-- Deuxième formulaire : Recherche et mise à jour des codes promo -->
                    <div class="col-md-6">
                        <!-- Formulaire de recherche et de mise à jour -->
                        <form id="searchUpdateForm" class="bg-white p-4 rounded-lg shadow-sm">
                            
                            <!-- Champ de recherche -->
                            <div>
                                <label for="searchName" class="block text-lg font-medium text-gray-700">Rechercher un nom/code/num:</label>
                                <input type="text" id="search" name="search" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-custom focus:border-custom p-2">
                                <div id="searchResults" class="col-md-6 bg-white border border-gray-300 rounded-md shadow-md mt-1 absolute w-full hidden"></div>
                            </div>

                            <!-- Zone pour afficher les résultats -->
                            <div id="resultMessage" class="mt-4 text-lg font-medium"></div>

                            <div class="mt-4">
                                <label for="codePromo" class="block text-lg font-medium text-gray-700">Code Promo:</label>
                                <input type="text" id="codePromo" name="code_promo" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" disabled>

                                <label for="usageCount" class="block text-lg font-medium text-gray-700 mt-4">Nombre d'utilisations:</label>
                                <input type="text" id="usageCount" name="usage_count" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" disabled>
                            </div>

                            <!-- Bouton pour augmenter le nombre d'utilisations -->
                            <button id="updateUsage" class="btn btn-primary btn-block mt-4">
                                Augmenter
                            </button>
                        </form>

                    </div>
                </div>
            </div>
            
            <!-- Tableau des résultats -->
             <div class="overflow-x-auto mt-10">

                <div class="table-responsive">
                  <table  id="promoTable" class="table  border text-nowrap text-md-nowrap recent-files-container min-w-full bg-white rounded-lg shadow-md">
                    <thead class="bg-custom text-gray-800">
                      <tr class="row-first">
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Code Promo</th>
                        <th>Formule</th>
                        <th>Utilisé</th>
                      </tr>
                    </thead>
                    <!-- les options seront ici -->
                  </table>
                </div>

             </div>

        </div>

    </div>
    <!-- JQUERY JS -->
    <script src="<?=$js?>jquery.min.js"></script>
    <!--===============================================================================================-->
    <!-- BOOTSTRAP JS -->
    <script src="<?=$plugins?>bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <!-- Table JS -->
    <script src="<?=$plugins?>DataTables-1.10.20/js/jquery.dataTables.js"></script>
    <!--===============================================================================================-->
    <script src="<?=$plugins?><?=$plugins?><?=$plugins?>DataTables-1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?=$plugins?><?=$plugins?>DataTables-1.10.20/js/dataTables.responsive.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?=$plugins?>DataTables-1.10.20/js/dataTables.buttons.min.js"></script>
    <!--===============================================================================================-->
    <!-- SWEETALERT JS -->
	<script src="<?=$plugins?>sweetalert/sweetalert2.js"></script>

    <script>

        $(document).ready(function() {

            // if($.fn.DataTable.isDataTable('#promoTable')){
            //  $('#promoTable').DataTable().destroy();
            // }
            
            var dataTable = $('#promoTable').DataTable(
            {
                "processing":true,
                "serverSide":true,
                "pagingType": "full_numbers",
                "order": [],
                "oderMulti":true,
                "info": true,
                /*DT_RowId: 'Id',*/
                "ajax":{
                    url:"list_code.php",
                    type:"POST"
                },

                "columnDefs": [

                    // {
                    // 	"searchable": false,
                    // 	"targets": [5],
                    // },

                    {
                        "searchable": true,
                        "targets": [0,1,2,3],
                    },

                    // {
                    // 	"orderable": false,
                    // 	"targets": [5],
                    // },

                    // {
                    // 	"orderable": true,
                    // 	"targets": [0],
                    // }

                    // {
                    // 	"visible": false,
                    // 	"targets": [0]
                    // }

                ],

                "language": {
                    "emptyTable":     "<i>Aucune donnée disponible.</i>",
                    "info":         "De _START_ à _END_ sur _TOTAL_ ",
                    "infoEmpty":      "Afficher 0 ligne sur un total de 0.",
                    "infoFiltered":     "(Filtré sur un total de _MAX_ ligne)",
                    "infoPostFix":      "Trouvé(e(s))",
                    "lengthMenu":     "Afficher _MENU_ activations",
                    "loadingRecords":   "Chargement...",
                    "processing":     "En cours...",
                    "search":     "<span style='font-size:15px;'>Recherche:</span>",
                    "searchPlaceholder":    "Recherche",
                    "zeroRecords":      "Aucun résultat trouvé.",
                    "paginate": {
                    "first":      "<--",
                    "last":       "-->",
                    "next":       "->",
                    "previous":     "<-"
                    },
                    "aria": {
                    "sortAscending":  "Ordenación ascendente",
                    "sortDescending": "Ordenación descendente"
                    }
                },
                "lengthMenu": "Afficher _MENU_ activations",
                "lengthMenu":  [[3,5,7, 10, 20, 25, 50, -1], [3,5,7, 10, 20, 25, 50, "Tout"]],
                "iDisplayLength": 7,
                select: {
                    style:    'os',
                    selector: 'td.select-checkbox'
                },
                /*DT_RowId: 'id',*/
                select: true,
                dom: 'Bfrtip',
                buttons: [

                    {
                        text: 'Rafraîchir',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload();  // Cette action recharge la DataTable
                        },
                    }

                    // { extend: 'create', editor: editor },
                    // { extend: 'edit',   editor: editor },
                    // { extend: 'remove', editor: editor },
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                responsive: true,

            });

            // Soumission et génération du code promo
            $('#promoForm').submit(function (event) {
                event.preventDefault();  // Empêche la soumission traditionnelle du formulaire

                // Récupérer les valeurs du formulaire
                var name = $('#name').val();
                var phone = $('#phone').val();

                // Envoyer les données par Ajax
                $.ajax({
                    url: 'ajout_code.php',  // Fichier PHP pour traiter la requête
                    method: 'POST',
                    data: {
                        name: name,
                        phone: phone
                    },
                    success: function (response) {
                        Swal.fire({
                            title: 'Succès',
                            text: response,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        // Optionnel : Réinitialiser le formulaire
                        $('#promoForm')[0].reset();

                        dataTable.ajax.reload();  // Actualiser la DataTable
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            title: 'Erreur',
                            text: 'Erreur : ' + error,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Fonction pour ajuster la largeur et la position de #searchResults à celle de l'input #search
            function adjustResultsWidth() {
                var input = $('#search');
                var inputOffset = input.offset(); // Récupère la position de l'input
                var inputWidth = input.outerWidth(); // Récupère la largeur de l'input

                $('#searchResults').css({
                    'width': inputWidth + 'px',  // Ajuste la largeur
                    'top': inputOffset.top + input.outerHeight() + 'px',  // Positionne sous l'input
                    'left': inputOffset.left + 'px'  // Aligne horizontalement
                });
            }

            // Ajuste la largeur et la position au chargement de la page
            adjustResultsWidth();

            // Réajuste la largeur et la position à chaque fois que la taille de la fenêtre change
            $(window).resize(function() {
                adjustResultsWidth();
            });

            // Recherche en AJAX des personnes avec un code promo
            $('#search').on('input', function() {
                var search = $(this).val();

                if (search.length > 0) {
                    $.ajax({
                        url: 'recherche_code.php',
                        method: 'POST',
                        data: {
                            search: search
                        },
                        success: function(response) {
                            try {
                                response = JSON.parse(response);
                            } catch (e) {
                                Swal.fire({
                                    title: 'Erreur',
                                    text: 'Erreur de format de la réponse',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                                return;
                            }

                            $('#searchResults').empty().removeClass('hidden');

                            if (Array.isArray(response) && response.length > 0) {
                                response.forEach(function(item) {
                                    // Utiliser l'ID pour distinguer chaque résultat unique
                                    $('#searchResults').append('<div class="p-2 hover:bg-gray-100 cursor-pointer" data-id="' + item.id + '" data-nom="' + item.nom + '" data-code="' + item.code + '" data-usage="' + item.nombre_utilisations + '">' + item.nom + ' (' + item.code + ') utilisé ' + item.nombre_utilisations + ' fois</div>');
                                });
                            } else {
                                $('#searchResults').append('<div>Aucun résultat trouvé.</div>');
                            }

                            adjustResultsWidth();  // Réajuste au cas où l'input change de taille après les résultats

                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Erreur',
                                text: 'Erreur : ' + error,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                } else {
                    $('#searchResults').addClass('hidden'); // Cache la div si la recherche est vide
                }
            });

            // Gérer la sélection d'un résultat de recherche
            $('#searchResults').on('click', 'div', function() {
                var selectedName = $(this).data('nom');
                var selectedCode = $(this).data('code');
                var usageCount = $(this).data('usage');
                

                $('#search').val(selectedName.split(' (')[0]); // Remplit l'input de recherche avec le nom
                $('#codePromo').val(selectedCode); // Remplit le champ code promo
                $('#usageCount').val(usageCount); // Remplit le champ usage count

                // Mettre à jour le message et afficher le bouton d'augmentation d'utilisation
                $('#updateMessage').html('Nom: ' + selectedName + ', Code Promo: ' + selectedCode + ', Utilisations: ' + usageCount);
                $('#increaseUsage').removeClass('hidden').data('code_promo', selectedCode);

                // Masquer les résultats de la recherche
                $('#searchResults').addClass('hidden');
            });

            // Augmenter le nombre d'utilisations
            $('#updateUsage').click(function(event) {
                event.preventDefault();  // Empêche le comportement par défaut du bouton

                var codePromo = $('#codePromo').val();  // Récupérer le code promo
                var usageCount = $('#usageCount').val();  // Récupérer le nombre d'utilisations

                // Assurez-vous que le code promo n'est pas vide
                if (codePromo !== "") {
                    $.ajax({
                        url: 'usage.php',  // Fichier PHP pour traiter la mise à jour
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            code_promo: codePromo,
                            usage_count: usageCount
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Succès',
                                    text: 'Nombre d\'utilisations augmenté avec succès.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                                // Optionnel : Réinitialiser le formulaire
                                $('#searchUpdateForm')[0].reset();

                                dataTable.ajax.reload();  // Actualiser la DataTable

                            } else if(response == "sup") {
                                Swal.fire({
                                    title: 'Erreur',
                                    text: 'Nombre d\'utilisation depasser pour ce code promo',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });

                            }else {
                                Swal.fire({
                                    title: 'Erreur',
                                    text: 'Erreur lors de la mise à jour.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },
                        
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Erreur',
                                text: 'Erreur : ' + error,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Veuillez d\'abord recherche un code promo',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });

        });
        
    </script>

</body>
</html>
