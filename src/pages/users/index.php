<?php

    require_once "../../app/inc/connect.php";

    $plugins = "../../assets/plugins/";
    
    $js = "../../assets/js/";

    $css = "../../assets/css/";

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utilisateur</title>
    <!-- BOOTSTRAP CSS -->
    <!--===============================================================================================-->
    <link id="style" href="<?=$plugins?>bootstrap/css/bootstrap.min.css" rel="stylesheet" />
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

<body>
    <!-- Container principal -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tableau de Bord Utilisateur</h1>

        <div class="row">
            <!-- Section Modifier le mot de passe -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Modifier le mot de passe
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
                            <button id="updateSetting" class="btn btn-primary btn-block mt-4">Valider</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Section Formules de partage des codes promo -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Choisir une Formule de Partage
                    </div>
                    <div class="card-body">
                        <form id="formuleFom">
                            <div class="mb-3">
                                <label for="codePromoSelect" class="form-label">Code Promo</label>
                                <select class="form-select" id="code">
                                    <option label="Code promo"></option>
                                    <?php

                                        $reqCode = $pdo->query("SELECT * FROM codes_promo WHERE formules_partage_id IS NULL ORDER BY date_creation ASC");

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
                            <button id="updateFormule" class="btn btn-primary">Valider la formule</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Section Voir l'historique des utilisations de code promo -->
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        Historique des Codes Promo
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="CodePromo" class="table border text-nowrap text-md-nowrap recent-files-container min-w-full bg-white rounded-lg shadow-md">
                                <thead class="bg-custom text-gray-800">
                                    <tr class="row-first">
                                        <th>Code Promo</th>
                                        <th>formules</th>
                                        <th>Date</th>
                                        <th>Utilisé</th>
                                    </tr>
                                </thead>
                                <!-- les options seront ici -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Section Activité récente (Proposition supplémentaire) -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Activité récente
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">28 Septembre 2024 - Choisi la formule 10% pour PROMO123</li>
                            <li class="list-group-item">27 Septembre 2024 - Modifié son mot de passe</li>
                            <li class="list-group-item">26 Septembre 2024 - Utilisation du code PROMO789</li>
                        </ul>
                    </div>
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
    <script src="<?=$plugins?>DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
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

            // Mettre à jour les paramètres utilisateurs
            $('#updateSetting').click(function(event) {
                event.preventDefault();  // Empêche le comportement par défaut du bouton

                var ancienMdp = $('#currentPassword').val();  // Récupérer l'ancien mdp
                var nouveauMdp = $('#newPassword').val();  // Récupérer le nouveau mdp

                // Assurez-vous que les champs ne soient pas vide
                if (ancienMdp !== "" && nouveauMdp !== "") {
                    $.ajax({
                        url: 'setting.php',  // Fichier PHP pour traiter la mise à jour
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
                        url: 'formule.php',  // Fichier PHP pour traiter la mise à jour
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
</body>

</html>

