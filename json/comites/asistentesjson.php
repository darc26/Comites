<?php
include ("../../data/conexion.php");
session_start();// activa la variable de sesion
error_reporting(0);
$usuario   = $_COOKIE['usuarioPROYECTO1'];
$idUsuario = $_COOKIE['idusuarioPROYECTO1'];
$perfil    = $_SESSION["perfilPROYECTO1"];
//$perfil = $_POST['per'];
$id = $_POST['id'];

$table = 'tbl_comitesdesarrollo';

$primaryKey = 'o.obc_clave_int';

$columns = array(
		array(
			'db' => 'o.obc_clave_int',
			'dt' => 'DT_RowId', 'field' => 'obc_clave_int',
			'formatter' => function( $d, $row ) {
				return 'rowd_'.$d;
			}
        ),
		
		array( 'db' => 'o.obc_desarrollo',  'dt' => 'desarrollo',  'field' => 'obc_desarrollo' ),
		array( 'db' => 'CONCAT(usu.usu_nombre, " ", usu.usu_apellido)',   'dt' => 'asistente', 'as' => 'asistente','field' => 'asistente'),
		array( 'db' => 'usu.usu_correo',      'dt' => 'correo',  'field' => 'usu_correo' ),
		
		array( 'db' => 'o.obc_fechcumpli',  'dt' => 'fechcumpli',  'field' => 'obc_fechcumpli' , 'formatter'=> function ($d,$row){
			if ($d== 0) {
				return "";
			} else{
				return $d;
			}
			
		
		}),
        array( 'db' => 'o.obc_clave_int', 'dt' => 'eliminar', 'field' => 'obc_clave_int','formatter'=>function($d,$row){
			$ped = $row[2];
				return "<a class='btn btn-circle btn-block btn-danger btn-xs' onclick=CRUDCOMITES('ELIMINARDESARROLLO','".$d."') title='Eliminar Asistente' style='heigth:22px; width:22px'><i class='fa fa-trash'></i></a>";

        }),   
		
);
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'bdproyecto1',
	'host' => 'localhost'
);

require( '../../data/ssp.class.php' );

$extraWhere="`o`.`com_clave_int`  = '".$id."'and  o.est_clave_int !=2";

$groupBy = ' o.obc_clave_int';
$with = '';
$joinQuery = "FROM tbl_comitesdesarrollo o LEFT JOIN tbl_usuarios usu ON usu.usu_clave_int= o.usu_clave_int " ;


echo json_encode(SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy,$with));

