var app = angular.module('myApp', [
	'ui.router',
	//'ui.bootstrap',
	'oc.lazyLoad'
	//,
	//'angularFileUpload'
	
])

app.config(['$stateProvider', '$urlRouterProvider', '$ocLazyLoadProvider', 'JS_REQUIRES', function($stateProvider, $urlRouterProvider, $ocLazyLoadProvider, jsRequires){
	
	// LAZY MODULES
    $ocLazyLoadProvider.config({
        debug: false,
        events: true,
        modules: jsRequires.modules
    });
	
	$urlRouterProvider.otherwise("/Inicio");
	
	$stateProvider
		.state('Inicio', {
			url: '/Inicio?Idvisita&Idpedido',
            templateUrl: 'modulos/home/home.php',
            controller:function($scope, $stateParams){
                $('#btnguardar2').hide();
                $('#btnguardar3').hide();
                $('#divfooter').html("");
                $('#titlemodulo1').html("Dashboard");
                $('#titlemodulo2').html("Home");
                $('#titlemodulo3').html("<a href='#/Inicio'>Dashboard</a>");
                // if($stateParams.Idvisita>0)
                // // {
                // //     localStora('idvisita',$stateParams.Idvisita);
                // //     localStora('idpedido',$stateParams.Idpedido);
                // //     CRUDORDEN('NUEVAORDEN');
                // }
                $('#btnedit').hide();
                $('#btnnuevo').hide();
                //$("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
                //$("body").PushMenu('toggle');
                if(!$("body").hasClass('sidebar-collapse')){
                    $("body").PushMenu('toggle');
                }
                CRUDHOME('CARGARHOME');
                // setTimeout(function(){
                //     CRUDINFORMES('GRAFICO');
                // },1000);

            }       
        })
        
        .state('Perfiles', {
			url: '/Admin/Perfiles',
			templateUrl: 'modulos/perfiles/perfiles.php',
            controller:function($scope, $stateParams){
                $('#btnnuevo').attr('data-estado');
                $('#btnguardar2').hide();
                $('#btnguardar3').hide();
                $('#divfooter').html("");
                $('#titlemodulo1').html("Gestión Perfiles");
                $('#titlemodulo2').html("Admin");
                $('#titlemodulo3').html("Perfiles");
                $('#btnnuevo').hide()
                $('#btnedit').show();
                $('#btnedit').attr('onclick',"CRUDPERFIL('NUEVO')");
                localStora('idvisita',"");
                //$("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
                if(!$("body").hasClass('sidebar-collapse')){
                    $("body").PushMenu('toggle');
                }
                CRUDPERFIL('FILTROS','LISTAPERFILES');
                
            }          
        })	
       
		.state('Usuarios', {
			url: '/Admin/Usuarios',
			templateUrl: 'modulos/usuarios/usuarios.php',
            controller:function($scope, $stateParams){
                $('#btnguardar2').hide();
                $('#btnguardar3').hide();
                //localStora('lstipousuario',1);
                $('#divfooter').html("");
                $('#titlemodulo1').html("Gestión Usuarios");
                $('#titlemodulo2').html("Admin");
                $('#titlemodulo3').html("Usuarios");
                $('#btnedit').hide();
                $('#btnnuevo').show();
                $('#btnnuevo').attr('onclick',"CRUDUSUARIOS('NUEVO')");
                localStora('idvisita',"");
                //$("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
                if(!$("body").hasClass('sidebar-collapse')){
                    $("body").PushMenu('toggle');
                }
                CRUDUSUARIOS('FILTROS','');               
                setTimeout(function(){
                   // CRUDUSUARIOS('VALORESACTUAL','');
                },500)
            }          
        })	
       
       
        .state('Productos', {
			url: '/Admin/Productos',
			templateUrl: 'modulos/productos/productos.php',
            controller:function($scope, $stateParams){
                $('#btnguardar2').hide();
                $('#btnguardar3').hide();                
                $('#divfooter').html("");
                $('#titlemodulo1').html("Gestión Productos");
                $('#titlemodulo2').html("Admin");
                $('#titlemodulo3').html("Productos");
                $('#btnedit').hide();
                $('#btnnuevo').show();
                $('#btnnuevo').attr('onclick',"CRUDPRODUCTOS('NUEVO')");
                localStora('idvisita',"");
                //$("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
                if(!$("body").hasClass('sidebar-collapse')){
                    $("body").PushMenu('toggle');
                }
                CRUDPRODUCTOS('FILTROS','');
                setTimeout(function(){
                    CRUDPRODUCTOS('VALORESACTUAL','');
                },500)
            }          
        })	
        .state('Categorias', {
			url: '/Admin/categorias',
			templateUrl: 'modulos/categorias/categorias.php',
            controller:function($scope, $stateParams){
                $('#btnguardar2').hide();
                $('#btnguardar3').hide();
                $('#divfooter').html("");
                $('#titlemodulo1').html("Gestión Categorias");
                $('#titlemodulo2').html("Admin");
                $('#titlemodulo3').html("Categorias");
                $('#btnedit').hide();
                $('#btnnuevo').show();
                $('#btnnuevo').attr('onclick',"CRUDCATEGORIA('NUEVO')");
                localStora('idvisita',"");
                //$("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
                if(!$("body").hasClass('sidebar-collapse')){
                    $("body").PushMenu('toggle');
                }
                CRUDCATEGORIA('FILTROS','LISTACATEGORIAS');
                
            }          
        })
        .state('Pedidos', {
			url: '/Admin/Pedidos',
			templateUrl: 'modulos/pedidos/pedidos.php',
            controller:function($scope, $stateParams){ 
                $('#btnguardar2').hide();
                $('#btnguardar3').hide();  
                $('#divfooter').html("");
                $('#titlemodulo1').html("Gestión Pedidos");
                $('#titlemodulo2').html("Admin");
                $('#titlemodulo3').html("Pedidos");
                $('#btnedit').hide();
                $('#btnnuevo').show();
                $('#btnnuevo').attr('onclick',"CRUDPEDIDOS('NUEVO')");
                localStora('idvisita',"");
                //$("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
                if(!$("body").hasClass('sidebar-collapse')){
                    $("body").PushMenu('toggle');
                }
                CRUDPEDIDOS('FILTROS','');
                setTimeout(function(){
                    CRUDPEDIDOS('VALORESACTUAL','');
                },500)
            }          
        })		
        .state('Comites', {
			url: '/Comites',
			templateUrl: 'modulos/comites/comites.php',
            controller:function($scope, $stateParams){   
                //$('#divfooter').html("");
                $('#btnguardar2').hide();
                $('#btnguardar3').hide();
                $('#titlemodulo1').html("Lista Comité");
                $('#titlemodulo2').html("Admin");
                $('#titlemodulo3').html("Comites");
                $('#btnedit').hide();
                $('#btnnuevo').hide();
                $('#btnnuevo').attr('onclick',"CRUDCOMITES('NUEVO')");
                localStora('idvisita',"");
                //$("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
                if(!$("body").hasClass('sidebar-collapse')){
                    $("body").PushMenu('toggle');
                }
                CRUDCOMITES('FILTROS','');
                setTimeout(function(){
                    CRUDCOMITES('VALORESACTUAL','');
                },500)
            }          
        })	
        .state('ComiteNuevo', {
			url: '/ComiteNuevo',
			templateUrl: 'modulos/comites/comites.php',
            controller:function($scope, $stateParams){   
                //$('#divfooter').html("");
                $('#btnguardar2').show();
                $('#btnguardar3').show();
                $('#titlemodulo1').html("<a class='btn btn-success btn-lg' href='#/Comites'>Lista comites</a>");
                $('#titlemodulo2').html("");
                $('#titlemodulo3').html("Nuevo Comité");
                $('#btnedit').hide();
                $('#btnnuevo').hide();
                $('#btnnuevo').attr('onclick',"CRUDCOMITES('NUEVO')");
                localStora('idvisita',"");
                //$("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
                if(!$("body").hasClass('sidebar-collapse')){
                    $("body").PushMenu('toggle');
                }
                CRUDCOMITES('NUEVO','');
               /* setTimeout(function(){
                    CRUDCOMITES('VALORESACTUAL','');
                },500)*/
            }          
        })	
        .state('ComiteEdicion', {
			url: '/EdicionComites?Edit',
			templateUrl: 'modulos/comites/comites.php',
            controller:function($scope, $stateParams){   
                //$('#divfooter').html("");
                $('#btnguardar2').show();
                $('#btnguardar3').show();
                $('#titlemodulo1').html("<a  class='btn btn-success btn-lg' href='#/Comites'>Lista comites</a>");
                $('#titlemodulo2').html("Gestión Comites");
                $('#titlemodulo3').html("");
                $('#btnedit').hide();
                $('#btnnuevo').hide();
                $('#btnnuevo').attr('onclick',"CRUDCOMITES('NUEVO')");
                localStora('idvisita',"");
                //$("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
                if(!$("body").hasClass('sidebar-collapse')){
                    $("body").PushMenu('toggle');
                }
                CRUDCOMITES('EDITAR',$stateParams.Edit);
               /* setTimeout(function(){
                    CRUDCOMITES('VALORESACTUAL','');
                },500)*/
            }          
        })	
        
        
        		
		.state('cambiocontrasena', {
			url: '/InformacionPerfil',
			templateUrl: 'modulos/cambiarcontrasena/cambiocontrasena.php'
		})		
		.state('Festivos', {
			url: '/Festivos',
			templateUrl: 'modulos/festivos/calendario.php'
		})	
        .state('Ajustes', {
            url: '/acount/Ajustes?Op',
            templateUrl: 'modulos/cuenta/ajuste.php',
            controller: function($scope, $stateParams) {
                var $op = $stateParams.Op;
                if($op=="Cue")
                {
                    console.log($op);
                    $('#licuenta').addClass('active');
                    $('#lidireccion').removeClass('active');
                    CRUDCUENTA('AJUSTECUENTA','')
                }
                else //if($op=="Dir")
                {
                    console.log($op);
                    $('#licuenta').removeClass('active');
                    $('#lidireccion').addClass('active');
                    CRUDPEDIDOS('NUEVADIRECCION','');
                }               
            }
        }) 
        ;
		
		// Generates a resolve object previously configured in constant.JS_REQUIRES (config.constant.js)
        function loadSequence() {
            var _args = arguments;
            return {
                deps: ['$ocLazyLoad', '$q',
                    function ($ocLL, $q) {
                        var promise = $q.when(1);
                        for (var i = 0, len = _args.length; i < len; i++) {
                            promise = promiseThen(_args[i]);
                        }
                        return promise;

                        function promiseThen(_arg) {
                            if (typeof _arg == 'function')
                                return promise.then(_arg);
                            else
                                return promise.then(function () {
                                    var nowLoad = requiredData(_arg);
                                    if (!nowLoad)
                                        return $.error('Route resolve: Bad resource name [' + _arg + ']');
                                    return $ocLL.load(nowLoad);
                                });
                        }

                        function requiredData(name) {
                            if (jsRequires.modules)
                                for (var m in jsRequires.modules)
                                    if (jsRequires.modules[m].name && jsRequires.modules[m].name === name)
                                        return jsRequires.modules[m];
                            return jsRequires.scripts && jsRequires.scripts[name];
                        }
                    }]
            };
        }
}]);

app.constant('JS_REQUIRES', {
    //*** Scripts
    scripts: {
        //*** Javascript Plugins
        /*'multiselect': [
        	'dist/js/prettify.js',
        	'dist/css/bootstrap-multiselect.css',
        	'dist/js/bootstrap-multiselect.js',
        	'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'],*/
        /*'multiselect': ['dist/css/checklist/jquery.multiselect.css',
        'dist/css/checklist/jquery.multiselect.filter.css',
        'dist/css/checklist/styleselect.css',
        'dist/css/checklist/prettify.css',
        'dist/css/checklist/jquery-ui.css',
        'http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js',
        'dist/js/checklist/jquery.multiselect.js',
        'dist/js/checklist/jquery.multiselect.filter.js',
        'dist/js/checklist/prettify.js']*/
    }
});

app.controller('TabsDemoCtrl', function ($scope, $window) {
  $scope.tabs = [
    { title:'Dynamic Title 1', content:'Dynamic content 1' },
    { title:'Dynamic Title 2', content:'Dynamic content 2', disabled: true }
  ];
	$scope.alertSector = function(g) {
	
	};
});
/*
 app.controller('AppController', ['$scope', 'FileUploader', function($scope, FileUploader) {
        var uploader = $scope.uploader = new FileUploader({
            url: 'modulos/actividades/upload.php'
        });

        // FILTERS

        uploader.filters.push({
            name: 'customFilter',
            fn: function(item , options) {
                return this.queue.length < 10;
            }
        });

        // CALLBACKS

        uploader.onWhenAddingFileFailed = function(item , filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
			$
        };
        uploader.onAfterAddingFile = function(fileItem) {
            console.info('onAfterAddingFile', fileItem);
			
        };
        uploader.onAfterAddingAll = function(addedFileItems) {
            console.info('onAfterAddingAll', addedFileItems);
			
        };
        uploader.onBeforeUploadItem = function(item) {
            console.info('onBeforeUploadItem', item);
			
        };
        uploader.onProgressItem = function(fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
			
        };
        uploader.onProgressAll = function(progress) {
            console.info('onProgressAll', progress);
			
        };
        uploader.onSuccessItem = function(fileItem, response, status, headers) {
            console.info('onSuccessItem', fileItem,response, status, headers);
			$('#archivo').replaceWith( $('#archivo').val('').clone( true ) );
        };
        uploader.onErrorItem = function(fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
			
        };
        uploader.onCancelItem = function(fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
			$('file').replaceWith( $('file').val('').clone( true ) );
        };
        uploader.onCompleteItem = function(fileItem, response, status, headers) {
            console.info('onCompleteItem', fileItem, response, status, headers);
			$('file').replaceWith( $('file').val('').clone( true ) );
        };
        uploader.onCompleteAll = function() {
            console.info('onCompleteAll');
			$('file').replaceWith( $('file').val('').clone( true ) );
        };

        console.info('uploader', uploader);
    }]);
*/	
	
	
	
	app.controller('ProgressCtrl', function ($scope) {
  
  	$scope.max = 100;

 	 $scope.cargar = function(v) {
    var value = v;// Math.floor(Math.random() * 100 + 1);
    var type;

    if (value < 25) {
      type = 'success';
    } else if (value < 50) {
      type = 'info';
    } else if (value < 75) {
      type = 'warning';
    } else {
      type = 'danger';
    }

    $scope.showWarning = type === 'danger' || type === 'warning';

    $scope.dynamic = value;
    $scope.type = type;
  };
  

});
	
	



