/* Formatting function for row details - modify as you need */
function format(d) {
    return  
}
// JavaScript Document
$(document).ready(function (e) {

    var selected = [];
    var ped = $('#buspedido').val();
    var table2 = $('#tbpedidos').DataTable({
        /*"columnDefs":[
            { "targets":[0],"visible":false},
            { "targets":[12],"visible":restable},
            //{ "targets":[12],"visible":hidmov}
        ], */
        "dom": '<"top"i>rt<"bottom"lp><"clear">',
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
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
            "url": "json/pedidos/pedidosjson.php",
            "data": {
                ped: ped
            },
            "type": "POST"
        },
        "columns": [
            {
                "class":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },

            { "data" : "pedido",  "className" : "dt-center" },
            { "data" : "usuario", "className" : "dt-center" },           
            { "data" : "fecha",   "className" : "dt-center" },           
            { "data" : "total",   "className" : "dt-center" },					
            { "data" : "editar",  "className" : "dt-center", "orderable" : false,"searchable": false },	
            { "data" : "eliminar","className" : "dt-center", "orderable" : false,"searchable": false},
            { "data" : "imprimir","className" : "dt-center", "orderable" : false,"searchable": false},
            { "data" : "excel",   "className" : "dt-center", "orderable" : false,"searchable": false},

        ],
        "order": [
            [4, 'asc']
        ]
    });

    $('#tbpedidos tbody').on('click', 'tr', function () {
        var id = this.id;
        var index = $.inArray(id, selected);

        if (index === -1) {
            selected.push(id);
        } else {
            selected.splice(index, 1);
        }

        $(this).toggleClass('selected');
    });

    var table2 = $('#tbpedidos').DataTable();

    // Apply the search
    table2.columns().every(function () {
        var that = this;

        $('input', this.footer()).on('keyup change', function () {
            that
                .search(this.value)
                .draw();
        });
    });
    // Add event listener for opening and closing details
    $('#tbpedidos tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table2.row( tr );
        var data = row.data();
        var idpedido  = data.pedido;
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown'); 
        }
        else {
            // Open this row
            var div = "<div id='detallepedio_"+idpedido+"'></div>";
            var tabla = "<div class='col-md-12'><table class='table' id='tbdetalle_"+idpedido+"'>"+
            "<thead>"+
            "<tr><th>PRODUCTO</th><th>PRECIO</th><th>CANTIDAD</th><th>TOTAL</th></tr>"
            +"</thead>"
            +"</table>"+
            "</div>";
            //format(row.data())
            row.child(tabla).show();
            tr.addClass('shown');
            setTimeout(tbDetallepedido(idpedido),500);
            
        }
    } );
});

function tbDetallepedido(idpedido)
{
    var table2 = $('#tbdetalle_'+ idpedido).DataTable({
        /*"columnDefs":[
            { "targets":[0],"visible":false},
            { "targets":[12],"visible":restable},
            //{ "targets":[12],"visible":hidmov}
        ], */
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
            "url": "json/pedidos/detallepedidojson.php",
            "data": {
                idpedido: idpedido
            },
            "type": "POST"
        },
        "columns": [
            { "data" : "producto", "className" : "dt-center" },
            { "data" : "precio",   "className" : "dt-center" },           
            { "data" : "cantidad", "className" : "dt-center" },           
            { "data" : "total",    "className" : "dt-center" },
        ],
        "order": [
            [0, 'asc']
        ]
    });


}