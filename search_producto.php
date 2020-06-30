<?php
include ("data/conexion.php");

$sql = "select pro_clave_int,sinacentos2(pro_nombre)  nompro,pro_codigo,pro_descripcionbreve,pro_uni_venta,pro_pes_venta,pro_mu_venta,pro_mp_venta,pro_estado,c.cat_nombre from bl_productos AS p JOIN tbl_marcas m ON m.mar_clave_int = p.mar_clave_int join tbl_precios_mercado pm on pm.pro_clave_int = p.pro_clave_int where ( sinacentos2(p.pro_nombre) ILIKE '%".$_GET['query']."%' OR p.pro_nombre ILIKE '%".$_GET['query']."%'  OR '".$_GET['query']."' IS NULL OR '".$_GET['query']."' = '' ) and p.est_clave_int = 1  ORDER BY pro_nombre ASC";

$resultset = mysqli_query($conectar, $sql);
$json = array();
while( $rows = mysqli_fetch_array($resultset) ) {
	$cat = $rows['cat_nombre'];
	$json[] = array("name"=> $rows["nompro"],"codigo"=>$rows['pro_codigo'], "sql"=>$sql);
}
echo json_encode($json);
?>

