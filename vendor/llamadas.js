const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
function ok(msn){   
    Toast.fire({
        type: 'success',
        title: msn
    })
}
function ok2(msn)
{
	  swal({
		position: 'center',
		type: 'success',
		title: msn,
		showConfirmButton: true,
		confirmButtonText:"Aceptar"
		})
}
function error(msn){
    Toast.fire({
        type: 'error',
        title: msn
    })
}
function error2(msn) {
	swal({
		position: 'center',
		type: 'error',
		title: msn,
		text: "Cualquier inquietud comunicate a ### ## ## / ### ### ####",
		showConfirmButton: true,
		confirmButtonText: "Aceptar"
		//timer: 1500
	})
}
function validar_texto(e) {
	tecla = (document.all) ? e.keyCode : e.which;
	//Tecla de retroceso para borrar, siempre la permite
	if (tecla == 8) {
		return true;
	}
	// Patron de entrada, en este caso solo acepta numeros
	patron = /[0-9\.]/g, "0";
	tecla_final = String.fromCharCode(tecla);
  return patron.test(tecla_final);
}
String.prototype.trim = function () {
    return this.replace(/^\s+/, '').replace(/\s+$/, '');
};
  String.prototype.capitalizeParagraph = function () {
    var res = "";
    //var paragraphs = this.split(".")
    res = this.toUpperCase();
    /*for(var i = 0; i < paragraphs.length ; i++) {
      var temp = paragraphs[i];
      res += "." + temp.charAt(0).toUpperCase() + temp.slice(1);
    }*/
    return res; //.slice(1);
};
function setpreview(rut,inp,formu,tmp = 'tmp') // creamos la función
 { 
	 var datos = new FormData();   
	  
     datos.append('ruta',rut);
     datos.append('input',$( '#'+inp )[0].files[0]);
	 datos.append('formu',formu);
	 datos.append('tmp',tmp);
 
    /*$("#loadMe").modal({
    backdrop: "static", //remove ability to close modal with click
    keyboard: false, //remove option to close with keyboard
    show: true //Display loader!
    });
    $('#msnload').text("Cargando archivo por favor espera");*/
 
    //info("Cargando archivo por favor espera")
     $.ajax({
            url: "upload.php",
            type: "POST",
            data: datos,     
            async:false,       
            contentType: false,
            cache: false,
            processData:false,
            dataType:"json",
            crossDomain : true,
            }).                               
    done( function(data)
    {
        console.log(data);
        var res = data.res;
        var url = data.url;
        var msn = data.msn;
        console.log(msn);
        
        if($.trim(res)=="error")
        {           
            error("No se cargo el archivo");
            ///$("#loadMe").modal("hide");
        }                
        else if(jQuery.trim(res)=="ok")
        {
            $('#'+rut).html(url);
            //ok("Archivo cargado");
            //$("#loadMe").modal("hide");
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
     if ( console && console.log ) {
         console.log( "La solicitud a fallado: " +  textStatus);
         result = true;
         //$("#loadMe").modal("hide");
     }
    });
}
function CONTRASENASEGURA() {
  $('.check-seguridad').strength({
    templates: {
      toggle: '<span class="input-group-addon"><span class="glyphicon glyphicon-eye-open {toggleClass}"></span></span>'
    },
    scoreLables: {
      empty: 'Vacío',
      invalid: 'Invalido',
      weak: 'Débil',
      good: 'Bueno',
      strong: 'Fuerte'
    },
    scoreClasses: {
      empty: 'label-vasio',
      invalid: 'label-danger',
      weak: 'label-warning',
      good: 'label-info',
      strong: 'label-success'
      },
  });
 
}
function INICIALIZARHOME()
{
    var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

    var salesChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label               : 'Digital Goods',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [28, 48, 40, 19, 86, 27, 90]
      },
      {
        label               : 'Electronics',
        backgroundColor     : 'rgba(210, 214, 222, 1)',
        borderColor         : 'rgba(210, 214, 222, 1)',
        pointRadius         : false,
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : [65, 59, 80, 81, 56, 55, 40]
      },
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas, { 
      type: 'line', 
      data: salesChartData, 
      options: salesChartOptions
    }
  )

  //---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------

  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: [
          'Chrome', 
          'IE',
          'FireFox', 
          'Safari', 
          'Opera', 
          'Navigator', 
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var pieOptions     = {
      legend: {
        display: false
      }
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions      
    })

  //-----------------
  //- END PIE CHART -
  //-----------------

  /* jVector Maps
   * ------------
   * Create a world map with markers
   */
  $('#world-map-markers').mapael({
      map: {
        name : "usa_states",
        zoom: {
          enabled: true,
          maxLevel: 10
        },
      },
    }
  );
}
function INICIALIZARCONTENIDO()
{   
    $(".dropify").dropify({
		  messages: {
			'default': 'Arrastre imagen o haga click aqui',
			'replace': 'Arrastre y suelte o haga clic para reemplazar',
			'remove': 'Eliminar',
			'error': 'Ooops, algo pasó mal'
		  }
	  });

	//autosize($('textarea'));

  //lista con filtros
  

  

	$('.selectpicker').selectpicker({
		

	}).on('change', function () {
	//	$(this).selectpicker('toggle');	
    
    	
  });
  
  $('.currency4').formatCurrency({ symbol: '', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });
  $('.currency').formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });
  $('.currency3').formatCurrency({ symbol: '%', eventOnDecimalsEntered: true, roundToDecimalPlace: 1 });
  $('.currency2').formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });

	$('.currency2').blur(function() {
		//$('.currency').html(null);
		$(this).formatCurrency({ symbol: '', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });
	})
	.focus(function(){
		$(this).formatCurrency({ symbol: '', eventOnDecimalsEntered: true, roundToDecimalPlace: 0, digitGroupSymbol: '', });			
	})
	.bind('decimalsEntered', function(e, cents) {
		var errorMsg = 'Please do not enter any cents (0.' + cents + ')';				
		//console.log('Event on decimals entered: ' + errorMsg);
	});	

	$('.currency').blur(function() {
		//$('.currency').html(null);
		$(this).formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });
	})
	.focus(function(){
		$(this).formatCurrency({ symbol: '', eventOnDecimalsEntered: true, roundToDecimalPlace: 0, digitGroupSymbol: '', });			
	})
	.bind('decimalsEntered', function(e, cents) {
		var errorMsg = 'Please do not enter any cents (0.' + cents + ')';				
		//console.log('Event on decimals entered: ' + errorMsg);
	});	
}
function CRUDHOME(o,id)
{
  if(o=="CARGARHOME")
  {
    $.post('funciones/home/fnHome.php', {
      opcion: o,
      id:id
      }, function (data) {
          $('#divhome').html(data);
      })
  }
}
function CRUDPERFIL(o,id,idu)
{
    $('#myModal>.modal-dialog').removeClass('modal-lg');
    if(o=="NUEVO")
    {
        
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Nuevo Perfil" );
        $('#btnguardar').attr('onclick',"CRUDPERFIL('GUARDAR','"+id+"')");
        $('#btnguardar').html("Guardar").show();
        $.post('funciones/perfiles/fnPerfiles.php',{
            opcion: o,
            id: id
        },function(data){
            $('#contentmodal').html(data);
            $('#overlaymodal').css('display','none !important');
        })
    }
    else if(o=="EDITAR")
    {
        
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Edición Perfil");
        $('#btnguardar').attr('onclick',"CRUDPERFIL('GUARDAREDICION','"+id+"')");
        $('#btnguardar').html("Guardar Cambios").show();
        $.post('funciones/perfiles/fnPerfiles.php',{
            opcion: o,
            id: id
        },function(data){
            $('#contentmodal').html(data);
            $('#overlaymodal').css('display','none !important');
        })
    }else if(o=="GUARDAR" || o=="GUARDAREDICION")
    {
        $('#frmperfil').parsley().validate();
		    if ($('#frmperfil').parsley().isValid())
		    {
            var txtperfil = $('#txtperfil').val();           
            var est = $('input:radio[name=radestado]:checked').val();
         
				        $.post('funciones/perfiles/fnPerfiles.php', {
                    opcion:o,
                    id:id,
                    txtperfil: txtperfil,
                    est:est,
                   
                },
                function (data) 
                {
                    var res = data[0].res;
                    var msn = data[0].msn;
                    if (res == "ok") 
                    {
                        $('#myModal').modal('hide');
                        var table = $('#tbperfil').DataTable();
                        if(o=="GUARDAR")
                        {                              
                            table.draw('full-hold');  
                        }
                        else{
                            table.row('#row_' + id).draw(false); 
                        }		
							          ok(msn);
						        }else{
							          error(msn);
					        	}
					      }, "json");
			      
        }
    }else if (o=="LISTAPERFILES")
	  {
        $.post('funciones/perfiles/fnPerfiles.php', {
        opcion: o,
        id:id
        }, function (data) {
            $('#tabladatos').html(data);
        })
    }else if(o=="FILTROS")
    {
      $.post('funciones/perfiles/fnPerfiles.php',{opcion:o,id},function(data){
        $('#filtros').html(data);
      })
    }else if (o=="ELIMINAR")
	  {
        
        
        swal({
          title: "Realmente desea eliminar el perfil seleccionado",
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar!',
          cancelButtonText: 'No eliminar!'
        }).then(function (result) {
          if (result.value) {

            $.post('funciones/perfiles/fnPerfiles.php', {
              opcion:o,
              id:id
             
            },
            function (data) {
              var res = data[0].res;
              var msn = data[0].msn;
                  if (res == "ok") {
                      ok(msn);
                      var table = $('#tbperfil').DataTable();
                      table.row('#row_' + id).remove().draw(false);
                  } else {
                      error(msn);
                  }
            }, "json");
          }
        });
    }else if(o=="ASIGNARPERMISOS")
    {
        //$('#btnguardar').attr('onclick',"CRUDcomiteS('GUARDAREDICION','"+id+"','')").show();
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Permisos comite");
        $('#contentmodal').html('');
        $('#myModal>.modal-dialog').addClass("modal-lg");
        $.post('funciones/perfiles/fnPerfiles.php',{opcion:o,id:id},
        function(data)
        {
          $('#contentmodal').html(data);
          $('#overlaymodal').css('display','none !important');
        })
    }else if(o=="LISTAPERMISOS")
    {
      $.post('funciones/perfiles/fnPerfiles.php',{opcion:o,id:id,ven:idu},
      function(data)
      {
        $('#ventana-' + idu).html(data);
      })
    }
    else if(o=="GUARDARPERMISOS")
    {
	
      $.post('funciones/perfiles/fnPerfiles.php',{opcion:o,idp:id,idu:idu},
      function(data)
      {
        var res = data[0].res;
        var msn = data[0].msn;
        if(res=="ok")
        {
          ok("");
        }
        else
        {
          error(msn);
        }
      },"json")
    }
}
function CRUDCATEGORIA(o,id,idu){
    $('#myModal>.modal-dialog').removeClass('modal-lg');
    if(o=="NUEVO")
    {
        
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Nuevo Categoria" );
        $('#btnguardar').attr('onclick',"CRUDCATEGORIA('GUARDAR','"+id+"')");
        $('#btnguardar').html("Guardar").show();
        $.post('funciones/categorias/fnCategorias.php',{
            opcion: o,
            id: id
        },function(data){
            $('#contentmodal').html(data);
            $('#overlaymodal').css('display','none !important');
        })
    }
    else if(o=="EDITAR")
    {
        
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Edición Categoria");
        $('#btnguardar').attr('onclick',"CRUDCATEGORIA('GUARDAREDICION','"+id+"')");
        $('#btnguardar').html("Guardar Cambios").show();
        $.post('funciones/categorias/fnCategorias.php',{
            opcion: o,
            id: id
        },function(data){
            $('#contentmodal').html(data);
            $('#overlaymodal').css('display','none !important');
        })
    }else if(o=="GUARDAR" || o=="GUARDAREDICION")
    {
        $('#frmcategoria').parsley().validate();
		    if ($('#frmcategoria').parsley().isValid())
		    {
            var txtcategoria = $('#txtcategoria').val();           
            var est = $('input:radio[name=radestado]:checked').val();
         
				        $.post('funciones/categorias/fnCategorias.php', {
                    opcion:o,
                    id:id,
                    txtcategoria: txtcategoria,
                    est:est,
                   
                },
                function (data) 
                {
                    var res = data[0].res;
                    var msn = data[0].msn;
                    if (res == "ok") 
                    {
                        $('#myModal').modal('hide');
                        var table = $('#tbcategoria').DataTable();
                        if(o=="GUARDAR")
                        {                              
                            table.draw('full-hold');  
                        }
                        else{
                            table.row('#row_' + id).draw(false); 
                        }		
							          ok(msn);
						        }else{
							          error(msn);
					        	}
					      }, "json");
			      
        }
    }else if (o=="LISTACATEGORIAS")
	  {
        $.post('funciones/categorias/fnCategorias.php', {
        opcion: o,
        id:id
        }, function (data) {
            $('#tabladatos').html(data);
        })
    }else if(o=="FILTROS")
    {
      $.post('funciones/categorias/fnCategorias.php',{opcion:o,id},function(data){
        $('#filtros').html(data);
      })
    }else if (o=="ELIMINAR")
	  {
        
        
        swal({
          title: "Realmente desea eliminar la categoria seleccionado",
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar!',
          cancelButtonText: 'No eliminar!'
        }).then(function (result) {
          if (result.value) {

            $.post('funciones/categorias/fnCategorias.php', {
              opcion:o,
              id:id
             
            },
            function (data) {
              var res = data[0].res;
              var msn = data[0].msn;
                  if (res == "ok") {
                      ok(msn);
                      var table = $('#tbcategoria').DataTable();
                      table.row('#row_' + id).remove().draw(false);
                  } else {
                      error(msn);
                  }
            }, "json");
          }
        });
    }else if(o=="ASIGNARPERMISOS")
    {
        //$('#btnguardar').attr('onclick',"CRUDcomiteS('GUARDAREDICION','"+id+"','')").show();
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Permisos comite");
        $('#contentmodal').html('');
        $('#myModal>.modal-dialog').addClass("modal-lg");
        $.post('funciones/categorias/fnCategorias.php',{opcion:o,id:id},
        function(data)
        {
          $('#contentmodal').html(data);
          $('#overlaymodal').css('display','none !important');
        })
    }else if(o=="LISTAPERMISOS")
    {
      $.post('funciones/categorias/fnCategorias.php',{opcion:o,id:id,ven:idu},
      function(data)
      {
        $('#ventana-' + idu).html(data);
      })
    }
    else if(o=="GUARDARPERMISOS")
    {
	
      $.post('funciones/categorias/fnCategorias.php',{opcion:o,idp:id,idu:idu},
      function(data)
      {
        var res = data[0].res;
        var msn = data[0].msn;
        if(res=="ok")
        {
          ok("");
        }
        else
        {
          error(msn);
        }
      },"json")
    }
}
function CRUDUSUARIOS(o,id,idu)
{
  //$('#myModal>.modal-dialog').removeClass('modal-lg');
    var ti = localStorage.getItem('lstipousuario');
    var tex = (ti==2) ? 'cliente':'usuario';
    if(o=="NUEVO")
    {
      $('#myModal>.modal-dialog').removeClass('modal-lg');
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Nuevo " + tex);
        $('#btnguardar').attr('onclick',"CRUDUSUARIOS('GUARDAR','"+id+"')");
        $('#btnguardar').html("Guardar");
        $.post('funciones/usuarios/fnUsuarios.php',{
            opcion: o,
            id: id,
            ti: ti
        },function(data){
            $('#contentmodal').html(data);
            $('#overlaymodal').css('display','none !important');
        })
    }
    else if(o=="AJUSTECUENTA")
    {
      $('#overlaymodal').css('display','block !important');
      $('#titlemodal').html("Mi cuenta");
      $('#btnguardar').attr('onclick',"CRUDUSUARIOS('GUARDARAJUSTE','"+id+"')");
      $('#btnguardar').html("Guardar Cambios");
      $.post('funciones/usuarios/fnUsuarios.php',{
          opcion: o,
          id: id
      
      },function(data){
          $('#contentmodal').html(data);
          $('#overlaymodal').css('display','none !important');
      })
    }
    else if(o=="EDITAR")
    {
      $('#myModal>.modal-dialog').removeClass('modal-lg');
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Edición " + tex);
        $('#btnguardar').attr('onclick',"CRUDUSUARIOS('GUARDAREDICION','"+id+"')");
        $('#btnguardar').html("Guardar Cambios");
        $.post('funciones/usuarios/fnUsuarios.php',{
            opcion: o,
            id: id,
            ti:ti
        },function(data){
            $('#contentmodal').html(data);
            $('#overlaymodal').css('display','none !important');
        })
    }
    else if(o=="GUARDAR" || o=="GUARDAREDICION")
    {
        $('#frmusuario').parsley().validate();
		    if ($('#frmusuario').parsley().isValid())
		    {
                  
            var txtnombre = $('#txtnombre').val();
            var txtapellido = $('#txtapellido').val();
            var txtemail = $('#txtemail').val();            
            var txtusuario = $('#txtusuario').val();
            var txtcontrasena = $('#txtcontrasena').val();            
            var txtpass1 = $('#txtverificar').val();
            var selperfil = $('#selperfil').val(); 
            var est = $('input:radio[name=radestado]:checked').val();
          
            if (txtemail.indexOf('@', 0) == -1 || txtemail.indexOf('.', 0) == -1) {
				        error('Formato de correo electrónico no valido. Ejemplo:example@mail.com. Verificar');
            } 
            else 
			      {
				        $.post('funciones/usuarios/fnUsuarios.php', {
                    opcion:o,
                    id:id,                   
                    txtnombre: txtnombre,
                    txtapellido: txtapellido,                   
                    txtusuario: txtusuario,
                    txtemail: txtemail,
                    txtcontrasena:txtcontrasena,
                    selperfil:selperfil,
                    est:est,
                    
                   
                  
                },
                function (data) 
                {
                    var res = data[0].res;
                    var msn = data[0].msn;
                    if (res == "ok") 
                    {
                        //$('#myModal').modal('hide');
                        var table = $('#tbusuarios').DataTable();
                         ok(msn);
                        if(o=="GUARDAR")
                        {                     
                          $('#txtnombre').val("");
                          $('#txtapellido').val("");
                          $('#selmercado>option[value=""]').attr('selected',"selected");                         
                          $('#txtemail').val("");                          
                          $('#txtusuario').val("");
                          $('#txtcontrasena').val("");
                          $('#txtverificar').val("");
                          $('#selperfil').val("");
                          $('#seldistritos>option:selected').attr('selected',false);//limpiar select multiples 
                          //var selperfil = $('#selperfil').val(); 
                          if(idu==2){
                            setTimeout(CRUDCOMITES('CARGARUSUARIOS'),1000);
                          } else{
                            table.draw('full-hold');  
                          }         
                            
                        }
                        else{
                            table.row('#row_' + id).draw(false); 
                        }		
                       
                        
							         
						        }else{
							          error(msn);
					        	}
					      }, "json");
			      }
        }
    }else if(o=="GUARDARUSUARIOS" )
    {
        $('#frmusuario').parsley().validate();
		    if ($('#frmusuario').parsley().isValid())
		    {
                  
            var txtnombre = $('#txtnombre').val();
            var txtapellido = $('#txtapellido').val();
            var txtemail = $('#txtemail').val();            
            var txtusuario = $('#txtusuario').val();
            var txtcontrasena = $('#txtcontrasena').val();            
            var txtpass1 = $('#txtverificar').val();
            var selperfil = $('#selperfil').val(); 
            var est = $('input:radio[name=radestado]:checked').val();
          
            if (txtemail.indexOf('@', 0) == -1 || txtemail.indexOf('.', 0) == -1) {
				        error('Formato de correo electrónico no valido. Ejemplo:example@mail.com. Verificar');
            } 
            else 
			      {
				        $.post('funciones/usuarios/fnUsuarios.php', {
                    opcion:o,
                    id:id,                   
                    txtnombre: txtnombre,
                    txtapellido: txtapellido,                   
                    txtusuario: txtusuario,
                    txtemail: txtemail,
                    txtcontrasena:txtcontrasena,
                    selperfil:selperfil,
                    est:est,
                    
                   
                  
                },
                function (data) 
                {
                    var res = data[0].res;
                    var msn = data[0].msn;
                    if (res == "ok") 
                    {
                        $('.btnusuario').tooltipster('hide');
                        var table = $('#tbusuarios').DataTable();
                         ok(msn);
                        if(o=="GUARDAR")
                        {                     
                          $('#txtnombre').val("");
                          $('#txtapellido').val("");
                          $('#selmercado>option[value=""]').attr('selected',"selected");                         
                          $('#txtemail').val("");                          
                          $('#txtusuario').val("");
                          $('#txtcontrasena').val("");
                          $('#txtverificar').val("");
                          $('selperfil').val("");
                          $('#seldistritos>option:selected').attr('selected',false);//limpiar select multiples 
                          //var selperfil = $('#selperfil').val();           
                             
                        }
                        else{
                            table.row('#row_' + id).draw(false); 
                        }		
                       
                        
							         
						        }else{
							          error(msn);
					        	}
					      }, "json");
			      }
        }
    }
    else if(o=="GUARDARAJUSTE")
    {
        $('#frmusuario').parsley().validate();
		    if ($('#frmusuario').parsley().isValid())
		    {
            
            
            var txtnombre = $('#txtnombre').val();
            var txtapellido = $('#txtapellido').val();
            var txtcelular = $('#txtcelular').val();
            var txtfijo = $('#txtfijo').val();
            var txtcorreo = $('#txtcorreo').val();
            //var txtnit = $('#txtnit').val();
            //var txtusuario = $('#txtusuario').val();
            var txtdireccion = $('#txtdireccion').val();
            //var txtcontacto = $('#txtcontacto').val();
            var txtpass = $('#txtcontrasena').val();
            var lc = txtpass.length
            var txtpass1 = $('#txtverificar').val();
           // var selperfil = $('#selperfil').val(); 
           // var seldistritos = $('#seldistritos').val();  
           // var est = $('input:radio[name=radestado]:checked').val();
           /*if (txtemail.indexOf('@', 0) == -1 || txtemail.indexOf('.', 0) == -1) {
				        error('Formato de correo electrónico no valido. Ejemplo:example@mail.com. Verificar');
            } 
            else 
            {*/
            if(txtpass!=txtpass1)
            {
              error("Las contraseñas deben coincidir");
            }
            else{
				        $.post('funciones/usuarios/fnUsuarios.php', {
                    opcion:o,
                    id:id,
                    nom: txtnombre,
                    ape: txtapellido,
                    //doc: txtnit,
                    //usu: txtusuario,
                    cel: txtcelular,
                    fij: txtfijo,
                    ema: txtcorreo,
                    dir: txtdireccion,
                    //bar: txtbarrio,
                    pass:txtpass,
                    //perfil:selperfil,
                    //est: est,
                    //mer: selmercado,
                    //tex: tex,
                    //ti: ti,
                    //contacto:txtcontacto,
                    //distritos:seldistritos
                },
                function (data) 
                {
                    var res = data[0].res;
                    var msn = data[0].msn;
                    if (res == "ok") 
                    {
                        $('#myModal').modal('hide');
                        ok(msn);
						        }else{
							          error(msn);
					        	}
					      }, "json");
            }
            //}
        }
    }
    else if(o=="FILTROS")
    {
     
        $.post('funciones/usuarios/fnUsuarios.php',{opcion:o,id},function(data){
           $('#filtros').html(data);
        })
    }	
    else if (o=="LISTAUSUARIOS")
	  {
        $.post('funciones/usuarios/fnUsuarios.php', {
        opcion: o,
        id:id
        }, function (data) {
            $('#tabladatos').html(data);
        })
    }
    else if (o=="VALORESACTUAL")
	  {        
        $.post('funciones/usuarios/fnUsuarios.php', {
          opcion: o        
        }, function (data) {
            $('#divvalores').html(data);
        })
    }
    else if (o=="ELIMINAR")
	  {
        
        
        swal({
          title: "Realmente desea eliminar el "+tex+" seleccionado",
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar!',
          cancelButtonText: 'No eliminar!'
        }).then(function (result) {
          if (result.value) {

            $.post('funciones/usuarios/fnUsuarios.php', {
              opcion:o,
              id:id,
              tex:tex
            },
            function (data) {
              var res = data[0].res;
              var msn = data[0].msn;
                  if (res == "ok") {
                      ok(msn);
                      var table = $('#tbusuarios').DataTable();
                      table.row('#row_' + id).remove().draw(false);
                      if(ti==1)
                      {
                        setTimeout(CRUDUSUARIOS('VALORESACTUAL',''),1000);
                      }
                  } else {
                      error(msn);
                  }
            }, "json");
          }
        });
    }
    else if(o=="ASIGNARPERMISOS")
    {
        //$('#btnguardar').attr('onclick',"CRUDUSUARIOS('GUARDAREDICION','"+id+"','')").show();
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Permisos Usuario");
        $('#contentmodal').html('');
        $('#myModal>.modal-dialog').addClass("modal-lg");
        $.post('funciones/usuarios/fnUsuarios.php',{opcion:o,id:id},
        function(data)
        {
          $('#contentmodal').html(data);
          $('#overlaymodal').css('display','none !important');
        })
    }
    else if(o=="LISTAPERMISOS")
    {
      $.post('funciones/usuarios/fnUsuarios.php',{opcion:o,id:id,ven:idu},
      function(data)
      {
        $('#ventana-' + idu).html(data);
      })
    }
    else if(o=="GUARDARPERMISOS")
    {
	
      $.post('funciones/usuarios/fnUsuarios.php',{opcion:o,idp:id,idu:idu},
      function(data)
      {
        var res = data[0].res;
        var msn = data[0].msn;
        if(res=="ok")
        {
          ok("");
        }
        else
        {
          error(msn);
        }
      },"json")
    }
    else
    if(o=="REGLANEGOCIO")
    {
        
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("REGLAS DE NEGOCIO");
        $('#btnguardar').attr('onclick',"CRUDUSUARIOS('GUARDARREGLA','"+id+"')");
        $('#btnguardar').html("Guardar Cambios");
        $.post('funciones/usuarios/fnUsuarios.php',{
            opcion: o,
            id: id
        },function(data){
            $('#contentmodal').html(data);
            $('#overlaymodal').css('display','none !important');
        })
    }
    else if(o=="GUARDARREGLA")
    {
       var desc = $('#txtdescuento').val();
       var aplidesc = $('input:radio[name=raddescuento]:checked').val();
       var rete = $('#txtretefuente').val();
       var aplirete = $('input:radio[name=radretefuente]:checked').val();
       var iva = $('#txtiva').val();
       var apliiva = $('input:radio[name=radiva]:checked').val();
       $.post('funciones/usuarios/fnUsuarios.php',{
        opcion: o,
        id: id,
        desc:desc,
        aplidesc:aplidesc,
        rete:rete,
        aplirete:aplirete,
        iva:iva,
        apliiva:apliiva
      },function(data){
          var res = data[0].res;
          var msn = data[0].msn;
          
          if(res=="ok")
          {
            ok(msn);
          }
          else{
            error(msn);
          }
      },"json")
    }
    else
    if(opt=="MIINFORMACION"){
      $.post('funciones/perfil/fnPerfil.php', {
        opcion: opt
      }, function (data) {
        $('#miperfil').html(data);
      })
    }else if (opt == "AGUARDAREDIPER"){
      {
        var ruta = $('#rutausuario').text();
        var txtnombre = $('#txtnombre1').val();
        var txtapellido = $('#txtapellido1').val();
        var celular = $('#txtcelular1').val();
        var fijo = $('#txtfijo1').val();
        var txtemail = $('#txtcorreo1').val();
        var direccion = $('#txtdireccion1').val();
        var txtpass = $('#txtclave1').val();
        var txtpass1 = $('#txtclave22').val();
        if(txtpass == txtpass1){
          $.post('funciones/perfil/fnPerfil.php', {
            opcion:opt,
            ruta:ruta,
            id:id,
            nombre:txtnombre,
            apellido:txtapellido,
            celular:celular,
            fijo:fijo,
            email:txtemail,
            direccion:direccion,
            pass1:txtpass1
          },
          function (data) 
          {
            var res = data[0].res;
            if (res == "error_sesion") 
            {
    
            } 
            else if (res == "error") 
            {
              var msn = data[0].msn;
              error(msn);
            } 
            var msn = data[0].msn;
            ok(msn);
          }, "json");
        }else {
          error("Contraseña no coincide");
        }
      }
    }
}
function CRUDCOMITES(o,id,idu)
{
 
  if(o=="NUEVO")
  {     
    //$('#myModal>.modal-dialog').addClass('modal-lg');
    //$('#overlaymodal').css('display','block !important');
    //$('#titlemodal').html("Nuevo Comité");
  $('#btnguardar2').attr('onclick',"CRUDCOMITES('GUARDAR','"+id+"')");
    //$('#guardarobjetivos').attr('onclick',"CRUDCOMITES('GUARDAROBJETIVOS','"+id+"')");
  $('#btnguardar2').html("GUARDAR ")
  $('#btnguardar3').attr('onclick',"CRUDCOMITES('TERMINAR','"+id+"')");
    //$('#guardarobjetivos').attr('onclick',"CRUDCOMITES('GUARDAROBJETIVOS','"+id+"')");
  $('#btnguardar3').html("TERMINAR COMITE ")
    $.post('funciones/comites/fnComites.php',{
        opcion: o,
        id: id
    },function(data){
        $('#tabladatos1').html(data);
        //$('#overlaymodal').css('display','none !important');
    })
  }
 else if(o=="EDITAR"){
      //$('#overlaymodal').css('display','block !important');
      //$('#titlemodal').html("Edición comite");
      //$('#btnguardar').attr('onclick',"CRUDCOMITES('GUARDAREDICION','"+id+"')");
      //$('#btnguardar').html("Guardar Cambios");
      $('#btnguardar2').attr('onclick',"CRUDCOMITES('GUARDAREDICION','"+id+"')");
      //$('#guardarobjetivos').attr('onclick',"CRUDCOMITES('GUARDAROBJETIVOS','"+id+"')");
      $('#btnguardar2').html("GUARDAR CAMBIOS")
      $('#btnguardar3').attr('onclick',"CRUDCOMITES('TERMINAR','"+id+"')");
      //$('#guardarobjetivos').attr('onclick',"CRUDCOMITES('GUARDAROBJETIVOS','"+id+"')");
      $('#btnguardar3').html("TERMINAR COMITE ")
      $.post('funciones/comites/fnComites.php',{
          opcion: o,
          id: id
      },function(data){
          $('#tabladatos1').html(data);
          //$('#overlaymodal').css('display','none !important');
      })
  }else if (o=="VALORESACTUAL")
  { 
      $.post('funciones/comites/fnComites.php', {
        opcion: o
      
      }, function (data) {
        $('#divvalores').html(data);
      })
  }
  else if (o=="ELIMINAR")
  {
      swal({
        title: "Realmente desea eliminar el comite seleccionado",
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'No eliminar!'
      }).then(function (result) {
        if (result.value) {

          $.post('funciones/comites/fnComites.php', {
            opcion:o,
            id:id
          },
          function (data) {
            var res = data[0].res;
            var msn = data[0].msn;
                if (res == "ok") {
                    ok(msn);
                    var table = $('#tbcomite').DataTable();
                    table.row('#row_' + id).remove().draw(false);
                    setTimeout(CRUDCOMITES('VALORESACTUAL',''),1000);
                } else {
                    error(msn);
                }
          }, "json");
        }
      });

  }
  else if (o=="ELIMINAROBJETIVOS")
  {
      swal({
        title: "Realmente desea eliminar el comite seleccionado",
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'No eliminar!'
      }).then(function (result) {
        if (result.value) {

          $.post('funciones/comites/fnComites.php', {
            opcion:o,
            id:id
          },
          function (data) {
            var res = data[0].res;
            var msn = data[0].msn;
                if (res == "ok") {
                    ok(msn);
                    var table = $('#tbobjetivo').DataTable();
                    table.row('#row_' + id).remove().draw(false);
                    setTimeout(CRUDCOMITES('VALORESACTUAL',''),1000);
                } else {
                    error(msn);
                }
          }, "json");
        }
      });

  }
  else if(o=="CARGARUSUARIOS")
{
 
  var pro = $('#asistente');
  pro.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
  $.post('funciones/comites/fnComites.php',{opcion:o},
  function(data)
  {
    pro.append('<option value="">--seleccione--</option>');
    pro.empty();
    var res = data[0].res;
    if(res=="no")
    {   
      pro.selectpicker('refresh');
    }
    else
    {   
      for (var i=0; i<data.length; i++) 
      {
        pro.append('<option  value="' + data[i].id + '" data-subtext="' + data[i].ema + '">' + data[i].usunombre +'-'+ data[i].prperfil+ '</option>');
      }
      setTimeout(function(){
        pro.selectpicker('refresh');
       },1000);
    }
    

    
  
  
  },"json");
  }
  else if(o=="MODIFICARESTADO")
  {
  console.log("Prueba");
  var estp = $('#ckestado_' + id+':checked').val();
  if(estp=="" || estp==null || estp==undefined){ estp = 0;}
  $.post('funciones/comites/fnComites.php', {opcion: o,idp:id,estp:estp}, function(data, textStatus, xhr) {
    /*optional stuff to do after success */
    var res = data[0].res;
    var msn = data[0].msn;
    if(res=="ok")
    {
      ok(msn);
    }
    else
    {
      error(msn);
    }
    
  },"json");
  }
  else if(o=="EDITARCOSTO" || o=="EDITARCOSTOTMP")
  {
  var pre = $('#pre_'+id+'_'+ idm ).val();
  pre = pre.replace("$", "").replace(",", "");
  pre = pre.replace(",", "").replace(",", "");
  pre = pre.replace(",", "").replace(",", "");
  $.post('funciones/comites/fnComites.php',{opcion:o,idp:id,idm:idm,pre:pre,idd:idd},function(data){
    var res =  data[0].res;
    var msn = data[0].msn;
    var nump = data[0].nump;
    
    if(res=="ok")
    {
        if(nump>0)
        {
          $('#btnsaveprecios').prop('disabled',false);
          $('#btncancelprecios').prop('disabled',false);
          $('#msnguia1').html("Tiene modificaciones de precios pendientes por guardar");
        }
        else{
          $('#btnsaveprecios').prop('disabled',true);
          $('#btncancelprecios').prop('disabled',true);
          $('#msnguia1').html("");
        }
    }
    else
    {
      error(msn);
    }
  },"json");
  }
  else if(o=="GUARDAR" ||  o=="GUARDAREDICION")
  {
    $('#frmcomite').parsley().validate();
    if ($('#frmcomite').parsley().isValid())
    {
      var txtnombcomite = $('#txtnombcomite').val();
      var fechacom = $('#fechacom').val();
      var horainicio = $('#horainicio').val();
      var horafin = $('#horafin').val();
      var txttema = $('#txttema').val().replace(new RegExp("\n","g"), "<br>");;
      var txtlugar = $('#txtlugar').val();
      var asistentes =$('#asistente').val();
      
      var est = $('input:radio[name=radestados]:checked').val();
      //var und = $('input:radio[name=radunidad]:checked').val();
      
      if(txtnombcomite=="")
      {
        error("Diligenciar el nombre del comite. Verificar");
        $('#txtasunto').focus();
      }
      
      else
      {
        $.post('funciones/comites/fnComites.php',{

            opcion:o,
            id:id,                   
            txtnombcomite: txtnombcomite,
            fechacom: fechacom,                   
            horainicio: horainicio,
            horafin: horafin,
            txttema:txttema,
            txtlugar:txtlugar,
            asistentes:asistentes,
            est:est,
        },
          function(data){
          var res = data[0].res; 
           var msn = data[0].msn;
          var idcomite= data[0].id;
          if(res=="ok")
          {
            $('#btnguardar2').attr('onclick',"CRUDCOMITES('GUARDAREDICION','"+idcomite+"')");
            //$('#guardarobjetivos').attr('onclick',"CRUDCOMITES('GUARDAROBJETIVOS','"+id+"')");
            $('#btnguardar2').html("GUARDAR CAMBIOS")
            $('#btnguardar3').attr('onclick',"CRUDCOMITES('TERMINAR','"+idcomite+"')");
           // $('#myModal').modal('hide');
          
            ok(msn);
            //var table = $('#tbcomite').DataTable();
            //table.row('#row_' + id).draw(false);
          }
          else
          {
            error(msn);
          }

        },"json");
      }
    }
  }
  else if(o=="TERMINAR")
  {
    $('#frmcomite').parsley().validate();
    if ($('#frmcomite').parsley().isValid())
    {

      var url = String(window.location); //window.location;
      var indv = url.lastIndexOf("/");
	    var ven = url.substring(indv + 1);
      var txtnombcomite = $('#txtnombcomite').val();
      var fechacom = $('#fechacom').val();
      var horainicio = $('#horainicio').val();
      var horafin = $('#horafin').val();
      var txttema = $('#txttema').val().replace(new RegExp("\n","g"), "<br>");;
      var txtlugar = $('#txtlugar').val();
      var asistentes =$('#asistente').val();
      
      var est = $('input:radio[name=radestados]:checked').val();
      //var und = $('input:radio[name=radunidad]:checked').val();     
      swal({
        title: "Esta seguro de terminar el comite?",
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Guardar!',
        cancelButtonText: 'No Guardar!'
      }).then(function (result) {
        if (result.value) {
          $.post('funciones/comites/fnComites.php',{

            opcion:o,
            id:id,                   
            txtnombcomite: txtnombcomite,
            fechacom: fechacom,                   
            horainicio: horainicio,
            horafin: horafin,
            txttema:txttema,
            txtlugar:txtlugar,
            asistentes:asistentes,
            est:est,
        },
          function(data){
          var res = data[0].res;
          if(res=="ok")
          {
            //$('#myModal').modal('hide');
            var msn = data[0].msn;
            ok(msn);
            if(ven=="Comites"){	
							var table = $('#tabladatos1').DataTable();
							table.draw('full-hold');
			
							setTimeout(CRUDCOMITES('LISTACOMITES'),1000);
						}
          
          }
          else
          {
            var msn = data[0].msn;
            error(msn);
          }

        },"json");
        }
      });       
    }    
  }	
  else if(o=="GUARDAROBJETIVOS" )
  {
    $('#frmobjetivos').parsley().validate();
    if ($('#frmobjetivos').parsley().isValid())
    {
      var txtobjetivos = $('#txtobjetivos').val();
      var id = $('#tbobjetivo').attr('data-comite');
      
        $.post('funciones/comites/fnComites.php',{

            opcion:o,
            id:id,                   
            txtobjetivos: txtobjetivos,
           
        },
          function(data){
          var res = data[0].res;
          var msn = data[0].msn;
          if(res=="ok")
          {
            ok(msn);
            var table = $('#tbobjetivo').DataTable();
            table.draw('full-hold');  
          }
          else
          {
            error(msn);
          }

        },"json");
      
    }
  }	
  else if(o=="FILTROS")
{
  
  $.post('funciones/comites/fnComites.php',{opcion:o,id},function(data){
    $('#filtros').html(data);
  })
  }	
  else if(o=="LISTACOMITES")
{
  $.post('funciones/comites/fnComites.php', {
  opcion: o,
  id:id
  }, function (data) {
      $('#tabladatos1').html(data);
  })
  }
  else if (o=="GUARDARCAMBIOPRECIO")
{
      if(idd=="" || idd==null || idd==undefined)
      {
        error("Debe seleccionar el distrito al cual se le hara modificación de precios")
      }
      else{
        swal({
          title: "Realmente desea modificar los precios especificados",
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, modificar!',
          cancelButtonText: 'No modificar!'
        }).then(function (result) {
          if (result.value) {

            $.post('funciones/comites/fnComites.php', {
              opcion:o,
              id:id,
              idd:idd
            },
            function (data) {
              var res = data[0].res;
              var msn = data[0].msn;
                  if (res == "ok") {
                      ok(msn);                     
                      setTimeout(CRUDCOMITES('LISTACOMITES',''),1000);
                  } else {
                      error(msn);
                  }
            }, "json");
          }
        });
      }
  }
  else if (o=="CANCELARCAMBIOPRECIO")
{
      if(idd=="" || idd==null || idd==undefined)
      {
        error("Debe seleccionar el distrito al cual se le hara cancelacion de modificación de precios")
      }
      else{
        swal({
          title: "Realmente desea cancelar la modificacion de los precios",
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, cancelar!',
          cancelButtonText: 'No cancelar!'
        }).then(function (result) {
          if (result.value) {

            $.post('funciones/comites/fnComites.php', {
              opcion:o,
              id:id,
              idd:idd
            },
            function (data) {
              var res = data[0].res;
              var msn = data[0].msn;
                  if (res == "ok") {
                      ok(msn);                     
                      setTimeout(CRUDCOMITES('LISTACOMITES',''),1000);
                  } else {
                      error(msn);
                  }
            }, "json");
          }
        });
      }
  }
}
function CRUDPRODUCTOS(o,id,idm,idd)
{
 
  $('#myModal>.modal-dialog').removeClass('modal-lg');
    if(o=="NUEVO")
  {
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Nuevo Producto");
        $('#btnguardar').attr('onclick',"CRUDPRODUCTOS('GUARDAR','"+id+"')");
        $('#btnguardar').html("Guardar");
        $.post('funciones/productos/fnProductos.php',{
            opcion: o,
            id: id
        },function(data){
            $('#contentmodal').html(data);
            $('#overlaymodal').css('display','none !important');
        })
    }
    else if(o=="EDITAR")
    {
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Edición Producto");
        $('#btnguardar').attr('onclick',"CRUDPRODUCTOS('GUARDAREDICION','"+id+"')");
        $('#btnguardar').html("Guardar Cambios");
        $.post('funciones/productos/fnProductos.php',{
            opcion: o,
            id: id
        },function(data){
            $('#contentmodal').html(data);
            $('#overlaymodal').css('display','none !important');
        })
    }
    else if (o=="VALORESACTUAL")
	  { 
        $.post('funciones/productos/fnProductos.php', {
          opcion: o
        
        }, function (data) {
          $('#divvalores').html(data);
        })
    }
    else if (o=="ELIMINAR")
	  {
        swal({
          title: "Realmente desea eliminar el producto seleccionado",
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar!',
          cancelButtonText: 'No eliminar!'
        }).then(function (result) {
          if (result.value) {

            $.post('funciones/productos/fnProductos.php', {
              opcion:o,
              id:id
            },
            function (data) {
              var res = data[0].res;
              var msn = data[0].msn;
                  if (res == "ok") {
                      ok(msn);
                      var table = $('#tbproductos').DataTable();
                      table.row('#row_' + id).remove().draw(false);
                      setTimeout(CRUDPRODUCTOS('VALORESACTUAL',''),1000);
                  } else {
                      error(msn);
                  }
            }, "json");
          }
        });

    }
    else if(o=="MODIFICARESTADO")
	{
    console.log("Prueba");
		var estp = $('#ckestado_' + id+':checked').val();
		if(estp=="" || estp==null || estp==undefined){ estp = 0;}
		$.post('funciones/productos/fnProductos.php', {opcion: o,idp:id,estp:estp}, function(data, textStatus, xhr) {
			/*optional stuff to do after success */
			var res = data[0].res;
			var msn = data[0].msn;
			if(res=="ok")
			{
				ok(msn);
			}
			else
			{
				error(msn);
			}
			
		},"json");
    }
	  else if(o=="EDITARCOSTO" || o=="EDITARCOSTOTMP")
	{
		var pre = $('#pre_'+id+'_'+ idm ).val();
		pre = pre.replace("$", "").replace(",", "");
		pre = pre.replace(",", "").replace(",", "");
		pre = pre.replace(",", "").replace(",", "");
		$.post('funciones/productos/fnProductos.php',{opcion:o,idp:id,idm:idm,pre:pre,idd:idd},function(data){
			var res =  data[0].res;
      var msn = data[0].msn;
      var nump = data[0].nump;
      
			if(res=="ok")
			{
         if(nump>0)
         {
            $('#btnsaveprecios').prop('disabled',false);
            $('#btncancelprecios').prop('disabled',false);
            $('#msnguia1').html("Tiene modificaciones de precios pendientes por guardar");
         }
         else{
            $('#btnsaveprecios').prop('disabled',true);
            $('#btncancelprecios').prop('disabled',true);
            $('#msnguia1').html("");
         }
			}
			else
			{
        error(msn);
			}
		},"json");
	  }
	  else if(o=="GUARDAR" ||  o=="GUARDAREDICION")
	{
    $('#frmproductos').parsley().validate();
		if ($('#frmproductos').parsley().isValid())
		{
      var ruta = $('#rutaproducto').text();
      var txtnombre = $('#txtnombre').val();      
      var txtdescripcion = $('#txtdescripcion').val().replace(new RegExp("\n","g"), "<br>");      
      var selcategoria = $('#selcategoria').val();
      var rutaant = $('#rutaproducto').attr('data-url');
      var txtprecio = $('#txtprecio').val();   
      txtprecio = txtprecio.replace("$", "").replace(",", "");
      txtprecio = txtprecio.replace(",", "").replace(",", "");
      txtprecio = txtprecio.replace(",", "").replace(",", "");   
      
      
      var est = $('input:radio[name=radestado]:checked').val();
      //var und = $('input:radio[name=radunidad]:checked').val();

      
     
      if(txtnombre=="")
      {
        error("Diligenciar el nombre del producto. Verificar");
        $('#txtnombre').focus();
      }
      
      else
      {
        $.post('funciones/productos/fnProductos.php',{

            opcion:o,
            id:id,                   
            txtnombre: txtnombre,
            txtdescripcion: txtdescripcion,                   
            txtprecio: txtprecio,
            txtproducto: ruta,
            rutaant:rutaant,
            selcategoria:selcategoria,
            est:est,
        },
          function(data){
          var res = data[0].res;
          if(res=="ok")
          {
            $('#myModal').modal('hide');
            var msn = data[0].msn;
            ok(msn);
            var table = $('#tbproductos').DataTable();
            table.row('#row_' + id).draw(false);
          }
          else
          {
            var msn = data[0].msn;
            error(msn);
          }

        },"json");
      }
    }
    }	
    else if(o=="FILTROS")
  {
    
		$.post('funciones/productos/fnProductos.php',{opcion:o,id},function(data){
			$('#divfiltros').html(data);
		})
    }	
	  else if(o=="LISTAPRODUCTOS")
	{
    $.post('funciones/productos/fnProductos.php', {
    opcion: o,
    id:id
    }, function (data) {
        $('#tabladatos1').html(data);
    })
    }
    else if (o=="GUARDARCAMBIOPRECIO")
	{
        if(idd=="" || idd==null || idd==undefined)
        {
          error("Debe seleccionar el distrito al cual se le hara modificación de precios")
        }
        else{
          swal({
            title: "Realmente desea modificar los precios especificados",
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, modificar!',
            cancelButtonText: 'No modificar!'
          }).then(function (result) {
            if (result.value) {
  
              $.post('funciones/productos/fnProductos.php', {
                opcion:o,
                id:id,
                idd:idd
              },
              function (data) {
                var res = data[0].res;
                var msn = data[0].msn;
                    if (res == "ok") {
                        ok(msn);                     
                        setTimeout(CRUDPRODUCTOS('LISTAPRODUCTOS',''),1000);
                    } else {
                        error(msn);
                    }
              }, "json");
            }
          });
        }
    }
    else if (o=="CANCELARCAMBIOPRECIO")
	{
        if(idd=="" || idd==null || idd==undefined)
        {
          error("Debe seleccionar el distrito al cual se le hara cancelacion de modificación de precios")
        }
        else{
          swal({
            title: "Realmente desea cancelar la modificacion de los precios",
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, cancelar!',
            cancelButtonText: 'No cancelar!'
          }).then(function (result) {
            if (result.value) {
  
              $.post('funciones/productos/fnProductos.php', {
                opcion:o,
                id:id,
                idd:idd
              },
              function (data) {
                var res = data[0].res;
                var msn = data[0].msn;
                    if (res == "ok") {
                        ok(msn);                     
                        setTimeout(CRUDPRODUCTOS('LISTAPRODUCTOS',''),1000);
                    } else {
                        error(msn);
                    }
              }, "json");
            }
          });
        }
    }
}
function CRUDPEDIDOS(o,id,idm,idd)
{ 
    if(o=="NUEVO")
    {
       $('#myModal>.modal-dialog').addClass('modal-lg');
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Nuevo Pedido");
        $('#btnguardar').attr('onclick',"CRUDPEDIDOS('GUARDARPEDIDO','"+id+"')");
        $('#btnguardar').html("Guardar");
        $.post('funciones/pedidos/fnPedidos.php',{
            opcion: o,
            id: id
        },function(data){
            $('#contentmodal').html(data);
            $('#overlaymodal').css('display','none !important');
        })
    } else
    if(o=="IMPRIMIR")
    {
       $('#myModal>.modal-dialog').addClass('modal-lg');
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Informe Pedido");
        $('#btnguardar').attr("");
        $('#btnguardar').html("");
        $.post('funciones/pedidos/fnPedidos.php',{
            opcion: o,
            id: id
        },function(data){
            $('#contentmodal').html(data);
            $('#overlaymodal').css('display','none !important');
        })
    } 
    else if(o== "MODIFICARCANTIDAD")
    {
      var cant= $('#cantidad_'+id).val();
      var idpro = id;
      var pre = $('#cantidad_'+id).attr('data-precio');
      var idpedido = $('#tbproductos').attr('data-pedido');
      
     
      $.post('funciones/pedidos/fnPedidos.php', {
        opcion:o,
        idpro:idpro,
        cant:cant,
        pre:pre,
        idpedido:idpedido
      },
      function (data) {
        var res = data[0].res;
        var msn = data[0].msn;
        var total=  data[0].total;
        var pretot= data[0].pretot;

            if (res == "ok") {
              $('#spantotal').html(total).formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });
              $('#pretotal_'+idpro).html(pretot).formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });
                //ok(msn);
                if (idpedido>0) {
                   var table = $('#tbpedidos').DataTable();
                   table.row('#row_' + id).remove().draw(false);
                } 
               
            } else {
                error(msn);
            }
      }, "json");      
    }  
    else if(o=="GUARDARPEDIDO"  || o=="GUARDAREDICION")
    {
      $('#frmpedidos').parsley().validate();
      if ($('#frmpedidos').parsley().isValid())
      {
      
        var fechaped=$('#fechaped').val();
        var cliente=$('#cliente').val();
                
        
      
        $.post('funciones/pedidos/fnPedidos.php',{

            opcion:o,
            id:id,
            fechaped:fechaped,
            cliente:cliente,
           
        },
          function(data){
          var res = data[0].res;
          if(res=="ok")
          {
            $('#myModal').modal('hide');
            var msn = data[0].msn;
            ok(msn);
            var table = $('#tbpedidos').DataTable();
            table.row('#row_' + id).draw(false);
          }
          else
          {
            var msn = data[0].msn;
            error(msn);
          }

        },"json");
        
      }
    }	
    else if(o=="EDITAR")
    {    
        $('#myModal>.modal-dialog').addClass('modal-lg');
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Edición Pedido");
        $('#btnguardar').attr('onclick',"CRUDPEDIDOS('GUARDAREDICION','"+id+"')");
        $('#btnguardar').html("Guardar Cambios");
        $.post('funciones/pedidos/fnPedidos.php',{
            opcion: o,
            id: id
        },function(data){
            $('#contentmodal').html(data);
            $('#overlaymodal').css('display','none !important');
        })
    }
    else if (o=="VALORESACTUAL")
	  { 
        $.post('funciones/pedidos/fnPedidos.php', {
          opcion: o
        
        }, function (data) {
          $('#divvalores').html(data);
        })
    }
    else if (o=="ELIMINAR")
	  {
        swal({
          title: "Realmente desea eliminar el Comite seleccionado",
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar!',
          cancelButtonText: 'No eliminar!'
        }).then(function (result) {
          if (result.value) {

            $.post('funciones/comites/fnComites.php', {
              opcion:o,
              id:id
            },
            function (data) {
              var res = data[0].res;
              var msn = data[0].msn;
                  if (res == "ok") {
                      ok(msn);
                      var table = $('#tbcomites').DataTable();
                      table.row('#row_' + id).remove().draw(false);
                      setTimeout(CRUDPEDIDOS('VALORESACTUAL',''),1000);
                  } else {
                      error(msn);
                  }
            }, "json");
          }
        });

    }
    else if(o=="MODIFICARESTADO")
    {
      console.log("Prueba");
      var estp = $('#ckestado_' + id+':checked').val();
      if(estp=="" || estp==null || estp==undefined){ estp = 0;}
      $.post('funciones/pedidos/fnPedidos.php', {opcion: o,idp:id,estp:estp}, function(data, textStatus, xhr) {
        /*optional stuff to do after success */
        var res = data[0].res;
        var msn = data[0].msn;
        if(res=="ok")
        {
          ok(msn);
        }
        else
        {
          error(msn);
        }
        
      },"json");
    }
    else if(o=="EDITARCOSTO" || o=="EDITARCOSTOTMP")
    {
      var pre = $('#pre_'+id+'_'+ idm ).val();
      pre = pre.replace("$", "").replace(",", "");
      pre = pre.replace(",", "").replace(",", "");
      pre = pre.replace(",", "").replace(",", "");
      $.post('funciones/pedidos/fnPedidos.php',{opcion:o,idp:id,idm:idm,pre:pre,idd:idd},function(data){
        var res =  data[0].res;
        var msn = data[0].msn;
        var nump = data[0].nump;
        
        if(res=="ok")
        {
          if(nump>0)
          {
              $('#btnsaveprecios').prop('disabled',false);
              $('#btncancelprecios').prop('disabled',false);
              $('#msnguia1').html("Tiene modificaciones de precios pendientes por guardar");
          }
          else{
              $('#btnsaveprecios').prop('disabled',true);
              $('#btncancelprecios').prop('disabled',true);
              $('#msnguia1').html("");
          }
        }
        else
        {
          error(msn);
        }
      },"json");
    }  
    else if(o=="FILTROS")
    {
      
      $.post('funciones/pedidos/fnPedidos.php',{opcion:o,id},function(data){
        $('#divfiltros').html(data);
      })
    }	
    else if(o=="LISTAPEDIDOS")
    {
      $.post('funciones/pedidos/fnPedidos.php', {
      opcion: o,
      id:id
      }, function (data) {
          $('#tabladatos1').html(data);
      })
    }
    else if (o=="GUARDARCAMBIOPRECIO")
	{
        if(idd=="" || idd==null || idd==undefined)
        {
          error("Debe seleccionar el distrito al cual se le hara modificación de precios")
        }
        else{
          swal({
            title: "Realmente desea modificar los precios especificados",
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, modificar!',
            cancelButtonText: 'No modificar!'
          }).then(function (result) {
            if (result.value) {
  
              $.post('funciones/pedidos/fnPedidos.php', {
                opcion:o,
                id:id,
                idd:idd
              },
              function (data) {
                var res = data[0].res;
                var msn = data[0].msn;
                    if (res == "ok") {
                        ok(msn);                     
                        setTimeout(CRUDPEDIDOS('LISTAPEDIDOS',''),1000);
                    } else {
                        error(msn);
                    }
              }, "json");
            }
          });
        }
    }
    else if (o=="CANCELARCAMBIOPRECIO")
	  {
        if(idd=="" || idd==null || idd==undefined)
        {
          error("Debe seleccionar el distrito al cual se le hara cancelacion de modificación de precios")
        }
        else{
          swal({
            title: "Realmente desea cancelar la modificacion de los precios",
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, cancelar!',
            cancelButtonText: 'No cancelar!'
          }).then(function (result) {
            if (result.value) {
  
              $.post('funciones/pedidos/fnPedidos.php', {
                opcion:o,
                id:id,
                idd:idd
              },
              function (data) {
                var res = data[0].res;
                var msn = data[0].msn;
                    if (res == "ok") {
                        ok(msn);                     
                        setTimeout(CRUDPEDIDOS('LISTAPEDIDOS',''),1000);
                    } else {
                        error(msn);
                    }
              }, "json");
            }
          });
        }
    }
}
function CRUDORDEN(o,id,est,idm)
{
  $('#myModal>.modal-dialog').removeClass('modal-lg');
  if(o=="NUEVAORDEN")
  {
    
    var idvisita =  localStorage.getItem('idvisita');
    $('#titlemodulo1').html("Gestion Orden de compra");
    $('#titlemodulo2').html("Nueva");
    $('#titlemodulo3').html("Orden de Compra");
    $('#divhome').addClass('hide');
    $('#divinforme').addClass('hide');
    $('#divnuevaorden').removeClass('hide');
    $.post('funciones/ordenes/fnOrdenes.php',{opcion:o,id:id,idvisita:idvisita},function(data){
			$('#divinforden').html(data);
		})
  }
  else if(o=="CARGARCLIENTES")
  {
    var clisel = $('#frmorden').attr('data-cliente');
    var dis  = $('#seldistrito').val();
    var cli = $('#selcliente');
    cli.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
    $.post('funciones/ordenes/fnOrdenes.php',{opcion:o,idd:dis},
    function(data)
    {
      cli.selectpicker('refresh').empty();
      cli.append('<option value="">--seleccione--</option>');
      var res = data[0].res;
      if(res=="no")
      {
        error("No hay cliente con el distrito seleccionado");
        setTimeout(function(){
          $('#selcliente>option:selected').attr('selected',false);
          cli.selectpicker('refresh').trigger('change');
          //cli.selectpicker('refresh');
        },1000)
        setTimeout(function(){
          CRUDORDEN('CARGARPRODUCTOS')
        },1200)
      }
      else
      {
        $('#selcliente>option:selected').attr('selected',false);
        for (var i=0; i<data.length; i++) 
        {
          var sel = "";
          if(data[i].idcli==clisel){ sel = "selected"; console.log("SE SELECCIONO CLIENTE") }
          cli.append('<option  data-mercado ="'+data[i].mercli+'" value="'+data[i].idcli+'" data-subtext="'+data[i].ema+'-'+data[i].nommer+'" '+sel+'>' + data[i].nom + ' - '+data[i].doc+'</option>');
        }
        setTimeout(function(){
          console.log("ENTRO A ACTUALIZAR SELECT");
          cli.selectpicker('refresh').trigger('change');
          //cli.selectpicker('refresh');
        },1500)
        setTimeout(function(){
          CRUDORDEN('CARGARPRODUCTOS')
        },1800)
      }
     
    
    },"json");
  }
  else if(o=="CARGARPRODUCTOS")
  {
    var discli = $('#seldistrito').val();
    var mercli =  $("#selcliente option:selected").attr('data-mercado');
    var pro = $('#selproducto');
    pro.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
    $.post('funciones/ordenes/fnOrdenes.php',{opcion:o,mercli:mercli,discli:discli},
    function(data)
    {
      pro.empty();
      var res = data[0].res;
      if(res=="no")
      {   
      }
      else
      {   
        for (var i=0; i<data.length; i++) 
        {
          pro.append('<option  value="' + data[i].id + '">' + data[i].literal + '</option>');
        }
      }
      setTimeout(function(){
        pro.selectpicker('refresh');
      },1000);

      setTimeout(function(){
       CRUDORDEN('LISTAPRODUCTOS')
      },1500);
    
    
    },"json");
  }
  else if(o=="LISTAPRODUCTOS")
  {
    var idvisita =  localStorage.getItem('idvisita');
    var idpedido =  localStorage.getItem('idpedido');
    var mercli =  $("#selcliente option:selected").attr('data-mercado');
    var pro = $('#selproducto').val();
    var idcli = $('#selcliente').val();
    var discli = $('#seldistrito').val();
    $.post('funciones/ordenes/fnOrdenes.php',{opcion:o,id:id,mercli:mercli,idcli:idcli,pro:pro,discli:discli,idvisita:idvisita,idpedido:idpedido},function(data){
			$('#divproductos').html(data);
		})
  }
  else
  if(o=="RESUMENPEDIDO")
  {
    var idcli =  $("#selcliente").val();
    var discli = $('#seldistrito').val();
    $('#divresumen').removeClass('hide');
    $.post('funciones/ordenes/fnOrdenes.php',{opcion:o,id:id,idcli:idcli,discli:discli},function(data){
			$('#divresumen').html(data);
		})
  }
  else if(o=="AGREGARPRODUCTO2")
  {
    var idvisita =  localStorage.getItem('idvisita');
    var idpedido =  localStorage.getItem('idpedido');
    var idpro = id;
    var discli = $('#seldistrito').val();
    var input = $('#product_quantity_' + idpro);
    var mercli =  $("#selcliente option:selected").attr('data-mercado');
    var idcli = $('#selcliente').val();
    //var valor = $('#txtvalor').text();
    var iva = input.attr('data-iva');
    var des = input.attr('data-descuento');
    var sav = input.attr('data-save');
    var det = input.attr('data-detalle');//idproducto
    var valor = input.attr('data-valor');

    //valor = valor.replace("$", "");
    //valor = valor.replace(",", "").replace(",", "");
    //valor = valor.replace(",", "").replace(",", "");
    var cant = input.val();
    //var iva = $('#txtiva').text();
    ///var desc = $('#txtdescuento').val();
    var obs = input.attr('data-observacion'); 

    $.post('funciones/ordenes/fnOrdenes.php',{opcion:"AGREGARPRODUCTO",idpro:idpro,mercli:mercli,idcli:idcli,valor:valor,cant:cant,iva:iva,desc:des,obs:obs,discli:discli,idpedido:idpedido,idvisita:idvisita},function(data){
      var res = data[0].res;
      var msn = data[0].msn;
      var tot = data[0].total;
      var subtotal = data[0].subtotal;
      var descuento = data[0].descuento;
      var retefuente = data[0].retefuente;
      var iva = data[0].iva;
      var desclinea = data[0].desclinea;
      var ivalinea = data[0].ivalinea;
      if(res=="ok")
      {
        ok("");
        $('#spantotal').html(tot);
        $('#spantotalf').html(tot)
        $('#spansubtotal').html(subtotal);
        $('#spandescuento').html(descuento);
        $('#spaniva').html(iva);
        $('#spanretefuente').html(retefuente);
        if(desclinea>0)
        {
          $('#spandesc_' + idpro).removeClass('hide');
          $('#smalldesc_' + idpro).html(desclinea);
        }
        else{
          $('#spandesc_' + idpro).addClass('hide');
        }
        if(ivalinea>0)
        {
          $('#spaniva_' + idpro).removeClass('hide');
          $('#smalliva_' + idpro).html(ivalinea);
        }
        else{
          $('#spaniva_' + idpro).addClass('hide');
        }


        $('.currency').formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });
         
      }
      else{
        error(msn);
      }

    },"json");
  }
  else if(o=="AGREGARPRODUCTO")
  {
    $('#frmagregarproducto').parsley().validate();
		if ($('#frmagregarproducto').parsley().isValid())
		{
      var idvisita =  localStorage.getItem('idvisita');
      var idpedido =  localStorage.getItem('idpedido');
      var idpro = id;
      var discli = $('#seldistrito').val();
      var mercli =  $("#selcliente option:selected").attr('data-mercado');
      var idcli = $('#selcliente').val();
      var valor = $('#txtvalor').text();
      valor = valor.replace("$", "");
			valor = valor.replace(",", "").replace(",", "");
			valor = valor.replace(",", "").replace(",", "");
      var cant = $('#txtcantidad').val();
      var iva = $('#txtiva').text();
      var desc = $('#txtdescuento').val();
      var obs = $('#txtobservacion').val().replace(new RegExp("\n", "g"), "<br>");
      $.post('funciones/ordenes/fnOrdenes.php',{opcion:o,idpro:idpro,mercli:mercli,idcli:idcli,valor:valor,cant:cant,iva:iva,desc:desc,obs:obs,discli:discli,idpedido:idpedido,idvisita:idvisita},function(data){
        var res = data[0].res;
        var msn = data[0].msn;
        var tot = data[0].total;
        var subtotal = data[0].subtotal;
        var descuento = data[0].descuento;
        var subtotal = data[0].subtotal;
        var retefuente = data[0].retefuente;
        var iva = data[0].iva;
        if(res=="ok")
        {
          //$('#spantotal').html(tot)
          //$('#spansubtotal').html(tot);
          $('#spantotal').html(tot)
          $('#spantotalf').html(tot)
          $('#spansubtotal').html(subtotal);
          $('#spandescuento').html(descuento);
          $('#spaniva').html(iva);
          $('#spanretefuente').html(retefuente);
          $('.currency').formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });
          $('#myModal').modal('hide');
          ok(msn);
          setTimeout(function(){
            localStora('idvisita','');
            localStora('idpedido','');
          },1000);
          setTimeout(function(){
            CRUDORDEN('LISTAPRODUCTOS')
           },1500);
        }
        else{
          error(msn);
        }

      },"json");
    }
  }
  else if(o=="VERNOVEDAD")
  {
        var idvisita =  localStorage.getItem('idvisita');
        var idpedido =  localStorage.getItem('idpedido');
        var idpro = id;
        var mercli =  $("#selcliente option:selected").attr('data-mercado');
        var discli = $('#seldistrito').val();
        var idcli = $('#selcliente').val();
        var input = $('#product_quantity_' + idpro);
        var mercli =  $("#selcliente option:selected").attr('data-mercado');
        var idcli = $('#selcliente').val();
        //var valor = $('#txtvalor').text();
        var iva = input.attr('data-iva');
        var des = input.attr('data-descuento');
        var sav = input.attr('data-save');
        var det = input.attr('data-detalle');//idproducto
        var valor = input.attr('data-valor');
        var nom = input.attr('data-producto');
        var cod = input.attr('data-codigo');

        $('#overlaymodal').css('display','block !important');
        $('#myModal').modal('show');
        $('#titlemodal').html( nom + " - " + cod);
        $('#btnguardar').attr('onclick',"CRUDORDEN('AGREGARPRODUCTO','"+idpro+"')");
        $('#btnguardar').html("Agregar Producto");
        $.post('funciones/ordenes/fnOrdenes.php',{
            opcion: "VERAGREGARPRODUCTO",
            idpro: idpro,
            mercli:mercli,
            idcli:idcli,
            discli:discli,
            iva:iva,
            valor:valor,
            idvisita:idvisita,
            idpedido:idpedido
        },function(data){
            $('#contentmodal').html(data);
            $('#overlaymodal').css('display','none !important');
        })
  }
  else if(o=="CANCELARORDEN")
	{
    var idvisita =  localStorage.getItem('idvisita');
    var idpedido =  localStorage.getItem('idpedido');
    var idcli = $('#selcliente').val();
    var discli = $('#seldistrito').val();
		swal({
				title: 'Estas seguro de cancelar la orden de compra actual ?',
				text: "¡No podrás revertir esto!!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si, cancelar!',
				cancelButtonText: 'No, cancelar!'
			}).then(function (result) {
				if (result.value) {
					$.post('funciones/ordenes/fnOrdenes.php', { 
            opcion: o ,
            idcli:idcli,
            discli:discli,
            idvisita:idvisita,
            idpedido:idpedido
          }, function (dato) {
						var res = dato[0].res;
						var msn = dato[0].msn;
						var idpedido = dato[0].idpedido;
						if (res == "ok") {
              ok(msn);
              setTimeout(function(){
                localStora('idvisita','');
                localStora('idpedido','');
              },100);
              setTimeout(function(){
                CRUDORDEN('NUEVAORDEN')
               },1000);

               setTimeout(CRUDORDEN('CONTADORORDENES', ''), 1500);
            } 
            else
            {
							error(msn);
						}
					}, "json");
				}
			});
  }
  else if(o=="CANCELARPEDIDO")
	{

    var mot = $('#selmotivo').val();
    if(mot=="")
    {
      error("Seleccionar el motivo de cancelacion de la orden de compra");
    }
    else
    {
		swal({
				title: 'Estas seguro de cancelar la orden de compra actual ?',
				text: "¡No podrás revertir esto!!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si, cancelar!',
				cancelButtonText: 'No cancelar!'
			}).then(function (result) {
				if (result.value) {
					$.post('funciones/ordenes/fnOrdenes.php', { opcion: o ,idpedido:id,mot:mot}, function (dato) {
						var res = dato[0].res;
						var msn = dato[0].msn;
						var idpedido = dato[0].idpedido;
						if (res == "ok") {
              ok(msn);
              var table = $('#tbordenes').DataTable();
							table.row('#rowp_' + id).draw(false);
              setTimeout(function(){
                CRUDORDEN('LISTAPRODUCTOS')
               },1000);
              setTimeout(CRUDORDEN('CONTADORORDENES', ''), 1500);
            } 
            else
            {
							error(msn);
						}
					}, "json");
				}
      });
    }
  }
  else if(o=="EMITIRORDEN")// || o=="HACERPEDIDO2")
	{
    var idvisita =  localStorage.getItem('idvisita');
    var idpedido =  localStorage.getItem('idpedido');
    var idcli = $('#selcliente').val();
    var discli = $('#seldistrito').val();
    $('#frmorden').parsley().validate();
		if ($('#frmorden').parsley().isValid())
		{
		  //var lista  = $('input:checkbox[name="cklista"]:checked').val();
      //if(lista=="" || lista==undefined || lista==null){lista=0;}
      var dirpedido  = localStorage.getItem('dirpedido');
      var latpedido  = localStorage.getItem('latpedido');
      var lngpedido  = localStorage.getItem('lngpedido');

      var descuento = $('#divtotales').attr('data-descuento');
      var retefuente = $('#divtotales').attr('data-retefuente');
      var iva = $('#divtotales').attr('data-iva');

      var notapedido = $('#txtobservaciones').val();// localStorage.getItem('notapedido');
      var fecped = $('#txtfechapedido').val();
      var fecent = $('#txtfechaentrega').val();// localStorage.getItem('fechaentrega');
      var horent = $('#txthora').val();// localStorage.getItem('horaentrega');
      var forma = $('input:radio[name="radforma"]:checked').val();
      if(forma=="" ||forma==null || forma==undefined){ forma = 1; }

      if(notapedido=="" || notapedido==null || notapedido==undefined)
      {
        notapedido = "";
      }
      else
      {
        notapedido = notapedido.replace(new RegExp("\n","g"), "<br>");
      }


    /*	var nombrelista = "";
      if($('#txtnombrelista').length>0)
      {
        nombrelista = $('#txtnombrelista').val();
      }

      if(lista==1 && (nombrelista=="" || nombrelista==null) && o=="HACERPEDIDO")
      {
        error2("Ingresar el nombre de la lista que deseas guardar");
      }*/
      if(fecped=="" || fecped==null || fecped==undefined || fecped=="0000-00-00")
      {
        error2("Seleccionar la fecha de la orden de compra");
      }
      else if(fecent=="" || fecent==null || fecent==undefined || fecent=="0000-00-00")
      {
        error2("Seleccionar la fecha en la que se entregara la orden");
      }
      else if(horent=="" || horent==null || horent==undefined || horent=="00:00")
      {
        error2("Seleccionar la hora en la que se entregara la orden");
      }
      else
      {			
        var datos = new FormData();
        datos.append("idpedido",   idpedido);
        datos.append("idvisita",   idvisita);
        datos.append("notapedido",   notapedido);
        datos.append('fechapedido',  fecped);
        datos.append('fechaentrega', fecent);
        datos.append('horaentrega',  horent);
        datos.append('formapago',  forma);
        datos.append('idcli',  idcli);
        datos.append('discli',discli)
        datos.append('dirpedido',  dirpedido);
        datos.append('latpedido',  latpedido);
        datos.append('lngpedido',  lngpedido);
        datos.append('iva',  iva);
        datos.append('descuento',  descuento);
        datos.append('retefuente',  retefuente);


			  //$('#btnenviar').button('loading');
			  jQuery.ajax({
	        url: "modulos/ordenes/enviarorden.php",//+"&lista="+lista+"&nombrelista="+nombrelista,
	        type: "POST",
	       	data: datos,     
	        async:false,       
	        contentType: false,
	        cache: false,
	        processData:false,
	        dataType:"json",
	        crossDomain : true,
	      }).                               
	      done( function(data)
	      {
	        	console.log(data[0].res);
	        	var res = data[0].res;
	        	var msn = data[0].msn;
	        	var idpedido = data[0].idpedido;
	        	  
	          if(res=="ok")
	          {
					    ok2(msn);
					
              localStorage.removeItem('idvisita');
              localStorage.removeItem('idpedido');
              //localStorage.removeItem('horaentrega');
              $('#divinforme').removeClass('hide');
              $('#divhome').removeClass('hide');
              $('#divnuevaorden').addClass('hide');
              setTimeout(CRUDORDEN('CONTADORORDENES', ''), 1000);			
              setTimeout(CRUDINFORMES('GRAFICO'), 1200);			
              //setTimeout(CRUDORDEN('LISTAPRODUCTOS',''),1000);
					    //abri una ventana de soporte del pedido en ped
					    num = 1;
	          } 
	          else
	          {
	            	if(res=="error2")
	            	{
	            		error2(msn);
	            	}
	            	else
	            	{
                  error(msn);
					      }
					      num = 1;
				    }              
	        })
	       .fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
			         console.log( "La solicitud a fallado: " +  textStatus);
	                 result = true;
			     }
			  });
       }
    }
  }
  else
  if(o=="VERORDENES")
  {
    $('#divinforme').addClass('hide');
    if(est!="" && est!=undefined){
      localStora('estorden',est)
    } 
    else{
      est = localStorage.getItem('estorden');
    } 
    $('#titlemodulo1').html("Lista Ordenes de compra");
    $('#titlemodulo2').html(idm);
    $('#titlemodulo3').html("Orden de Compra");
    $('#divhome').addClass('hide');
    $('#divnuevaorden').removeClass('hide');
    $.post('funciones/ordenes/fnOrdenes.php',{opcion:o,id:id},function(data){
			$('#divinforden').html(data);
		})
  }
  else if(o=="LISTAORDENES")
  {
    if(est!="" && est!=undefined){
      localStora('estorden',est)
    } 
    else{
      est = localStorage.getItem('estorden');
    } 
    $.post('funciones/ordenes/fnOrdenes.php',{
      opcion:o,
      est:est
    },function(data){
      $('#divlistaordenes').html(data);
    })
  }
  else if(o=="VERIFICARORDEN")
	{
    $('#overlaymodal').css('display','block !important');
		$('#titlemodal').html("Aprobación de Orden de Compra");	
		$('#btnguardar').show();
		$('#btnguardar').attr('onclick',"CRUDORDEN('DESPACHARORDEN','"+id+"','')").html("Aprobar Orden").attr('disabled', true);
    $('#myModal').modal('show');
    $('#myModal>.modal-dialog').addClass("modal-lg");
		var fecd = localStorage.getItem('fechadespacho' + id);
		if(fecd=="" || fecd==null || fecd==undefined)
		{
			fecd = "";
		}
		var hord = localStorage.getItem('horadespacho' + id);
		if(hord=="" || hord==null || hord==undefined)
		{
			hord = "";
		}
		
		$.post('funciones/ordenes/fnOrdenes.php', {opcion: o,idpedido:id,fecd:fecd,hord:hord}, function(data, textStatus, xhr) {
			/*optional stuff to do after success */
      $('#contentmodal').html(data);
      $('#overlaymodal').css('display','none !important');
		});
  }
  else if(o=="VERDETALLE")
	{
    $('#overlaymodal').css('display','block !important');
		$('#titlemodal').html("Detalle de Orden de Compra");	
		$('#btnguardar').hide();
		$('#btnguardar').attr('onclick',"").html("").attr('disabled', true);
    $('#myModal').modal('show');
    $('#myModal>.modal-dialog').addClass("modal-lg");
	
		$.post('funciones/ordenes/fnOrdenes.php', {opcion: o,idpedido:id}, function(data, textStatus, xhr) {
			/*optional stuff to do after success */
      $('#contentmodal').html(data);
      $('#overlaymodal').css('display','none !important');
		});
	}
	else if(o=="GUARDARVERIFICACION")
	{
		var conf =  $("input:radio[name='conf_"+est+"']:checked").val();

		
		$.post('funciones/ordenes/fnOrdenes.php', {opcion: o,idpedido:id,iddetalle:est,conf:conf}, function(data, textStatus, xhr) {
			/*optional stuff to do after success */
			var res = data[0].res;
			var msn = data[0].msn;
			var confirmados = data[0].confirmados;
			var sinconfirmar = data[0].sinconfirmar;
			var total = data[0].total;
      var subtotal = data[0].subtotal;
      var iva = data[0].iva;
      var descuento = data[0].descuento;
      var retefuente = data[0].retefuente;
			if(res=="ok")
			{
				$('#spanconfirmados').html(confirmados);
				$('#spansinconfirmar').html(sinconfirmar);
				$('#tdtotal').html(total);
        $('#tdsubtotal').html(subtotal);
        $('#tdretefuente').html(retefuente);
        $('#tdiva').html(iva);
        $('#tddescuento').html(descuento);
  
        var table = $('#tbordenes').DataTable();
        table.row('#rowp_' + id).draw(false);
				
				if(subtotal<=0)
				{
          //$('#btnguardar').attr('onclick',"CRUDORDEN('CANCELARPEDIDO','"+id+"','')").text("Cancelar orden").attr('disabled', false);
          $('#btnguardar').attr('onclick',"CANCELARORDEN('"+id+"')").text("Cancelar orden").attr('disabled', false);
				}
				else
				{
          $('#btnguardar').attr('onclick',"CRUDORDEN('DESPACHARORDEN','"+id+"','')").text("Aprobar orden");
        
					/*if(sinconfirmar<=0 )
					{
						$('#btnguardar').attr('disabled', false);
					}
					else
					{
						$('#btnguardar').attr('disabled', true);
					}*/
				}
				
				setTimeout(INICIALIZARCONTENIDO(),1000);
			}
			else
			{
				error(msn);
			}
		},"json");

	}
	else if(o=="DESPACHARORDEN")
	{
		var porconfirmar = parseInt($.trim($('#spansinconfirmar').text()));

		var fechadespacho = $('#txtfechadespacho').val();
		var horadespacho = $('#txthoradespacho').val();
		/*if(porconfirmar>0)
		{
			error2("Falta "+porconfirmar+" productos por verificar");
		}
		else */if(fechadespacho=="" || fechadespacho==null || fechadespacho=="0000-00-00")
		{
			error2("Seleccionar la fecha en que se entregara el pedido");
		}
		else if(horadespacho=="" || horadespacho==null)
		{
			error2("Seleccionar la hora en que se entregara el pedido");
		}

		else
		{
			//window.open("modulos/pedidos/informes/impfactura.php?clave="+id);
			swal({
				title: 'Desea enviar confirmacion al cliente?',
				text: "",
				type: 'info',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si, enviar!',
				cancelButtonText: 'No, enviar!'
			}).then(function (result) {
				if (result.value) 
				{
					$.post('funciones/ordenes/fnOrdenes.php', { opcion: o, idpedido: id ,conf:"si",fechadespacho:fechadespacho,horadespacho:horadespacho}, function (dato) {
						var res = dato[0].res;
						var msn = dato[0].msn;
						if (res == "ok") {
							$('#myModal').modal('hide');
							var table = $('#tbordenes').DataTable();
							table.row('#rowp_' + id).draw(false);

							ok2(msn);
							setTimeout(function()
							{
								window.open("modulos/informes/impfactura.php?clave="+id);
							},100)
							
							//setTimeout(CRUDPEDIDOS('VERPEDIDOS', '',''), 1000);
						} else {
							error(msn);
						}
					}, "json");
				}
				else
				{
					$.post('funciones/ordenes/fnOrdenes.php', { opcion: o, idpedido: id,conf:"no" ,fechadespacho:fechadespacho,horadespacho:horadespacho}, function (dato) {
						var res = dato[0].res;
						var msn = dato[0].msn;
						if (res == "ok") {
							$('#myModal').modal('hide');
							var table = $('#tbordenes').DataTable();
							table.row('#rowp_' + id).draw(false);
							ok2(msn);
							setTimeout(function()
							{
								window.open("modulos/informes/impfactura.php?clave="+id);
              },100);
              setTimeout(CRUDORDEN('CONTADORORDENES', ''), 1000);							
							//setTimeout(CRUDPEDIDOS('VERPEDIDOS', '',''), 1000);
						} else {
							error(msn);
						}
					}, "json");
				}
			});
		}
	}
	else if(o=="TOMARORDEN")
	{
		swal({
			title: 'Estas seguro de tomar la orden seleccionada seleccionado?',
			text: "¡No podrás revertir esto!!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, tomar entrega!',
			cancelButtonText: 'No, tomar entrega!'
		}).then(function (result) {
			if (result.value) {
				$.post('funciones/ordenes/fnOrdenes.php', { opcion: o, id: id }, function (dato) {
					var res = dato[0].res;
					var msn = dato[0].msn;
					if (res == "ok") {
            ok(msn);
            setTimeout(CRUDORDEN('CONTADORORDENES', ''), 1000);
            //actualizar contador
            //actualizar lista

						//setTimeout(CRUDPEDIDOS('VERPEDIDOS', '',''), 1000);
					} else {
						error(msn);
					}
				}, "json");
			}
		});
	}
	else if(o=="ASIGNARORDEN")
	{
    $('#overlaymodal').css('display','block !important');
    $('#btnguardar').attr('onclick',"CRUDORDEN('GUARDARASIGNACION','"+id+"')");
    $('#btnguardar').html("Guardar Asignación").show().attr('disabled',false);
		$('#titlemodal').html("Asignación Entrega");			
		$('#myModal').modal('show');
		$.post('funciones/ordenes/fnOrdenes.php', {opcion: o,idpedido:id}, function(data, textStatus, xhr) {
			/*optional stuff to do after success */
      $('#contentmodal').html(data);
      $('#overlaymodal').css('display','none !important');
		});
	}
	else if(o=="CERRARORDEN" || o=="CERRARORDEN2")
	{
		swal({
			title: 'Estas seguro de cerrar la orden?',
			text: "!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, cerrar orden!',
			cancelButtonText: 'No cerrar orden!'
		}).then(function (result) {
			if (result.value) {
				$.post('funciones/ordenes/fnOrdenes.php', { opcion: "CERRARORDEN", id: id }, function (dato) {
					var res = dato[0].res;
					var msn = dato[0].msn;
					if (res == "ok") {
						ok(msn);
						//actualizar contador
						var table = $('#tbordenes').DataTable();
            table.row('#rowp_' + id).draw(false);
            setTimeout(CRUDORDEN('CONTADORORDENES', ''), 1000);
						
					} else {
						error(msn);
					}
				}, "json");
			}
		});
	}
	else if(o=="GUARDARASIGNACION")
	{
    //EN ESTE PASO SE IMPRIME LA FACTURA
		var ent = $('#selentrega').val();
		if(ent=="")
		{
			error("Debe seleccionar el comite que hara entrega de la orden de compra");
		}
		else
		{
			swal({
				title: 'Estas seguro de asignar la orden de compra al comite seleccionado?',
				text: "!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si, asignar!',
				cancelButtonText: 'No, asignar!'
			}).then(function (result) {
				if (result.value) {
					$.post('funciones/ordenes/fnOrdenes.php', { opcion: o, id: id, ent: ent }, function (dato) {
						var res = dato[0].res;
						var msn = dato[0].msn;
						if (res == "ok") {
							ok(msn);
							$('#myModal').modal('hide');
							var table = $('#tbordenes').DataTable();
							table.row('#rowp_' + id).remove().draw(false);
							setTimeout(CRUDORDEN('CONTADORORDENES', ''), 1000);
						} else {
							error(msn);
						}
					}, "json");
				}
			});
		}
  }	
  else if(o=="VERLISTAPRODUCTOSAGREGAR")
	{
		var idp = $('#btnagregarproducto').attr('data-pedido');	
		$('#divproductosagregar').html('');
		$.post('funciones/ordenes/fnOrdenes.php', {opcion: o,idmercado:idm,idpedido:idp}, function(data, textStatus, xhr) {
			/*optional stuff to do after success */
			$('#divproductosagregar').html(data);
		});
  }
  else if(o=="CONTADORORDENES"){
    $.post('funciones/ordenes/fnOrdenes.php',{opcion:o},function(data){
      var pendientes  = data[0].pendientes;
      var aprobados   = data[0].aprobados;
      var porentregar = data[0].porentregar;
      var porfacturar = data[0].porfacturar;
      var entregados  = data[0].entregados;
      var cancelados  = data[0].cancelados;
      var total = parseInt(pendientes) + parseInt(aprobados) + parseInt(porentregar) + parseInt(porfacturar) ;
      $('#divpendientes').html(pendientes);
      $('#divaprobados').html(aprobados);
      $('#divporentregar').html(porentregar);
      $('#divporfacturar').html(porfacturar);
      $('#diventregados').html(entregados);
      $('#divcancelados').html(cancelados);
      $('#spanpendientes').html(pendientes);
      $('#spanaprobadas').html(aprobados);
      $('#spanporentregar').html(porentregar);
      $('#spanporfacturar').html(porfacturar);
      $('#spannotificaciones1').html(total);
      $('#spannotificaciones2').html(total);
		},"json");
  }
  else if(o=="ACTUALIZARFACTURA")
  {
    var factura = $('#numfactura_' + id).val();
    $.post('funciones/ordenes/fnOrdenes.php',{
      opcion:o,
      id:id,
      factura:factura
    },function(data){
      var res = data[0].res;
      var msn = data[0].msn;
      if(res=="ok"){}
      else{
        error(msn);
      }
    },"json");
  }
}
async function CANCELARORDEN(idpedido)
{
  var inputOptionsPromise = new Promise(function (resolve) {
      setTimeout(function () {
        $.post('funciones/ordenes/fnOrdenes.php',{
          opcion:"LISTAMOTIVOS"
        },function(data){
          var res = data[0].res;
          if(res=="no")
          {
            error("No hay motivo de cancelacion de orde de compra");
          }
          else
          {
              var options = {};
              $.map(data, function (o) {
                  options[o.id] = o.literal;
              });
              resolve(options)
          }
        },"json")
          
      }, 2000)
  })
   
  const { value: motivo } = await Swal.fire({
    title: 'Seleccionar causal de no compra',
    input: 'select',
    inputOptions: inputOptionsPromise,/* {
      apples: 'Apples',
      bananas: 'Bananas',
      grapes: 'Grapes',
      oranges: 'Oranges'
    },*/
    inputPlaceholder: 'Selecciona causa',
    showCancelButton: true,
    inputValidator: (value) => {
      return new Promise((resolve) => {
        if (value) {
          resolve()
        } else {
          resolve('Debe seleccionar la causa de no compra')
        }
      })
    }
  })
        
    if (motivo) {
      //Swal.fire(`You selected: ${motivo}`)
      $.post('funciones/ordenes/fnOrdenes.php', { opcion: "CANCELARPEDIDO" ,idpedido:idpedido,mot:motivo}, function (dato) {
        var res = dato[0].res;
        var msn = dato[0].msn;
        var idpedido = dato[0].idpedido;
        if (res == "ok") {
          ok(msn);
          $('#myModal').modal('hide');
          var table = $('#tbordenes').DataTable();
          table.row('#rowp_' + id).draw(false);
          setTimeout(function(){
            //CRUDORDEN('LISTAPRODUCTOS')
            },1000);
          setTimeout(CRUDORDEN('CONTADORORDENES', ''), 1000);
        } 
        else
        {
          error(msn);
        }
      }, "json");
    }
    
}
async function CERRARORDEN(idpedido)
{
  var inputOptionsPromise = new Promise(function (resolve) {
      setTimeout(function () {
        $.post('funciones/ordenes/fnOrdenes.php',{
          opcion:"LISTAFACTURAS"
        },function(data){
          var res = data[0].res;
          if(res=="no")
          {
            error("No hay facturas pendientes por entregar");
          }
          else
          {
              var options = {};
              $.map(data, function (o) {
                  options[o.id] = o.literal;
              });
              resolve(options)
          }
        },"json")
          
      }, 2000)
  })
   
  const { value: factura } = await Swal.fire({
    title: 'Seleccionar factura que pertenece a la orden de compra',
    input: 'select',
    inputOptions: inputOptionsPromise,/* {
      apples: 'Apples',
      bananas: 'Bananas',
      grapes: 'Grapes',
      oranges: 'Oranges'
    },*/
    inputPlaceholder: 'Selecciona número de factura',
    showCancelButton: true,
    inputValidator: (value) => {
      return new Promise((resolve) => {
        if (value) {
          resolve()
        } else {
          resolve('Debe seleccionar el número de factura')
        }
      })
    }
  })
        
    if (factura) {
      //Swal.fire(`You selected: ${motivo}`)
      $.post('funciones/ordenes/fnOrdenes.php', { opcion: "CERRARORDEN" ,idpedido:idpedido,numfactura:factura}, function (dato) {
        var res = dato[0].res;
        var msn = dato[0].msn;
        
        if (res == "ok") {
          ok(msn);
          $('#myModal').modal('hide');
          var table = $('#tbordenes').DataTable();
          table.row('#rowp_' + idpedido).draw(false);
          setTimeout(CRUDORDEN('CONTADORORDENES', ''), 1000);
        } 
        else
        {
          error(msn);
        }
      }, "json");
    }
    
}
function CRUDINFORMES(o)
{
  if(o=="GRAFICO")
  {
    $('#divinforme').removeClass('hide');
    $.post('funciones/ordenes/fnOrdenes.php',{opcion:o},function(data){
			$('#divinforme').html(data);
		})
  }
}
function localStora(input, valor) {
	if (typeof (Storage) !== "undefined") {
		// Code for localStorage/sessionStorage.
		// Store
		localStorage.setItem(input, valor);		
	} else {
		error("Sorry! No Web Storage support..")
	}
}
function numberPicker(pik)
{
  //actualizacion de subtotales a iniciar
  $('.' + pik).each(function(index, el) {
  		var picker = $(this);
  		var p = picker.find('button:last-child');
        var m = picker.find('button:first-child');
        var input = picker.find('input');             
        var min = parseInt(input.attr('min'), 10);
        var max = parseInt(input.attr('max'), 10);
        var step = parseInt(input.attr('step'),10);
        var iva = input.attr('data-iva');
        var des = input.attr('data-descuento');
        var sav = input.attr('data-save');
        var det = input.attr('data-detalle');//idproducto
        var precio = input.attr('data-valor');
        var valoact = input.val();
	      var visprecio = $('#pricesmall_' + det);//precio x cantidad 
    	  console.log(precio + " " + input.val() + " " + iva +" "+des);
        var totprecio = (precio * input.val()) + (precio * input.val() * (iva/100)) - (precio * input.val() * (des/100));
        visprecio.html(totprecio);
        visprecio.formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });
       
  });
  //click en plus y en minus
  $('.' +pik).on("click", ".btn-number", function(e){
   
    var picker = $(this).parents('.'+pik);

    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');

    var input = $("#" + fieldName); //$("input[name='"+fieldName+"']");
    var iva = input.attr('data-iva');
    var sav = input.attr('data-save');
    var det = input.attr('data-detalle');//iddeproducto
    var des = input.attr('data-descuento');
    var step = input.attr('step'); if(step<=0 || step==undefined){step=1; console.log("por aca");}
    var precio = input.attr('data-valor');
    var visprecio = $('#pricesmall_' + det);//precio x cantidad 
 

    var currentVal = parseInt(input.val());
    var valoact = 0;
    var valoractual = 0;
    var g = 0;
    if (!isNaN(currentVal)) 
    {
	    if(type == 'minus') 
	    {
	        console.log("minus");
	        if(currentVal > input.attr('min')) 
	        {
	            input.val(currentVal - parseInt(step)).change();
	            valoact = currentVal - parseInt(step);
	            valoactual = currentVal - parseInt(step);
              var totprecio = (precio * input.val()) + (precio * input.val() * (iva/100)) - (precio * input.val() * (des/100));
             
              visprecio.html(totprecio);
              visprecio.formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });
          } 

	        if(parseInt(input.val()) == parseInt(input.attr('min'))) {
	            $(this).attr('disabled', true);
	        }
	        else
	        {
	        	$(this).attr('disabled', false);
	        }

	    } 
	    else if(type == 'plus') 
	    {
	    	  console.log("plus");
	        if(currentVal < input.attr('max')) {
	            input.val(currentVal + parseInt(step)).change();
	            valoact = currentVal + parseInt(step);
              var totprecio = (precio * input.val()) + (precio * input.val() * (iva/100)) - (precio * input.val() * (des/100));
              visprecio.html(totprecio);
              visprecio.formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });
          }
	        if(parseInt(input.val()) == input.attr('max')) {
	            $(this).attr('disabled', true);
	        }
	    }
	  } 
	  else 
  	{
	    input.val(0);
	    //span.html(0);
	  }
		minValue =  parseInt(input.attr('min'));
	  maxValue =  parseInt(input.attr('max'));
	  valueCurrent = parseInt(input.val());
	    //name = $(this).attr('id');
	  var gu = 0;
	  if(valueCurrent >= minValue) {
	    	gu = 1;
	        $(".btn-number[data-type='minus'][data-field='"+fieldName+"']").removeAttr('disabled')
	  } 
    else 
    {
      gu = 0;
      error('Lo sentimos, se alcanzó el valor mínimo');
      input.val(input.data('oldValue'));
      valoact = input.data('oldValue');
      var totprecio = (precio * input.val()) + (precio * input.val() * (iva/100)) - (precio * input.val() * (des/100));
      visprecio.html(totprecio);
      visprecio.formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });
	  }
	    if(valueCurrent <= maxValue) {
	    	gu = 1;
	      $(".btn-number[data-type='plus'][data-field='"+fieldName+"']").removeAttr('disabled')
	    } 
	    else 
	    {
	    	gu = 0;
        error('Lo sentimos, se alcanzó el valor máximo');
        input.val(input.data('oldValue'));
        valoact = input.data('oldValue');
          
        var totprecio = (precio * input.val()) + (precio * input.val() * (iva/100)) - (precio * input.val() * (des/100));
     
        visprecio.html(totprecio);
        visprecio.formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });
	    }

			if(sav==1 && gu==1)
			{
				console.log("por aca 2" + gu);
				var g = input.val();
				//CRUDORDEN('AGREGARPRODUCTO2',det);
			}
	     e = $.event.fix(e);
    	 e.preventDefault();
	});

	$('.input-number').focusin(function(){
	   $(this).data('oldValue', $(this).val());
	});
	$('.input-number').on('change keyup',function() {

    var dun = $(this).attr('data-unidad');
    var sav = $(this).attr('data-save');
    var det = $(this).attr('data-detalle');
    var iva = $(this).attr('data-iva');
    var des = $(this).attr('data-descuento');
    var step = $(this).attr('step'); if(step<=0 || step==undefined){ step=1; console.log("por aca");}
    var precio = $(this).attr('data-valor');
    var visprecio = $('#pricesmall_' + det);//precio x cantidad 

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
	    
    name = $(this).attr('name');
    var gu = 0;
    if(valueCurrent >= minValue) {
      gu = 1;
      $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
      gu  = 0;
      error('Lo sentimos, se alcanzó el valor mínimo');
      $(this).val($(this).data('oldValue'));
    }

    if(valueCurrent <= maxValue) {
      gu = 1;
      $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
      gu  = 0;
      error('Lo sentimos, se alcanzó el valor máximo');
      $(this).val($(this).data('oldValue'));
    }

    var totprecio = (precio * $(this).val()) + (precio * $(this).val() * (iva/100)) - (precio * $(this).val() * (des/100));
    visprecio.html(totprecio);
    visprecio.formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });	
        
	  if(sav==1 && gu==1)
		{
			console.log("por aca" + gu);
			var g = $(this).val();
			CRUDORDEN('AGREGARPRODUCTO2',det);
		}
		else if(gu==1)
		{
        //var totprecio = precio * $(this).val(); 
        /*var totprecio = (precio * $(this).val()) + (precio * $(this).val() * (iva/100)) - (precio * $(this).val() * (des/100));
				visprecio.html(totprecio);
				visprecio.formatCurrency({ symbol: '$', eventOnDecimalsEntered: true, roundToDecimalPlace: 0 });*/	
    }
	});
	$(".input-number").keydown(function (e) {
	    // Allow: backspace, delete, tab, escape, enter and .
	    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
	         // Allow: Ctrl+A
	        (e.keyCode == 65 && e.ctrlKey === true) || 
	         // Allow: home, end, left, right
	        (e.keyCode >= 35 && e.keyCode <= 39)) {
	             // let it happen, don't do anything
	             return;
	    }
	    // Ensure that it is a number and stop the keypress
	    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	        e.preventDefault();
	    }
	});
}

function TOOLTIPS(params) {
  $(document).ready(function() {
    $('.tooltip').tooltipster({

      content: $('<iframe width="640" height="360" src="//www.youtube.com/embed/7RbqDgjeaGk?rel=0" frameborder="0" allowfullscreen></iframe>'),
      animation	     : 'grow',
      fixedWidth	    : 300,
      position	      : 'left',
      theme		         : 'tooltipster-noir',
      interactive   	: true,
    });
  });
}