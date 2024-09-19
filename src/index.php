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
            <h1 class="text-4xl font-bold mb-8 text-gray-800">Page d'accueil</h1>

            <!-- Formulaire -->
            <form id="promoForm" class="bg-white p-6 rounded-lg shadow-md space-y-4">
                <div>
                    <label for="name" class="block text-lg font-medium text-gray-700">Nom:</label>
                    <input type="text" id="name" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-custom focus:border-custom p-2">
                </div>

                <div>
                    <label for="phone" class="block text-lg font-medium text-gray-700">Numéro de téléphone:</label>
                    <input type="tel" id="phone" name="phone" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-custom focus:border-custom p-2">
                </div>

                <button type="submit" class="w-full bg-custom text-gray-800 font-bold py-2 px-4 rounded-md shadow hover:bg-yellow-400">
                    Soumettre
                </button>
            </form>

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
    <!-- Table JS -->
    <script src="DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
    <!--===============================================================================================-->
    <script src="DataTables-1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <!--===============================================================================================-->
    <script src="DataTables-1.10.20/js/dataTables.responsive.min.js"></script>
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
                // "order": [],
                // "oderMulti":true,
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
                    "infoPostFix":      "(Trajets)",
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

           

        });
        // Ajout dynamique des infos du formulaire dans le tableau
        document.getElementById("promoForm").addEventListener("submit", function(event){
            event.preventDefault();

            // Récupérer les valeurs du formulaire
            var name = document.getElementById("name").value;
            var phone = document.getElementById("phone").value;
            var promoCode = document.getElementById("promoCode").value;

            // Simuler le nombre de fois où le code promo a été utilisé
            var timesUsed = Math.floor(Math.random() * 10) + 1;

            // Ajouter une nouvelle ligne dans le tableau
            var table = document.getElementById("promoTable").getElementsByTagName('tbody')[0];
            var newRow = table.insertRow();

            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);

            cell1.innerHTML = name;
            cell2.innerHTML = phone;
            cell3.innerHTML = promoCode;
            cell4.innerHTML = timesUsed;

            // Réinitialiser le formulaire après soumission
            document.getElementById("promoForm").reset();
        });
    </script>

</body>
</html>
