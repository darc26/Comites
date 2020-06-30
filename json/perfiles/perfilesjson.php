<?php
include ("../../data/conexion.php");
session_start();// activa la variable de sesion
error_reporting(0);
include("../../data/validarpermisos.php");
$perfil   = $_COOKIE['perfilPROYECTO1'];
$idperfil = $_COOKIE['idusuarioPROYECTO1'];
$perfil    = $_SESSION["perfilPROYECTO1"];
//$perfil = $_POST['per'];
$per = $_POST['per'];

$table = 'tbl_perfil';

$primaryKey = 'p.prf_clave_int';

$columns = array(
		array(
			'db' => 'p.prf_clave_int',
			'dt' => 'DT_RowId', 'field' => 'prf_clave_int',
			'formatter' => function( $d, $row ) {
				return 'row_'.$d;
			}
        ),
  
		array( 'db' => 'p.prf_descripcion', 'dt' => 'perfil',  'field' => 'prf_descripcion' ),	
        array( 'db' => 'p.prf_clave_int', 'dt' => 'eliminar', 'field' => 'prf_clave_int','formatter'=>function($d,$row){
			$per = $row[2];
				return "<a class='btn btn-circle btn-block btn-danger btn-xs' onclick=CRUDPERFIL('ELIMINAR','".$d."') title='Eliminar Perfil' style='heigth:22px; width:22px'><i class='fa fa-trash'></i></a>";
        }),
        array( 'db' => 'p.prf_clave_int', 'dt' => 'editar', 'field' => 'prf_clave_int','formatter'=>function($d,$row){
				return "<a class='btn btn-block btn-warning btn-xs' onClick=CRUDPERFIL('EDITAR','$d') title='Editar Perfil' style='heigth:22px; width:22px' data-toggle='modal' data-target='#myModal'><i class='fa fa-edit'></i></a>";
        }),	
        array( 'db' => ' p.est_clave_int', 'dt' => 'estado',  'field' => 'est_clave_int', 'formatter'=> function ($d,$row){
			if ($d== 1) {
				return "Activo";
			} else {
				return "Inctivo";
			}
		} ),
		array( 'db' => 'p.prf_clave_int', 'dt' => 'permiso', 'field' => 'prf_clave_int','formatter'=>function($d,$row){
			return "<a class='btn btn-block btn-info btn-xs' onClick=CRUDPERFIL('ASIGNARPERMISOS','$d')  title='Permisos' style='heigth:22px; width:22px' data-toggle='modal' data-target='#myModal'><i class='fas fa-lock'></i></i></a>";
	})
		
		
);
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'bdproyecto1',
	'host' => 'localhost'
);

require( '../../data/ssp.class.php' );



$extraWhere="(`p`.`prf_descripcion` LIKE REPLACE('".$per."%',' ','%') OR '".$per."' IS NULL OR '".$per."' = '') and p.est_clave_int != 2";

$groupBy = ' p.prf_clave_int';
$with = '';
$joinQuery = "FROM tbl_perfil= p" ;
echo json_encode(SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy,$with));

