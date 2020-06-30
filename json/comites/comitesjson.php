<?php
include ("../../data/conexion.php");
session_start();// activa la variable de sesion
error_reporting(0);
include("../../data/validarpermisos.php");


$usuario   = $_COOKIE['usuarioPROYECTO1'];
$idUsuario = $_COOKIE['idusuarioPROYECTO1'];
$perfil    = $_SESSION["perfilPROYECTO1"];
//$perfil = $_POST['per'];
$cla =  $_POST['cla'];
$fec1 = $_POST['fec1'];
$fec2 = $_POST['fec2'];
$tem =  $_POST['tem'];
$est =  $_POST['est'];
$ests =  $_POST['ests'];
$nom =  $_POST['nom'];
$hoin=  $_POST['hoin'];
$opcion=  $_POST['opcion'];

$est= implode(",",(array)$est);
$table = 'tbl_comite';
if($est==""){ $est1="'0'" ;}else{$est1=$est;};

$primaryKey = 'co.com_clave_int';

$columns = array(
		array(
			'db' => 'co.com_clave_int',
			'dt' => 'DT_RowId', 'field' => 'com_clave_int',
			'formatter' => function( $d, $row ) {
				return 'row_'.$d;
			}
        ),
        array( 'db' => 'co.com_clave_int',  'dt' => 'Codigo',  'field' => 'com_clave_int' ),
        array( 'db' => 'co.com_nombre',     'dt' => 'nombre',  'field' => 'com_nombre' ),
		array( 'db' => 'co.com_fecha',      'dt' => 'fecha',   'field' => 'com_fecha' ),
		array( 'db' => 'co.com_motivo',     'dt' => 'motivo',  'field' => 'com_motivo' ),
		array( 'db' => 'co.com_fec_eliminacion','dt' => 'fecelimi',   'field' => 'com_fec_eliminacion' ),
		array( 'db' => 'SUBSTRING(CONVERT(co.com_hora_inicio,TIME),-8,5)','dt' => 'horaini', 'as' => 'horaini','field' => 'horaini'),
		array( 'db' => 'SUBSTRING(CONVERT(co.com_hora_fin,TIME),-8,5)',   'dt' => 'horafin', 'as' => 'horafin','field' => 'horafin'),		
        array( 'db' => 'co.com_clave_int',  'dt' => 'eliminar','field' => 'com_clave_int','formatter'=>function($d,$row){
				$esta=$row[10];
				if($esta==1){
					return "<a class='btn btn-circle btn-block btn-danger btn-xs' onclick=ELIMINARCOMITE('".$d."') title='Eliminar Comité' style='heigth:22px; width:22px'><i class='fa fa-trash'></i></a>";
				}else{
					return "";
				}
				$per = $row[2];			
        }),
        array( 'db' => 'co.com_clave_int',  'dt' => 'editar',  'field' => 'com_clave_int','formatter'=>function($d,$row){
				//return "<a class='btn btn-block btn-warning btn-xs'  title='Editar usuario' style='heigth:22px; width:22px' data-toggle='modal' data-target='#myModal'><i class='fa fa-edit'></i></a>";
				return "<a class='btn btn-block btn-warning btn-xs'  href='#/EdicionComites?Edit=".$d."'  title='Editar Comité' style='heigth:22px; width:22px' ><i class='fa fa-edit'></i></a>";
		}),	
		array( 'db' => 'co.est_clave_int',  'dt' => 'estado',  'field' => 'est_clave_int', 'formatter'=> function ($d,$row){
			if ($d== 1) {
				return "En proceso";
			} else if($d==3) {
				return "Cerrado";
			}else if($d==2) {
				return "Anulado";
			}
        }),	
        array( 'db' => 'co.com_clave_int',  'dt' => 'imprimir','field' => 'com_clave_int','formatter'=>function($d,$row){
			return "<a class='btn btn-block btn-primary btn-xs' onClick=CRUDCOMITES('IMPRIMIR','$d') title='Imprimir'  style='heigth:22px; width:22px' data-toggle='modal' data-target='#myModal'><i class='fa fa-print'></i></a>";
		}),
        array( 'db' => 'co.com_clave_int', ' dt' => 'enviarcorreo','field' => 'com_clave_int' ,'formatter'=>function($d,$row){
            return "<a onclick=CRUDCOMITES('SELECCIONENVIOCORREO',".$d.") title='' class='btn btn-xs btn-primary' data-toggle='modal' data-target='#myModal'><i class='fa fa-envelope'></i></a>";
		} ),		
);
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'bdproyecto1',
	'host' => 'localhost'
);

require( '../../data/ssp.class.php' );

$extraWhere="(`co`.`com_clave_int` LIKE REPLACE('".$cla."%',' ','%') OR '".$cla."' IS NULL OR '".$cla."' = '') 

and (`co`.`com_nombre` LIKE REPLACE('".$nom."%',' ','%')  OR '".$nom."' IS NULL OR '".$nom."' = '')
and (`co`.`com_fecha` BETWEEN '".$fec1."' and '".$fec2."' OR '".$fec1."' IS NULL OR '".$fec1."' = '') 
";
if($opcion== "LISTACOMITESMES"){
$extraWhere.="and (date_format(co.com_fecha, '%Y-%m')='".$ests."') ";
}else {
	$extraWhere.="and (`co`.`est_clave_int` in (".$est1.") OR '".$est."' IS NULL OR '".$est."' = '' )
	and (`co`.`est_clave_int` = '".$ests."' OR '".$ests."' IS NULL OR '".$ests."' = '' ) ";
	
	
}
if($ests!=2){
	$extraWhere.='and  co.est_clave_int !=2';
}


$groupBy = ' co.com_clave_int';
$with = '';
$joinQuery = "FROM tbl_comites AS co ";
echo json_encode(SSP::simple($_POST, $sql_details, $table, $primaryKey,$columns, $joinQuery, $extraWhere, $groupBy,$with));

// est_clave_int