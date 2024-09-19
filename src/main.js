// function page ticket
function ticket(){

  if($.fn.DataTable.isDataTable('#ticketTable')){
    $('#ticketTable').DataTable().destroy();
  }
    
  var dataTable = $('#ticketTable').DataTable(
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

    // "columnDefs": [

    // 	{
    // 		"searchable": false,
    // 		"targets": [5],
    // 	},

    // 	{
    // 		"searchable": true,
    // 		"targets": [1,2,3,4],
    // 	},

    // 	{
    // 		"orderable": false,
    // 		"targets": [5],
    // 	},
    // 	{
    // 		"orderable": true,
    // 		"targets": [0,1,2,3,4],
    // 	}

    // 	{
    // 		"visible": false,
    // 		"targets": [0]
    // 	}

    // ],

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

};