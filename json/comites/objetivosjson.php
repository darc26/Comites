<?php
include ("../../data/conexion.php");
session_start();// activa la variable de sesion
error_reporting(0);
$usuario   = $_COOKIE['usuarioPROYECTO1'];
$idUsuario = $_COOKIE['idusuarioPROYECTO1'];
$perfil    = $_SESSION["perfilPROYECTO1"];
//$perfil = $_POST['per'];

$id = $_POST['id'];

$table = 'tbl_comitesobjetivos';

$primaryKey = 'o.obc_clave_int';

$columns = array(
		array(
			'db' => 'o.obc_clave_int',
			'dt' => 'DT_RowId', 'field' => 'obc_clave_int',
			'formatter' => function( $d, $row ) {
				return 'rowd_'.$d;
			}
        ),

        array( 'db' => 'o.obc_objetivo',  'dt' => 'objetivo',  'field' => 'obc_objetivo' ),
        array( 'db' => 'o.obc_clave_int', 'dt' => 'eliminar', 'field' => 'obc_clave_int','formatter'=>function($d,$row){
			$ped = $row[2];
				return "<a class='btn btn-circle btn-block btn-danger btn-xs' onclick=CRUDCOMITES('ELIMINAROBJETIVOS','".$d."') title='Eliminar Usuario' style='heigth:22px; width:22px'><i class='fa fa-trash'></i></a>";

		}),  
		array( 'db' => 'o.obc_clave_int', 'dt' => 'agregar', 'field' => 'obc_clave_int','formatter'=>function($d,$row){
			$ped = $row[2];
				return"<a class='btn btn-circle btn-block btn-primary btn-xs' onclick=CRUDCOMITES('NUEVODESCRIPCION') 
				data-toggle='modal' title='Eliminar Usuario' style='heigth:22px; width:22px' data-target='#myModal'><i class='fa fa-plus-square'></i></a>";
		}),     
			
);
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'bdproyecto1',
	'host' => 'localhost'
);

require( '../../data/ssp.class.php' );
if($id>0){
	$extraWhere="`o`.`com_clave_int`  = '".$id."'and  o.est_clave_int !=2";
}else{
	$extraWhere="`o`.`usu_clave_int`  = '".$idUsuario."'and  o.est_clave_int =0";
}


$groupBy = ' o.obc_clave_int';
$with = '';
$joinQuery = "FROM tbl_comitesobjetivos o " ;


echo json_encode(SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy,$with));

