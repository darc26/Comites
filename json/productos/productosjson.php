<?php
include ("../../data/conexion.php");
session_start();// activa la variable de sesion
error_reporting(0);
$perfil   = $_COOKIE['perfilPROYECTO1'];
$idperfil = $_COOKIE['idusuarioPROYECTO1'];
$perfil    = $_SESSION["perfilPROYECTO1"];
//$perfil = $_POST['per'];
$pro = $_POST['pro'];

$table = 'tbl_productos';

$primaryKey = 'p.pro_clave_int';

$columns = array(
		array(
			'db' => 'p.pro_clave_int',
			'dt' => 'DT_RowId', 'field' => 'pro_clave_int',
			'formatter' => function( $d, $row ) {
				return 'row_'.$d;
			}
        ),
  
        array( 'db' => 'p.pro_nombre',      'dt' => 'nombre',  'field' => 'pro_nombre' ),
        array( 'db' => 'p.pro_descripcion', 'dt' => 'descripcion',  'field' => 'pro_descripcion' ),   
        array( 'db' => 'cate.cat_descripcion','dt' => 'categoria',  'field' => 'cat_descripcion' ),
        array( 'db' => 'p.pro_producto',    'dt' => 'producto',  'field' => 'pro_producto','formatter'=>function($d,$row){
			return" <img src='$d' alt='' heigth='auto' width='100px'/>";
		}),	
        array( 'db' => 'p.pro_clave_int', 'dt' => 'eliminar', 'field' => 'pro_clave_int','formatter'=>function($d,$row){
			$per = $row[2];
				return "<a class='btn btn-circle btn-block btn-danger btn-xs' onclick=CRUDPRODUCTOS('ELIMINAR','".$d."') title='Eliminar Usuario' style='heigth:22px; width:22px'><i class='fa fa-trash'></i></a>";

        }),
        array( 'db' => 'p.pro_clave_int', 'dt' => 'editar', 'field' => 'pro_clave_int','formatter'=>function($d,$row){
			
				return "<a class='btn btn-block btn-warning btn-xs' onClick=CRUDPRODUCTOS('EDITAR','$d') title='Editar usuario' style='heigth:22px; width:22px' data-toggle='modal' data-target='#myModal'><i class='fa fa-edit'></i></a>";
        }),	
        array( 'db' => ' p.est_clave_int', 'dt' => 'estado',  'field' => 'est_clave_int', 'formatter'=> function ($d,$row)
		{
			if ($d== 1) {
				return "Activo";
			} else {
				return "Inctivo";
			}		
		} ),
		array( 'db' => 'p.pro_precio ',    'dt' => 'precio',   'field' => 'pro_precio','formatter'=>function($d,$row){
			return "<p>"."$".number_format( $d,0,',',',')."</p>";

		}),
		
		
);
$sql_details = array(
	'user' => 'usrcomites',
	'pass' => '',
	'db'   => 'bdproyecto1',
	'host' => 'localhost'
);

require( '../../data/ssp.class.php' );



$extraWhere="(`p`.`pro_nombre` LIKE REPLACE('".$pro."%',' ','%') OR '".$pro."' IS NULL OR '".$pro."' = '') and p.est_clave_int !=2";

$groupBy = ' p.pro_clave_int';
$with = '';
$joinQuery = "FROM tbl_productos p left outer JOIN tbl_categorias cate ON cate.cat_clave_int= p.cat_clave_int" ;
echo json_encode(SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy,$with));

