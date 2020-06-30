/* Formatting function for row details - modify as you need */

// JavaScript Document
$(document).ready(function(e) {

		var selected = [];
		var edit = $('#tbusuarios').attr('data-edit');
		var elim = $('#tbusuarios').attr('data-elim');	
		var perm = $('#tbusuarios').attr('data-perm');	
		var nom = $('#busnombre').val();
		var ape = $('#busapellido').val();
		var ema = $('#buscorreo').val();
		var per = $('#busperfil').val();
		var coleli= true;
		var coledit=true;
		var colper=true;
		if (elim == 0) {
			coleli= false;
			
		}
		 if (edit==0) {
			coledit= false;
			
		} 
		if (perm==0) {
			colper= false;
			
		} 
				
		var table2 = $('#tbusuarios').DataTable( { 
		"columnDefs":[
			{
				"targets": [ 7 ],
				"visible": coleli,
			},
			{
				"targets": [ 6 ],
				"visible": coledit,
			},
			{
				"targets": [ 8 ],
				"visible": colper,
			},
		],     
       	"dom": '<"top"i>rt<"bottom"lp><"clear">',
		"ordering": true,
		"info": true,
		"autoWidth": true,
		"responsive": true,
		"pagingType": "simple_numbers",
		"lengthMenu": [[10,15,20,-1], [10,15,20,"Todos"]],
		"language": {
		"lengthMenu": "Ver _MENU_ registros",
		"zeroRecords": "No se encontraron datos",
		"info": "Resultado _START_ - _END_ de _TOTAL_ registros",
		"infoEmpty": "No se encontraron datos",
		"infoFiltered": "",
		"paginate": {"previous": "Anterior","next":"siguiente"},
		"search":"",
		"sSearchPlaceholder":"Busqueda"
		},	
		"processing": true,
        "serverSide": true,
        "ajax": {
                    "url": "json/usuarios/usuariosjson.php",
                    "data": {nom:nom,ape:ape,ema:ema,per:per},
                    "type":"POST"
				},
		"columns": [					
			
			{ "data" : "nombre",   "className" : "dt-left " },//td_mayuscula
			{ "data" : "apellido", "className" : "dt-left" },	
			{ "data" : "correo",   "className" : "dt-center" },
			{ "data" : "usuario",  "className" : "dt-center" },						
			{ "data" : "perfil",   "className" : "dt-center" },	
			{ "data" : "estado",   "className" : "dt-center" },					
			{ "data" : "editar",   "className" : "dt-center", "orderable" : false,"searchable": false },	
			{ "data" : "eliminar", "className" : "dt-center", "orderable" : false,"searchable": false},
			{ "data" : "permiso",  "className" : "dt-center", "orderable" : false,"searchable": false},
			
		],
		"order": [[1, 'asc']]
    } );
     
	 $('#tbusuarios tbody').on('click', 'tr', function () {
        var id = this.id;
        var index = $.inArray(id, selected);
 
        if ( index === -1 ) {
            selected.push( id );
        } else {
            selected.splice( index, 1 );
        }
 
        $(this).toggleClass('selected');
    } );	
	
	 var table2 = $('#tbusuarios').DataTable();
 
    // Apply the search
     table2.columns().every( function () {
        var that = this;
 
      	$( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
	} );
});


