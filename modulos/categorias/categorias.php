<?php
session_start();
include('../../data/conexion.php');
error_reporting(0);
//$login     = isset($_SESSION['persona']);
// cookie que almacena el numero de identificacion de la persona logueada
$perfil   = $_COOKIE['perfilPROYECTO1'];
$idperfil = $_COOKIE['idusuarioPROYECTO1'];
$perfil    = $_SESSION["perfilPROYECTO1"];
date_default_timezone_set('America/Bogota');
$fecha  = date("Y/m/d H:i:s");;
?>

<div class="card">
    <!-- /.card-header -->
    <div class="card-header" id="filtros">       
    </div>
    <!-- /.card-body -->
    <div class="card-body" id="tabladatos">        
    </div>
    
    
</div>
<!-- page script -->
