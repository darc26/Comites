<?php
include ("../../data/conexion.php");
session_start();// activa la variable de sesion
error_reporting(0);
$usuario   = $_COOKIE['usuarioPROYECTO1'];
$idUsuario = $_COOKIE['idusuarioPROYECTO1'];
$perfil    = $_SESSION["perfilPROYECTO1"];
//$perfil = $_POST['per'];
$pro = $_POST['pro'];
$idpedido = $_POST['idpedido'];

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
  
        array( 'db' => 'p.pro_nombre',        'dt' => 'nombre',       'field' => 'pro_nombre' ),
        array( 'db' => 'p.pro_descripcion',   'dt' => 'descripcion',  'field' => 'pro_descripcion' ),   
		array( 'db' => 'p.pro_clave_int',     'dt' => 'totalpar',     'field' => 'pro_clave_int','formatter'=>function($d,$row){
			global $conectar;
			global $idUsuario;
			global $idpedido;
			if($idpedido>0){
				$con = mysqli_query($conectar, "SELECT pde_cantidad*pde_precio pretot from tbl_pedidodetalle where pro_clave_int= '".$d."' and ped_clave_int = '".$idpedido."'");
			
			}else{
				$con = mysqli_query($conectar, "SELECT pde_cantidad*pde_precio pretot from tbl_pedidodetalle where pro_clave_int= '".$d."' and usu_clave_int = '".$idUsuario."' AND est_clave_int= 0 limit 1");
			}
			
			$dat = mysqli_fetch_array($con); $pretot = $dat['pretot'];

			return "<span id='pretotal_".$row[0]."' > $".number_format($pretot,0,'',',')."</span>";
		
		} ),
		array( 'db' => 'cate.cat_descripcion','dt' => 'categoria',    'field' => 'cat_descripcion' ),        	
        array( 'db' => 'p.pro_clave_int',     'dt' => 'cantidad',     'field' => 'pro_clave_int','formatter'=>function($d,$row){
			global $conectar;
			global $idUsuario;
			global $idpedido;
			if($idpedido>0){
				$con = mysqli_query($conectar, "SELECT pde_cantidad from tbl_pedidodetalle where pro_clave_int= '".$d."' and ped_clave_int = '".$idpedido."' limit 1");
			}else{
				$con = mysqli_query($conectar, "SELECT pde_cantidad from tbl_pedidodetalle where pro_clave_int= '".$d."' and usu_clave_int = '".$idUsuario."' AND est_clave_int= 0 limit 1");
			}
			
			$dat = mysqli_fetch_array($con); $cant = $dat['pde_cantidad'];
		
				//return "SELECT pde_cantidad from tbl_pedidodetalle where pro_clave_int= '".$d."' and usu_clave_int = '".$idUsuario."' AND est_clave_int= 0 limit 1";
			return "<input type='number' class='form-control' id='cantidad_".$row[0]."' data-precio=".$row[6]. " style=' width:70px'  onkeyup=CRUDPEDIDOS('MODIFICARCANTIDAD','".$d."' onchange=CRUDPEDIDOS('MODIFICARCANTIDAD','".$d."')  value='".$cant."' />";

        }),       
		array( 'db' => 'p.pro_precio ',       'dt' => 'precio',       'field' => 'pro_precio','formatter'=>function($d,$row){
			return "$".number_format( $d,0,',',',');

		}),
		
		
		
);
$sql_details = array(
	'user' => 'root',
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

