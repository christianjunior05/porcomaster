<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Utilisateur</title>
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

        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
           
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

            <!-- Contetnu principal -->
            <div class="container-fluid py-4">

                <div class="row mb-4">
                    <!-- Section Modifier le mot de passe -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Modifier le mot de passe</h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="passwordForm">
                                    <div class="mb-3">
                                        <label for="currentPassword" class="form-label">Mot de passe actuel</label>
                                        <input type="password" class="form-control" id="currentPassword" placeholder="Entrez le mot de passe actuel">
                                    </div>
                                    <div class="mb-3">
                                        <label for="newPassword" class="form-label">Nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="newPassword" placeholder="Entrez le nouveau mot de passe">
                                    </div>
                                    <button id="updateSetting" class="btn btn-warning btn-block mt-4">Valider</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Section Formules de partage des codes promo -->
                    <div class="col-md-6">
                        <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Formules de partage</h6>
                            </div>
                        </div>
                            <div class="card-body">
                                <form id="formuleForm">
                                    <div class="mb-3">
                                        <label for="codePromoSelect" class="form-label">Code Promo</label>
                                        <select class="form-select" id="code">
                                            <option label="Code promo"></option>
                                            <?php

                                                $reqCode = $pdo->query("SELECT * FROM codes_promo WHERE formules_partage_id IS NULL AND utilisateur_id = $userId ORDER BY date_creation ASC");

                                                while ($codeFetch = $reqCode->fetch()) {

                                                    $code = $codeFetch['code'];

                                            ?>

                                                <option value="<?=$code?>"><?=$code?></option>

                                            <?php

                                                }
                                                
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formule" class="form-label">Choisir la Formule</label>
                                        <select class="form-select" id="formule">
                                            <option label="Formule"></option>
                                            <?php

                                                $reqFormules = $pdo->query("SELECT * FROM formules_partage ORDER BY id ASC");

                                                while ($formulesFetch = $reqFormules->fetch()) {

                                                    $formules = $formulesFetch['nom'];

                                            ?>

                                                <option value="<?=$formules?>"><?=$formules?></option>

                                            <?php

                                                }
                                                
                                            ?>
                                        </select>
                                    </div>
                                    <button id="updateFormule" class="btn btn-warning">Valider</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">

                    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">tableau des codes</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="CodePromo" class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 text-white opacity-8">Code Promo</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2 text-white opacity-8">Formule</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2 text-white opacity-8">Date</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder text-center opacity-7 ps-2 text-white opacity-8">Utilisé</th>
                                        
                                    </tr>
                                </thead>
                                <!-- les options seront ici -->
                                
                            </table>
                        </div>
                        </div>
                    </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                            <h6>Activités récentes</h6>
                            <p class="text-sm">
                                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                                <span class="font-weight-bold">24%</span> this month
                            </p>
                            </div>
                            <div class="card-body p-3">
                            <div class="timeline timeline-one-side">
                                <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-success text-gradient">notifications</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                                </div>
                                </div>
                                <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-danger text-gradient">code</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                                </div>
                                </div>
                                <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-info text-gradient">shopping_cart</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                                </div>
                                </div>
                                <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-warning text-gradient">credit_card</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order #4395133</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                                </div>
                                </div>
                                <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-primary text-gradient">key</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                                </div>
                                </div>
                                <div class="timeline-block">
                                <span class="timeline-step">
                                    <i class="material-icons text-dark text-gradient">payments</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
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
        <script src="<?=$plugins?>DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
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
            
            $(document).ready(function(){

                var dataTable = $('#CodePromo').DataTable(
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

                    //     // { extend: 'create', editor: editor },
                    //     // { extend: 'edit',   editor: editor },
                    //     // { extend: 'remove', editor: editor },
                    //     // 'copy', 'csv', 'excel', 'pdf', 'print'
                    // ],
                    responsive: true,

                });

                // Mettre à jour les paramètres utilisateurs
                $('#updateSetting').click(function(event) {
                    event.preventDefault();  // Empêche le comportement par défaut du bouton

                    var ancienMdp = $('#currentPassword').val();  // Récupérer l'ancien mdp
                    var nouveauMdp = $('#newPassword').val();  // Récupérer le nouveau mdp

                    // Assurez-vous que les champs ne soient pas vide
                    if (ancienMdp !== "" && nouveauMdp !== "") {
                        $.ajax({
                            url: 'server/setting.php',  // Fichier PHP pour traiter la mise à jour
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                ancien_mdp: ancienMdp,
                                nouveau_mdp: nouveauMdp
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Succès',
                                        text: 'Changement éffectué avec succès.',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    });
                                    // Optionnel : Réinitialiser le formulaire
                                    $('#passwordForm')[0].reset();

                                    dataTable.ajax.reload();  // Actualiser la DataTable

                                } else if(response == "utilise") {
                                    Swal.fire({
                                        title: 'Erreur',
                                        text: 'Ce mot de passe est déjà utilisé',
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

                // Mettre à jour la formule par code promo
                $('#updateFormule').click(function(event) {
                    event.preventDefault();  // Empêche le comportement par défaut du bouton

                    var code = $('#code').val();  // Récupérer l'ancien mdp
                    var formule = $('#formule').val();  // Récupérer le nouveau mdp

                    // Assurez-vous que les champs ne soient pas vide
                    if (code !== "" && formule !== "") {
                        $.ajax({
                            url: 'server/formule.php',  // Fichier PHP pour traiter la mise à jour
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                code: code,
                                formule: formule
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Succès',
                                        text: 'Formule appliquée avec succès.',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    });
                                    // Optionnel : Réinitialiser le formulaire
                                    $('#formuleForm')[0].reset();

                                    dataTable.ajax.reload();  // Actualiser la DataTable
                                
                                } else if(response == "deja"){
                                    Swal.fire({
                                        title: 'Erreur',
                                        text: 'Une formule est déjà appliquée à ce code',
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
                            text: 'Veuillez remplir tous les champs',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });

            });
        </script>
       
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="<?=$js?>material-dashboard.min.js?v=3.1.0"></script>
    </body>

</html>