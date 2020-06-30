<?php
include ("../../data/conexion.php");
session_start();// activa la variable de sesion
error_reporting(0);
$categoria   = $_COOKIE['categoriaPROYECTO1'];
$idcategoria = $_COOKIE['idusuarioPROYECTO1'];
$categoria    = $_SESSION["categoriaPROYECTO1"];
//$categoria = $_POST['per'];
$per = $_POST['per'];

$table = 'tbl_categorias';

$primaryKey = 'c.cat_clave_int';

$columns = array(
		array(
			'db' => 'c.cat_clave_int',
			'dt' => 'DT_RowId', 'field' => 'cat_clave_int',
			'formatter' => function( $d, $row ) {
				return 'row_'.$d;
			}
        ),
  
		array( 'db' => 'c.cat_descripcion', 'dt' => 'categoria',  'field' => 'cat_descripcion' ),	
	
        array( 'db' => 'c.cat_clave_int', 'dt' => 'eliminar', 'field' => 'cat_clave_int','formatter'=>function($d,$row){
			$per = $row[2];
				return "<a class='btn btn-circle btn-block btn-danger btn-xs' onclick=CRUDCATEGORIA('ELIMINAR','".$d."') title='Eliminar Categori' style='heigth:22px; width:22px'><i class='fa fa-trash'></i></a>";

        }),
        array( 'db' => 'c.cat_clave_int', 'dt' => 'editar', 'field' => 'cat_clave_int','formatter'=>function($d,$row){
			
				return "<a class='btn btn-block btn-warning btn-xs' onClick=CRUDCATEGORIA('EDITAR','$d') title='Editar usuario' style='heigth:22px; width:22px' data-toggle='modal' data-target='#myModal'><i class='fa fa-edit'></i></a>";
        }),	
        array( 'db' => ' c.est_clave_int', 'dt' => 'estado',  'field' => 'est_clave_int', 'formatter'=> function ($d,$row)
		{
			if ($d== 1) {
				return "Activo";
			} else {
				return "Inctivo";
			}
			
		
		} ),
		
		
);
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'bdproyecto1',
	'host' => 'localhost'
);

require( '../../data/ssp.class.php' );



$extraWhere="(`c`.`cat_descripcion` LIKE REPLACE('".$per."%',' ','%') OR '".$per."' IS NULL OR '".$per."' = '') and c.est_clave_int != 2";

$groupBy = ' c.cat_clave_int';
$with = '';
$joinQuery = "FROM tbl_categorias= c" ;
echo json_encode(SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy,$with));

