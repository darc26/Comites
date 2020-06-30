<?php
include ("../../data/conexion.php");
session_start();// activa la variable de sesion
error_reporting(0);
include("../../data/validarpermisos.php");


$usuario   = $_COOKIE['usuarioPROYECTO1'];
$idUsuario = $_COOKIE['idusuarioPROYECTO1'];
$perfil    = $_SESSION["perfilPROYECTO1"];
//$perfil = $_POST['per'];
$nom = $_POST['nom'];
$ape = $_POST['ape'];
$ema = $_POST['ema'];
$per = $_POST['per'];
$per= implode(",",(array)$per);
$table = 'tbl_usuarios';
if($per==""){ $per1="'0'" ;}else{$per1=$per;};

$primaryKey = 'u.usu_clave_int';

$columns = array(
		array(
			'db' => 'u.usu_clave_int',
			'dt' => 'DT_RowId', 'field' => 'usu_clave_int',
			'formatter' => function( $d, $row ) {
				return 'row_'.$d;
			}
        ),
      
		
        array( 'db' => 'u.usu_nombre',        'dt' => 'nombre',  'field' => 'usu_nombre' ),
		array( 'db' => 'u.usu_apellido',      'dt' => 'apellido',  'field' => 'usu_apellido' ),
		array( 'db' => 'u.usu_usuario',      'dt' => 'usuario',  'field' => 'usu_usuario' ),
		array( 'db' => 'perf.prf_descripcion', 'dt' => 'perfil',  'field' => 'prf_descripcion' ),		
		array( 'db' => 'u.usu_correo',         'dt' => 'correo',  'field' => 'usu_correo' ),		
        array( 'db' => 'u.usu_clave_int', 'dt' => 'eliminar', 'field' => 'usu_clave_int','formatter'=>function($d,$row){
			$per = $row[2];
				return "<a class='btn btn-circle btn-block btn-danger btn-xs' onclick=CRUDUSUARIOS('ELIMINAR','".$d."') title='Eliminar Usuario' style='heigth:22px; width:22px'><i class='fa fa-trash'></i></a>";

        }),
        array( 'db' => 'u.usu_clave_int', 'dt' => 'editar', 'field' => 'usu_clave_int','formatter'=>function($d,$row){
			
				return "<a class='btn btn-block btn-warning btn-xs' onClick=CRUDUSUARIOS('EDITAR','$d') title='Editar Usuario' style='heigth:22px; width:22px' data-toggle='modal' data-target='#myModal'><i class='fa fa-edit'></i></a>";
		}),	
		array( 'db' => ' u.est_clave_int', 'dt' => 'estado',  'field' => 'est_clave_int', 'formatter'=> function ($d,$row){
				if ($d== 1) {
					return "Activo";
				} else {
					return "Inctivo";
				}
				
			
		}),
		array( 'db' => 'u.usu_clave_int', 'dt' => 'permiso', 'field' =>'usu_clave_int','formatter'=>function($d,$row){
			return "<a class='btn btn-block btn-info btn-xs' onClick=CRUDUSUARIOS('ASIGNARPERMISOS','$d')  title='Permisos' style='heigth:22px; width:22px' data-toggle='modal' data-target='#myModal'><i class='fas fa-lock'></i></i></a>";
	})
		
		
);
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'bdproyecto1',
	'host' => 'localhost'
);

require( '../../data/ssp.class.php' );



$extraWhere="(`u`.`usu_nombre` LIKE REPLACE('".$nom."%',' ','%') OR '".$nom."' IS NULL OR '".$nom."' = '') 
and (`u`.`usu_apellido` LIKE REPLACE('".$ape."%',' ','%')  OR '".$ape."' IS NULL OR '".$ape."' = '')and 
  (`u`.`usu_correo` LIKE REPLACE('".$ema."%',' ','%') OR '".$ema."' IS NULL OR '".$ema."' = '' ) and 
  (`perf`.`prf_clave_int` in (".$per1.") OR '".$per."' IS NULL OR '".$per."' = '' ) 
   and u.est_clave_int !=2";

$groupBy = ' u.usu_clave_int';
$with = '';
$joinQuery = "FROM tbl_usuarios AS u JOIN tbl_perfil perf ON perf.prf_clave_int= u.prf_clave_int ";
echo json_encode(SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy,$with));

