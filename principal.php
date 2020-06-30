<?php
   // Inciio de sesión
     session_start();// activa la variable de sesion
     require_once 'data/conexion.php';
     $id=$_POST['id'];
     error_reporting(0);
     $nombresession = $_COOKIE["nombrePROYECTO1"];
     $imgsession = $_COOKIE['imgPROYECTO1'];
     if($imgsession=="")
     {
       //$imgsession  = "dist/img/default-user.png";
     }
     $nombre = ucwords(strtolower($nombresession));
     $img = $_SESSION["imgksas"];
     $idUsuario = $_COOKIE['idusuarioPROYECTO1'];
     //include 'data/validarpermisos.php';
     $per=$_SESSION["perfilPROYECTO1"];
     if(!isset($_SESSION["idusuarioPROYECTO1"])){
       //header("Location: index.php");
      }
      $id=$_POST['id'];
      include ("data/validarpermisos.php");

      $conperfil = mysqli_query($conectar, "SELECT prf_clave_int FROM tbl_usuarios where usu_clave_int  = '".$idUsuario."'");
      $datperfil = mysqli_fetch_array($conperfil);
      $idperfil  = $datperfil['prf_clave_int'];

      function permisosVentana($idperfil,$idventana)
      {
        global $conectar; 
        $veri = mysqli_query($conectar, "SELECT pev_clave_int FROM tbl_permisos_ventana where prf_clave_int = '".$idperfil."' and ven_clave_int = '".$idventana."'");
        $numv = mysqli_num_rows($veri); if($numv<=0){ $numv = 0; }
        return $numv;
      }
     
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>CONTROL ACTAS Y COMITÉS | Principal</title>

  <script src="dist/cdn/angular.min.js"></script>
  <script src="dist/js/angular-ui-router.js"></script> 
  <script src="dist/js/ocLazyLoad.js"></script>  
  <script src="dist/js/rutas.js?<?php echo time(); ?>"></script>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css?<?php echo time();?>">

  <link rel="stylesheet" type="text/css" href="dist/intro.js-2.9.3/introjs.css?<?php echo time();?>">
  <link href="dist/Parsley.js-2.8.1/src/parsley.css?<?php echo time();?>" rel="stylesheet" type="text/css">
  <link href="dist/dropify-master/dist/css/dropify.css?<?php echo time();?>"rel="stylesheet">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="dist/bootstrap-select-1.13.9/dist/css/bootstrap-select.css?<?php echo time();?>"/>
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">     
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.css">   
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">



  <!-- highcharts -->

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>
  <script src="https://code.highcharts.com/modules/drilldown.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  
  

  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <link href="dist/DataTables-1.10.10/media/css/dataTables.bootstrap.css?<?php echo time(); ?>" rel="stylesheet">
<!-- summernote --> 
  <!-- Latest compiled and minified CSS -->
  
  <link rel="stylesheet" href="plugins/bootstrap3-wysiwyg/dist/bootstrap3-wysihtml5.min.css?<?php echo time();?>">
  <link rel="stylesheet" href="dist/css/plusminus.css?<?php echo time();?>"/>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

  <!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<!--Password strength -->
<link rel="stylesheet" href="dist/password_strength/css/strength.css">
<style>
  .label-danger {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
    background-color: rgb(129, 31, 28);
    color: white;
}
.label-warning {
  display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
    background-color: rgb(145, 90, 12);
    color: white;
}
.label-info {
  display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
    background-color: rgb(25, 102, 124);
    color: white;
}
.label-success {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
    background-color: rgb(45, 104, 45);
    color: white;
}
.label-vasio{
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;

    color: black;
    
}

</style>


</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" ng-app="myApp">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand border-bottom-0 navbar-dark navbar-cyan">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block ">
        
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      
         
      </li>
      <?php if($p6 > 0){?>
      <li class="nav-item dropdown "   >
        <a onclick="CRUDUSUARIOS('NUEVO')" id="btnnuevo" style="display:none; color:white;" class="btn btn-info btn-ml  " data-toggle="modal" data-target="#myModal">
          NUEVO USUARIO
        </a>
      </li>
      <?php }?>
      <?php if($p2 > 0){?>
      <li class="nav-item dropdown "   >
        <a onclick="CRUDPERFIL('NUEVO')" id="btnedit" style="display:none; color:white;" class="btn btn-info btn-ml  <?php //if($p2 <= 0){   echo 'hide';}?>" data-toggle="modal" data-target="#myModal">
          NUEVO PERFIL
        </a>
      </li>
      <?php }?>
   
    </ul>
      
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3 ">
      <div class="input-group input-group-sm">
      <a  ui-sref="ComiteNuevo"  ui-sref-opts="{reload: true}" class="btn btn-success btn-ml <?php if($p10 <= 0){   echo 'hide';}?> ">NUEVO COMITÉ</a>
        <div class="input-group-append hide">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">   
      <!-- Messages Dropdown Menu -->    
    
      <li class="nav-item text-white">
        <div class="user-panel d-flex ">
        <div class="info">
          <a onclick="CRUDUSUARIOS('AJUSTECUENTA','<?PHP echo $idUsuario;?>')"  class="d-block"><?php echo $nombresession;?></a>
        </div>
        </div>
      </li>
      <li class="nav-item text-white">
      <div class="dropdown">
        <a id="imguser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php if(!file_exists($imgsession)) { ?>
         <i class="fa fa-user-circle fa-2x text-success" ></i> <?php } else{ ?> 
        
        <img width="40" height="40" src="<?php  echo $imgsession;?>" class="img-circle elevation-2" alt="User Image"><?php } ?>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="row color"  >
            <div class="col-sm-12 text-center">
              <a id="imguser2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php if(!file_exists($imgsession)) { ?>
              <i width="100" class="fa fa-user-circle fa-7x text-success" ></i> <?php } else{ ?> 
              
              <img width="100" height="100" src="<?php  echo $imgsession;?>" class="img-circle elevation-2" alt="User Image"><?php } ?>
              </a>
            </div>
            <div class="col-sm-12 text-center">
              <a onclick="CRUDUSUARIOS('AJUSTECUENTA','<?PHP echo $idUsuario;?>')"  class="d-block"><?php echo $nombresession;?></a>
            </div>
          </div>
        
          <div class="dropdown-divider"></div>
          <div class="row">
            <div class="col-sm-6">
            <a class="dropdown-item" href="#" onClick="CRUDUSUARIOS('EDITARUSUARIO','<?PHP echo $idUsuario;?>')" data-toggle='modal' data-target='#myModal'>Mi Perfil</a>
            </div>
            <div class="col-sm-6">
            <a class="dropdown-item"  href="data/logout.php">Cerrar Sesión</a>
            </div>
          </div>
        </div>
       
     
</div>
      </li>
     
      <li class="nav-item dropdown hide">
        <a onclick="CRUDUSUARIOS('NUEVO')" id="btnnuevo" class="btn" data-toggle="modal" data-target="#myModal">
          <i class="far fa-1x fa-plus-square"></i>
        </a>
      </li>
    
      <li class="nav-item dropdown hide">
       
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far  fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item hide">
            <!-- Message Start -->
            <div class="media">
              <img src="<?php echo $imgsession;?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-question mr-1"></i>Tiene  4 ordenes de compra pendientes</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item hide dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="spannotificaciones1"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><span id="spannotificaciones2"></span> Notificaciones</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-question mr-2"></i> <span id="spanpendientes"></span> ordenes pendientes aprobar
            <span class="float-right text-muted text-sm hide">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-box-open mr-2"></i>  <span id="spanaprobadas"></span> ordenes pendientes despachar
            <span class="float-right text-muted text-sm hide">12 hours</span>
          </a>
          <a href="#" class="dropdown-item">
            <i class="fas fa-check-double mr-2"></i>  <span id="spanporentregar"></span> ordenes por entregar
            <span class="float-right text-muted text-sm hide">12 hours</span>
          </a>
          <a href="#" class="dropdown-item <?php //if($p5<=0){ echo "hide";}?>">
            <i class="fas fa-list mr-2"></i>  <span id="spanporfacturar"></span> ordenes por facturar
            <span class="float-right text-muted text-sm hide">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item hide">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Ver Todas las Notificaciones</a>
        </div>
      </li>
      <li class="nav-item hide">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-dark-navy sidebar-no-expand">
    <!-- Brand Logo -->
    <a ui-sref="Inicio({ Idvisita: '',Idpedido:'' })" ui-sref-opts="{reload: true}" class="brand-link navbar-dark">
      <!-- <img src="https://siigonube.siigo.com/SiigoCloudFiles/1f9921db-28ae-45b0-96e4-97be65cf8f2f/Uploads/MB/Company/Logotipo.png?version=8586187893968758459" class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
           <span class="brand-text2  text-white font-weight-light">
             <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;" href="">C.A.C</font>
            </font>
          </span>
           <span class="brand-text  text-white font-weight-light">
             <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">CONTROL ACTAS Y COMITÉS </font>
            </font>
          </span>
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar ">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex hide">
        <div class="image">
         <a ui-sref="Inicio({ Idvisita: '',Idpedido:'' })" ui-sref-opts="{reload: true}"> <img src="<?php echo $imgsession;?>" class="img-circle elevation-2" alt="User Image"></a>
        </div>
        <div class="info">
          <a onclick="CRUDUSUARIOS('AJUSTECUENTA','<?PHP echo $idUsuario;?>')"  data-toggle='modal' data-target='#myModal' class="d-block"><?php echo $nombresession;?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy text-sm" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item <?php if(permisosVentana($idperfil,14)<=0){ echo "hide"; } ?>">
              <a ui-sref="Visitas" ui-sref-opts="{reload: true}" class="nav-link">
                
                <i class="far fa-calendar-times nav-icon"></i>
                <p>Visitas</p>
              </a>
          </li>
          <li class="nav-item  <?php if($p13 <= 0){   echo 'hide';}?>">
                <a ui-sref="Comites" ui-sref-opts="{reload: true}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                  <p>Comite</p>
                </a>
              </li>
             
              <li class="nav-item <?php //if($p9 <= 0){   echo 'hide';}?>">
                <a ui-sref="Usuarios" ui-sref-opts="{reload: true}" class="nav-link">
                <i class="fas fa-user-alt nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
            
              
            <li class="nav-item <?php if($p5 <= 0){   echo 'hide';}?>">
                <a ui-sref="Perfiles" ui-sref-opts="{reload: true}" class="nav-link">
                  
                  <i class="fas fa-portrait  nav-icon"></i>
                  <p>Perfiles</p>
                </a>
            </li>
           
            
          <li class="nav-item has-treeview menu-open hide <?php //if(permisosVentana($idperfil,1)<=0 and permisosVentana($idperfil,2)<=0 and permisosVentana($idperfil,3)<=0 and permisosVentana($idperfil,13)<=0 and permisosVentana($idperfil,12)<=0 and permisosVentana($idperfil,5)<=0 and permisosVentana($idperfil,1)<=4 and permisosVentana($idperfil,6)<=0 and permisosVentana($idperfil,7)<=0){ echo "hide"; }?>">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-cog"></i>
              <p>
        
               
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item <?php //if(permisosVentana($idperfil,6)<=0){ echo "hide"; } ?>">
                <a ui-sref="Productos" ui-sref-opts="{reload: true}" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
              <li class="nav-item  <?php //if(permisosVentana($idperfil,7)<=0){ echo "hide"; } ?>">
                <a ui-sref="Categorias" ui-sref-opts="{reload: true}" class="nav-link">
                 <i class="fas fa-tshirt nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>
              <li class="nav-item  <?php //if(permisosVentana($idperfil,6)<=0){ echo "hide"; } ?>">
                <a ui-sref="Pedidos" ui-sref-opts="{reload: true}" class="nav-link">
                <i class="fas fa-clipboard-check nav-icon"></i>
                  <p>Pedidos</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item hide">
              <a href="data/logout.php" class="nav-link text-danger">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                <p>Cerrar Sesión</p>
              </a>
          </li>
          <li class="nav-header">
            <strong>Copyright &copy; <?PHP echo date('Y');?> <a href="https://pavas.com.co">PAVAS S.A.S</a>.</strong>
           <br>Todos los derechos reservados.
          </li>
        
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" id="titlemodulo1">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 ">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="#" id="titlemodulo2">Home</a></li>
              <li class="breadcrumb-item active" id="titlemodulo3">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" ui-view=""></div>
      <!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
 
  <!-- Main Footer -->

  <footer class="main-footer text-sm " >
    <div class="float-right"> 
      <button style="display:none" type="button" class="btn btn-primary mr-3 " id="btnguardar2"></button>
      <button  style="display:none" type="button" class="btn btn-success  mr-3 hi" id="btnguardar3"></button>
    </div>
    <!--<strong>Copyright &copy; 2014-2019 <a href="https://pavas.co">PAVAS S.A.S</a>.</strong>
    Todos los derechos reservados.-->
    
    <div class="float-left d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>

  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content" >
        <!--<div id="overlaymodal" class="overlay d-flex justify-content-center align-items-center">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>-->
        <div class="modal-header">
          <h4 class="modal-title" id="titlemodal">Default Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="contentmodal">
          <p>One fine body&hellip;</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
          <button   type="button" class="btn btn-primary" id="btnguardar"></button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<script src="plugins/moment/moment.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<script src="plugins/bootstrap/js/bootstrap3-typeahead.min.js?<?php echo time();?>"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script src="dist/dropify-master/dist/js/dropify.js?<?php echo time() ?>"></script>
<script src="dist/intro.js-2.9.3/intro.js?<?php echo time() ?>"></script>
<script src="dist/Parsley.js-2.8.1/dist/parsley.js?<?php echo time();?>"></script>
<script src="dist/Parsley.js-2.8.1/dist/i18n/es.js?<?php echo time();?>"></script>
<script src="dist/bootstrap-select-1.13.9/dist/js/bootstrap-select.js?<?php echo time();?>"></script>
<script src="dist/bootstrap-select-1.13.9/js/i18n/defaults-es_CL.js?<?php echo time();?>"></script>


<!-- SweetAlert2 -->
<script src="dist/sweetalert/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>


<!-- Tooltipster -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js?<?php echo time();?>"></script>
<link href="dist/tooltipster-master/css/tooltipster.css?<?php echo time();?>" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="dist/tooltipster-master/css/themes/tooltipster-light.css?<?php echo time();?>" />
<link rel="stylesheet" type="text/css" href="dist/tooltipster-master/css/themes/tooltipster-noir.css?<?php echo time();?>" />
<link rel="stylesheet" type="text/css" href="dist/tooltipster-master/css/themes/tooltipster-punk.css?<?php echo time();?>" />
<link rel="stylesheet" type="text/css" href="dist/tooltipster-master/css/themes/tooltipster-shadow.css?<?php echo time();?>" />
<script src="dist/tooltipster-master/js/jquery.tooltipster.js"></script>


<!--Password strength -->
<script src="dist/password_strength/js/password_strength.js"></script>
<script src="dist/password_strength/js/jquery-strength.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.20/sorting/datetime-moment.js"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/wysihtml5/0.3.0/wysihtml5.min.js?<?php echo time();?>"></script>

<!-- Summernote -->
<script src="plugins/bootstrap3-wysiwyg/dist/bootstrap3-wysihtml5.all.js?<?php echo time();?>"></script>
<script src="plugins/bootstrap3-wysiwyg/dist/bootstrap3-wysihtml5.min.js?<?php echo time();?>"></script>

<script src="dist/jquery.formatCurrency-1.4.0/jquery.formatCurrency-1.4.0.min.js?<?php echo time();?>"></script>
<script src="dist/jquery.formatCurrency-1.4.0/i18n/jquery.formatCurrency.all.js?<?php echo time();?>"></script>


<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<script src="plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js?<?php echo time();?>"></script>

<!-- <link href="dist/tooltipster-master/css/tooltipster.css?<?php //echo time(); ?>" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="/dist/tooltipster-master/dist/css/plugins/tooltipster/sideTip/themes/?<?php //echo time(); ?>" />
<link rel="stylesheet" type="text/css" href="/dist/tooltipster-master/dist/css/<?php //echo time(); ?>" />
<link rel="stylesheet" type="text/css" href="/dist/tooltipster-master/dist/css/<?php //echo time(); ?>" />
<link rel="stylesheet" type="text/css" href="/dist/tooltipster-master/dist/css/s?<?php //echo time(); ?>" /> -->
<!-- <script src="dist/tooltipster-master/js/jquer/dist/tooltipster-master/dist/css/?>"></script> -->





<script src="llamadas.js?<?php echo time();?>"></script>
</body>
</html>
