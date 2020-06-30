/* Formatting function for row details - modify as you need */

// JavaScript Document
$(document).ready(function (e) {

    var selected = [];
    var pro = $('#busnombre').val();
    var idpedido = $('#tbproductos').attr('data-pedido');
    var table2 = $('#tbproductos').DataTable({
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
            "url": "json/pedidos/productosjson.php",
            "data": {
                pro: pro,
                idpedido:idpedido
            },
            "type": "POST"
        },
        "columns": [
         
            { "data" : "nombre",      "className" : "dt-center" },
            { "data" : "descripcion", "className" : "dt-center" },
            { "data" : "precio",      "className" : "dt-center" },
            { "data" : "categoria",   "className" : "dt-center" },
            { "data" : "cantidad",    "className" : "dt-center" },
            { "data" : "totalpar",    "className" : "dt-center" },         				
            	
            

        ],
        "order": [
            [0, 'asc']
        ]
    });

    $('#tbproductos tbody').on('click', 'tr', function () {
        var id = this.id;
        var index = $.inArray(id, selected);

        if (index === -1) {
            selected.push(id);
        } else {
            selected.splice(index, 1);
        }

        $(this).toggleClass('selected');
    });

    var table2 = $('#tbproductos').DataTable();

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
    
});
