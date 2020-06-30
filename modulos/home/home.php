<?php
session_start();
include('../../data/conexion.php');
error_reporting(0);


use  PHPMailer\PHPMailer\PHPMailer;
use  PHPMailer\PHPMailer\Exception;
require ('../../PHPMailer-master/src/PHPMailer.php');
require ('../../PHPMailer-master/src/Exception.php');
require ('../../PHPMailer-master/src/SMTP.php');
//$login     = isset($_SESSION['persona']);
// cookie que almacena el numero de identificacion de la persona logueada
$usuario   = $_COOKIE['usuarioPROYECTO1'];
$idUsuario = $_COOKIE['idusuarioPROYECTO1'];
$perfil    = $_SESSION["perfilPROYECTO1"];
date_default_timezone_set('America/Bogota');
$fecha  = date("Y/m/d H:i:s");
$opcion = $_POST['opcion'];

?>

<div class="container-fluid" id="divhome">
</div>
    
