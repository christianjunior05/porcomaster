<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- BOOTSTRAP CSS -->
    <link id="style" href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- DATATABLE CSS -->
    <!--===============================================================================================-->
    <link rel="stylesheet" href="DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="DataTables-1.10.20/css/responsive.dataTables.min.css">
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
                        <form id="searchUpdateForm" class="bg-white p-6 rounded-lg shadow-md space-y-4">
                            <!-- Champ de recherche -->
                            <div>
                                <label for="searchName" class="block text-lg font-medium text-gray-700">Rechercher un nom:</label>
                                <input type="text" id="searchName" name="search_name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-custom focus:border-custom p-2">
                            </div>

                            <button type="submit" class="w-full bg-custom text-gray-800 font-bold py-2 px-4 rounded-md shadow hover:bg-yellow-400">
                                Rechercher
                            </button>

                            <!-- Zone pour afficher les résultats -->
                            <div id="resultMessage" class="mt-4 text-lg font-medium"></div>

                            <div class="mt-4">
                                <label for="codePromo" class="block text-lg font-medium text-gray-700">Code Promo:</label>
                                <input type="text" id="codePromo" name="code_promo" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">

                                <label for="usageCount" class="block text-lg font-medium text-gray-700 mt-4">Nombre d'utilisations:</label>
                                <input type="number" id="usageCount" name="usage_count" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            </div>

                            <!-- Bouton pour augmenter le nombre d'utilisations -->
                            <button id="updateUsage" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md shadow hover:bg-blue-600">
                                Augmenter le nombre d'utilisations
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
    <script src="jquery.min.js"></script>
    <!--===============================================================================================-->
    <!-- BOOTSTRAP JS -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <!-- Table JS -->
    <script src="DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
    <!--===============================================================================================-->
    <script src="DataTables-1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <!--===============================================================================================-->
    <script src="DataTables-1.10.20/js/dataTables.responsive.min.js"></script>
    <!--===============================================================================================-->
    <!-- SWEETALERT JS -->
	<script src="sweetalert/sweetalert2.js"></script>

    <script>
    $(document).ready(function() {

        // if($.fn.DataTable.isDataTable('#promoTable')){
        // $('#promoTable').DataTable().destroy();
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
                "infoPostFix":      "(Code)",
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
            // buttons: [
            //  { extend: 'create', editor: editor },
            // { extend: 'edit',   editor: editor },
            // { extend: 'remove', editor: editor },
            //   'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            responsive: true,

        });

        // Soumission et génération du code promo
        $('#promoForm').submit(function (event) {
            event.preventDefault();  // Empêche la soumission traditionnelle du formulaire

            // Récupérer les valeurs du formulaire
            var name = $('#name').val();
            var phone = $('#phone').val();

            // Générer un code promo alphanumérique de 7 caractères
            var codePromo = Math.random().toString(36).substring(2, 9).toUpperCase();

            // Envoyer les données par Ajax
            $.ajax({
                url: 'ajout_code.php',  // Fichier PHP pour traiter la requête
                method: 'POST',
                data: {
                    name: name,
                    phone: phone,
                    code_promo: codePromo
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Succès',
                        text: 'Code promo généré : ' + codePromo,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    // Optionnel : Réinitialiser le formulaire
                    $('#promoForm')[0].reset();
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

        // Recherche en AJAX des personnes avec un code promo
        $('#searchUpdateForm').submit(function(event) {
            event.preventDefault();  // Empêche la soumission traditionnelle du formulaire

            var searchName = $('#searchName').val();  // Récupère la valeur du champ de recherche

            $.ajax({
                url: 'recherche_code.php',  // Fichier PHP pour traiter la recherche
                method: 'POST',
                dataType: 'json',  // On attend une réponse JSON
                data: {
                    search_name: searchName  // Envoyer le nom recherché
                },
                success: function(response) {
                    if (response.success) {
                        // Si la recherche a réussi, afficher les informations dans le formulaire
                        $('#resultMessage').html('<p class="text-green-500">Résultat trouvé : ' + response.nom + '</p>');
                        $('#codePromo').val(response.code_promo);  // Met à jour le champ code promo
                        $('#usageCount').val(response.usage_count);  // Met à jour le nombre d'utilisations
                    } else {
                        // Si aucun résultat n'a été trouvé
                        Swal.fire({
                            title: 'Aucun résultat trouvé',
                            text: 'Aucun code promo trouvé pour ce nom.',
                            icon: 'info',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Gestion des erreurs
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Erreur : ' + error,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });

                }
            });
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
                        } else {
                            $('#resultMessage').append('<p class="text-red-500">Erreur lors de la mise à jour.</p>');
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
