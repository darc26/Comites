<?php
include ("../../data/conexion.php");
session_start();// activa la variable de sesion
error_reporting(0);
$perfil   = $_COOKIE['perfilPROYECTO1'];
$idperfil = $_COOKIE['idusuarioPROYECTO1'];
$perfil    = $_SESSION["perfilPROYECTO1"];
//$perfil = $_POST['per'];
$idpedido = $_POST['idpedido'];

$table = 'tbl_pedidodetalle';

$primaryKey = 'p.pde_clave_int';

$columns = array(
		array(
			'db' => 'p.pde_clave_int',
			'dt' => 'DT_RowId', 'field' => 'pde_clave_int',
			'formatter' => function( $d, $row ) {
				return 'rowd_'.$d;
			}
        ),
  
        array( 'db' => 'p.pde_clave_int', 'dt' => 'pedido',  'field' => 'pde_clave_int' ),
        array( 'db' => 'pr.pro_nombre',   'dt' => 'producto',  'field' => 'pro_nombre' ),   
		array( 'db' => 'p.pde_cantidad',  'dt' => 'cantidad',  'field' => 'pde_cantidad' ),
        array( 'db' => 'p.pde_precio',    'dt' => 'precio',  'field' => 'pde_precio','formatter'=>function($d,$row){
			return "<p>"."$".number_format( $d,0,',',',')."</p>";

		}),
		array( 'db' => 'p.pde_cantidad*p.pde_precio',  'dt' => 'total', 'as'=>'total',  'field' => 'total' ,'formatter'=>function($d,$row){
			return "<p>"."$".number_format( $d,0,',',',')."</p>";

		}),
		
);
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'bdproyecto1',
	'host' => 'localhost'
);

require( '../../data/ssp.class.php' );



$extraWhere="`p`.`ped_clave_int`  = '".$idpedido."'";

$groupBy = ' p.pde_clave_int';
$with = '';
$joinQuery = "FROM tbl_pedidodetalle p  JOIN tbl_productos pr ON pr.pro_clave_int= p.pro_clave_int" ;


echo json_encode(SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy,$with));

