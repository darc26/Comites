/* Formatting function for row details - modify as you need */

// JavaScript Document
$(document).ready(function(e) {
    
    var selected = [];
    var ests = $('#tbcomite').attr('data-estado');
    var edit = $('#tbcomite').attr('data-edit');
    var elim = $('#tbcomite').attr('data-elim');	
    var opcion = $('#tbcomite').attr('data-opcion');		
    var cla =  $('#buscomite').val();
    var tem =  $('#bustema').val();   
    var est =  $('#busestado').val();   
    var fec1 = $('#busfecha1').val();
    // var fec1 = $('#busfecha1').val();
    var hoin = $('#horainicio').val();
    var fec2 = $('#busfecha2').val();   
    var nom =  $('#busnombre').val();
    var coleli= true;
    var colinf=true;
    var colmot= false;
    var coledit=true;
    var colper=true;

    if (ests==2  ) {
        if (elim == 0) {
            coleli= false;
            colinf=true;
		}
		 if (edit==0) {
            coledit= false;
            colinf=true;
		} else{
            coleli= false;
            colinf=true;
            colmot= true; 
        }

    }else if (ests==3) {
        if (elim == 0) {
			coleli= false;
		}
		 if (edit==0) {
			coledit= false;
		} else{
            coleli= false;
            colinf=true;
            colmot= false;
        }
    } 
    else if (ests==1) {
        if (elim == 0) {
			coleli= false;
		}
		 if (edit==0) {
			coledit= false;
		} else{
            coleli= true;
            colinf=true;
            colmot= false;
        }
    }else{
        if (elim == 0) {
			coleli= false;
		}
		 if (edit==0) {
			coledit= false;
        } 
        
    }
    var table2 = $('#tbcomite').DataTable( { 
    "columnDefs":[
        {
            "targets": [ 10 ],
            "visible": coleli,
        },
        {
            "targets": [ 11 ],
            "visible": colinf,
        },
        {
            "targets": [ 9 ],
            "visible": coledit,
        },
        {
            "targets": [ 7,8 ],
            "visible": colmot,
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
                "url" : "json/comites/comitesjson.php",
                "data": {cla:cla,fec1:fec1,fec2:fec2,est:est,tem:tem,nom:nom,hoin:hoin,ests:ests,opcion:opcion },
                "type":"POST"
            },
    "columns": [
        {
            "class":      'details-control',
            "orderable":      false,
            "data":           null,
            "defaultContent": ''
        },	
        { "data" : "Codigo",      "className" : "dt-left " },//td_mayuscula
        { "data" : "nombre",      "className" : "dt-left " },//td_mayuscul
        { "data" : "fecha",       "className" : "dt-left" },	
        { "data" : "horaini",     "className" : "dt-center" },	
        { "data" : "horafin",     "className" : "dt-left " },//td_mayuscul
        { "data" : "estado",       "className" : "dt-center" },		
        { "data" : "motivo",     "className" : "dt-left " },//td_mayuscul
        { "data" : "fecelimi",     "className" : "dt-left " },//td_mayuscul
        { "data" : "editar",      "className" : "dt-center", "orderable" : false,"searchable": false },	
        { "data" : "eliminar",    "className" : "dt-center", "orderable" : false,"searchable": false},
        { "data" : "imprimir",    "className" : "dt-center", "orderable" : false,"searchable": false},
    ],
    "order": [[1, 'asc']],
} );
 $('#tbcomite tbody').on('click', 'tr', function () {
    var id = this.id;
    var index = $.inArray(id, selected);
    if ( index === -1 ) {
        selected.push( id );
    } else {
        selected.splice( index, 1 );
    }
    $(this).toggleClass('selected');
} );	
 var table2 = $('#tbcomite').DataTable();
// Apply the search
    table2.columns().every( function () {
    var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
        that
            .search( this.value )
            .draw();
        } );
    });
    $('#tbcomite tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table2.row( tr );
        var data = row.data();
        var idcomit  = data.Codigo;
        var esta = data.estado;
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            var div = "<div id='detallecomite_"+idcomit+"'></div>";
            var tabla = "<div class='col-md-12'><table class='table' id='tbdetallecom_"+idcomit+"' data-etad="+esta+">"+
            "<thead>"+
            "<tr></th><th>Participantes </th><th>Tema</th><th>Correo</th><th>Fecha</th><th></th></tr>"
            +"</thead>"
            +"</table>"+
            "</div>";
            //format(row.data())
            row.child(tabla).show();
            tr.addClass('shown');
            setTimeout(tbDetallecomite(idcomit),500);
        }
    } );
    
});
function tbDetallecomite(idcomit)
{
    var estd = $('#tbdetallecom_'+ idcomit).attr('data-etad');
    var coleli= true
    if(estd=="Cerrado" ){
        coleli= false
    }
    var table2 = $('#tbdetallecom_'+ idcomit).DataTable({
        "columnDefs":[
            {
                "targets": [ 4 ],
                "visible": coleli,
            }, 
        ], 
        "dom": '<"top"i>rt<"bottom"lp><"clear">',
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "paging":false,
        "searching":false,
        "pagingType": "simple_numbers",
        "lengthMenu": [
            [10, 15, 20, -1],
            [10, 15, 20, "Todos"]
        ],
        "language": {
            "lengthMenu": "Ver _MENU_ registros",
            "zeroRecords": "No se encontraron datos",
            "info": "Resultado _START_ - _END_ de _TOTAL_ registros",
            "infoEmpty": "No se encontraron datos",
            "infoFiltered": "",
            "paginate": {
                "previous": "Anterior",
                "next": "siguiente"
            },
            "search": "",
            "sSearchPlaceholder": "Busqueda"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "json/comites/asistentesjson.php",
            "data": {
                id: idcomit
            },
            "type": "POST"
        },
        "columns": [
            { "data" : "asistente",  "className" : "dt-center" },
            { "data" : "desarrollo", "className" : "dt-center" },            
            { "data" : "correo", "className" : "dt-center" },
            { "data" : "fechcumpli", "className" : "dt-center" },
            { "data" : "eliminar",   "className" : "dt-center" , "orderable" : false,"searchable": false }
        ],
        "order": [
            [0, 'asc']
        ]
    });
}
$('#tbdetallecom_ tbody').on('click', 'tr', function () {
    var id = this.id;
    var index = $.inArray(id, selected);
    if ( index === -1 ) {
        selected.push( id );
    } else {
        selected.splice( index, 1 );
    }
    $(this).toggleClass('selected');
} );	