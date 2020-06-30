

<?php
include ("../../data/conexion.php");
session_start();// activa la variable de sesion
error_reporting(0);
$usuario   = $_COOKIE['usuarioPROYECTO1'];
$idUsuario = $_COOKIE['idusuarioPROYECTO1'];
$perfil    = $_SESSION["perfilPROYECTO1"];
//$perfil = $_POST['per'];
$ped = $_POST['ped'];

$table = 'tbl_pedido';

$primaryKey = 'p.ped_clave_int';

$columns = array(
		array(
			'db' => 'p.ped_clave_int',
			'dt' => 'DT_RowId', 'field' => 'ped_clave_int',
			'formatter' => function( $d, $row ) {
				return 'row_'.$d;
			}
        ),
  
        array( 'db' => 'p.ped_clave_int', 'dt' => 'pedido',  'field' => 'ped_clave_int' ),
        array( 'db' => 'usu.usu_nombre',  'dt' => 'usuario',  'field' => 'usu_nombre' ),   
		array( 'db' => 'p.ped_fecha',     'dt' => 'fecha',  'field' => 'ped_fecha' ),
		array( 'db' => 'p.ped_total',     'dt' => 'total',  'field' => 'ped_total' ,'formatter'=>function($d,$row){
			return "<p>"."$".number_format( $d,0,',',',')."</p>";

		}),		    	  
		array( 'db' => 'p.ped_clave_int', 'dt' => 'eliminar', 'field' => 'ped_clave_int','formatter'=>function($d,$row){
			$ped = $row[2];
				return "<a class='btn btn-circle btn-block btn-danger btn-xs' onclick=CRUDPEDIDOS('ELIMINAR','".$d."') title='Eliminar Usuario' style='heigth:22px; width:22px'><i class='fa fa-trash'></i></a>";

        }),
        array( 'db' => 'p.ped_clave_int', 'dt' => 'editar', 'field' => 'ped_clave_int','formatter'=>function($d,$row){
			
				return "<a class='btn btn-block btn-warning btn-xs' onClick=CRUDPEDIDOS('EDITAR','$d') title='Editar usuario' style='heigth:22px; width:22px' data-toggle='modal' data-target='#myModal'><i class='fa fa-edit'></i></a>";
		}),
		array( 'db' => 'p.ped_clave_int', 'dt' => 'imprimir', 'field' => 'ped_clave_int','formatter'=>function($d,$row){
			
			return "<a class='btn btn-block btn-primary btn-xs' onClick=CRUDPEDIDOS('IMPRIMIR','$d') title='Imprimir'  style='heigth:22px; width:22px' data-toggle='modal' data-target='#myModal'><i class='fa fa-print'></i></a>";
		}),
		array( 'db' => 'p.ped_clave_int', 'dt' => 'excel', 'field' => 'ped_clave_int','formatter'=>function($d,$row){
				
			return "<a href='modulos/pedidos/informes/informeexcel.php?id=".$d."' class='btn btn-block btn-success btn-xs'  title='Excel'  style='heigth:22px; width:22px'><i class='far fa-file-excel'></i></a>";
		})

		
);
$sql_details = array(
	'user' => 'root',
	'pass' => '9A12)WHFy$2p4v4s',
	'db'   => 'bdproyecto1',
	'host' => 'localhost'
);

require( '../../data/ssp.class.php' );



$extraWhere="(`p`.`ped_clave_int` LIKE REPLACE('".$ped."%',' ','%') OR '".$ped."' IS NULL OR '".$ped."' = '') and p.usu_creacion ='".$idUsuario."' and p.est_clave_int !=2 ";

$groupBy = ' p.ped_clave_int';
$with = '';
$joinQuery = "FROM tbl_pedido p left outer JOIN tbl_usuarios usu ON usu.usu_clave_int= p.usu_clave_int" ;


echo json_encode(SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy,$with));

