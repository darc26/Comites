/* Formatting function for row details - modify as you need */

// JavaScript Document
$(document).ready(function (e) {

    var selected = [];
    var ests= $('#tbdesarrollo').attr('data-est');
    var idc = $('#tbdesarrollo').attr('data-comites');
    var coleli= true
    if(ests==3 ){
        coleli= false
    }

    var table2 = $('#tbdesarrollo').DataTable({
        "columnDefs":[
            {
                "targets": [ 3 ],
                "visible": coleli,
            },
        ], 
        "dom": '<"top"i>rt<"bottom"lp><"clear">',
        "ordering": true,
        "paging":false,
        "info": false,
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
            "url": "json/comites/detallecomitejson.php",
            "data": {
           
                idc:idc
            },
            "type": "POST"
        },
        "columns": [

            { "data" : "desarrollo", "className" : "dt-center" },
            { "data" : "asistente",  "className" : "dt-center" },
            { "data" : "fechcumpli", "className" : "dt-center" },
            { "data" : "editar",     "className" : "dt-center edit" , "orderable" : false,"searchable": false },
            { "data" : "eliminar",   "className" : "dt-center" , "orderable" : false,"searchable": false },

        ],
        "order": [
            [0, 'asc']
        ]
    });

    $('#tbdesarrollo tbody').on('click', 'tr', function () {
        var idc = this.idc;
        var index = $.inArray(idc, selected);

        if (index === -1) {
            selected.push(idc);
        } else {
            selected.splice(index, 1);
        }

        $(this).toggleClass('selected');
    });

    var table2 = $('#tbdesarrollo').DataTable();

    $('#tbdesarrollo tbody').on('click', 'td.edit', function () {
        var tr = $(this).closest('tr');
        var row = table2.row( tr );
        var data = row.data();
        var idcomit  = data.Codigo;
        var esta = data.estado;
        $('.select').show();
        $('#btnguardar4').attr('onclick',"CRUDCOMITES('MODIFICARDESARROLLO',"+data.comite+","+data.clave+")")
        // console.log(data.desarrollo);
        $('#txtdesarrollo').val(data.desarrollo);
        var decs=data.desarrollo; 
        // console.log(decs);
        setTimeout(function(){
            console.log(decs);
            $('#txtdesarrollo').summernote({
                width: 1000,
                tooltip: false, 
                placeholder: decs,
            });
        },100)
 
       
    } );

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
