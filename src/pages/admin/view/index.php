<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Adminitrateur</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="<?=$css?>nucleo-icons.css" rel="stylesheet" />
    <link href="<?=$css?>nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="<?=$css?>material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <!-- DATATABLE CSS -->
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?=$plugins?>DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?=$plugins?><?=$plugins?>DataTables-1.10.20/css/responsive.dataTables.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?=$css?>mon.css">
    <style>
        .card-header {
            background-color: #007bff;
            color: white;
        }

        .form-select,
        .form-control {
            width: 100%;
        }
        /* Couleur personnalisée */
        .bg-custom {
            background-color: #ffde59;
        }
        .text-custom {
            color: #ffde59;
        }
    </style>
</head>
<body class="g-sidenav-show  bg-gray-200 dark-version">
    
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="#" target="_blank">
                <img src="<?=$img?>logo.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">PorcoMaster</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white active bg-gradient-warning" href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
        </ul>
        </div>
    </aside>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Dashboard</h6>
                </nav>
            
                <div class="justify-content-end collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                
                    <ul class="navbar-nav justify-content-end">
                        
                        <li class="nav-item d-flex align-items-center">
                            <a href="../logout.php" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-power-off me-sm-1"></i>
                                <span class="d-sm-inline d-none">Deconnexion</span>
                            </a>
                        </li>
                    </ul>
                    
                </div>
                
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Contenu principal -->
        <div class="container-fluid py-4">

            <div class="row mb-4">
                <!-- Premier formulaire : Générer un code promo -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Générer un code promo</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="promoForm">
                                
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

                    </div>
                </div>

                <!-- Deuxième formulaire : Recherche et mise à jour des codes promo -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Générer un code promo</h6>
                            </div>
                        </div>
                        <div class="card-body">

                            <!-- Formulaire de recherche et de mise à jour -->
                            <form id="searchUpdateForm">
                                
                                <!-- Champ de recherche -->
                                <div class="form-group">
                                    <label for="searchName" class="block text-lg font-medium text-gray-700">Rechercher :</label>
                                    <input type="text" id="search" name="search" placeholder="nom/code/num" required class="form-control">
                                    <div id="searchResults" class="col-md-6 bg-white border border-gray-300 rounded-md shadow-md mt-1 absolute w-full hidden"></div>
                                </div>

                                <!-- Zone pour afficher les résultats -->
                                <div id="resultMessage" class="mt-4 text-lg font-medium"></div>

                                <div class="mt-4">
                                    <label for="codePromo" class="block text-lg font-medium text-gray-700">Code Promo:</label>
                                    <input type="text" id="codePromo" name="code_promo" class="form-control" disabled>

                                    <label for="usageCount" class="block text-lg font-medium text-gray-700 mt-4">Nombre d'utilisations:</label>
                                    <input type="text" id="usageCount" name="usage_count" class="form-control" disabled>
                                </div>

                                <!-- Bouton pour augmenter le nombre d'utilisations -->
                                <button id="updateUsage" class="btn btn-primary btn-block mt-4">
                                    Augmenter
                                </button>

                            </form>
                        
                        </div>
                    
                    </div>

                </div>

            </div>
            
            <!-- Tableau des résultats -->
            <div class="overflow-x-auto my-4">

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

    </main>
    
    <!--   Core JS Files   -->
    <script src="<?=$js?>core/popper.min.js"></script>
    <script src="<?=$js?>core/bootstrap.min.js"></script>
    <script src="<?=$js?>plugins/perfect-scrollbar.min.js"></script>
    <script src="<?=$js?>plugins/smooth-scrollbar.min.js"></script>
    <script src="<?=$js?>plugins/chartjs.min.js"></script>
    <!-- JQUERY JS -->
    <script src="<?=$js?>jquery.min.js"></script>
    <!--===============================================================================================-->
    <!-- Table JS -->
    <script src="<?=$plugins?>DataTables-1.10.20/js/jquery.dataTables.js"></script>
    <!--===============================================================================================-->
    <script src="<?=$plugins?>DataTables-1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <!--===============================================================================================-->
    <!-- <script src="<?=$plugins?>DataTables-1.10.20/js/dataTables.responsive.min.js"></script> -->
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
                    url:"server/list_code.php",
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
                    "lengthMenu":     "Afficher _MENU_",
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
                // dom: 'Bfrtip',
                // buttons: [

                //     {
                //         text: 'Rafraîchir',
                //         action: function (e, dt, node, config) {
                //             dt.ajax.reload();  // Cette action recharge la DataTable
                //         },
                //     }

                    // { extend: 'create', editor: editor },
                    // { extend: 'edit',   editor: editor },
                    // { extend: 'remove', editor: editor },
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                // ],
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
                    url: 'server/ajout_code.php',  // Fichier PHP pour traiter la requête
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
                        url: 'server/recherche_code.php',
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
                        url: 'server/usage.php',  // Fichier PHP pour traiter la mise à jour
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
