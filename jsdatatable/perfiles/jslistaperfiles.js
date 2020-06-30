/* Formatting function for row details - modify as you need */

// JavaScript Document
$(document).ready(function(e) {

    var selected = [];
    var per = $('#busperfil').val();
    var edit = $('#tbperfil').attr('data-edit');
    var elim = $('#tbperfil').attr('data-elim');	
    var perm = $('#tbperfil').attr('data-perm');	
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
            
    var table2 = $('#tbperfil').DataTable( { 
    "columnDefs":[
       {
				"targets": [ 3 ],
				"visible": coleli,
			},
			{
				"targets": [ 2 ],
				"visible": coledit,
			},
			{
				"targets": [ 4],
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
                "url": "json/perfiles/perfilesjson.php",
                "data": {per:per},
                "type":"POST"
            },
    "columns": [					
        
   						
        { "data" : "perfil", "className" : "dt-center" },	
        { "data" : "estado", "className" : "dt-center" },					
        { "data" : "editar",   "className" : "dt-center", "orderable" : false,"searchable": false },	
        { "data" : "eliminar", "className" : "dt-center", "orderable" : false,"searchable": false},
        { "data" : "permiso", "className" : "dt-center", "orderable" : false,"searchable": false},


        
    ],
    "order": [[0, 'asc']]
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

 var table2 = $('#tbperfil').DataTable();

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


