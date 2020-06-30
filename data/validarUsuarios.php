<?php
	session_start();
	error_reporting(0);
	ini_set("session.gc_maxlifetime","2592000");
	include('conexion.php');
	date_default_timezone_set('America/Bogota');
	$email= $_POST['loginmail'];
	$contrasena= $_POST['loginpass'];
	$url="";
	$contrasenaEncript= md5($contrasena);
	
	if (($contrasena == NULL) || ($email == NULL))
	{
		$contrasenaMala= "1";
		$res = "error";
		$msn = "Correo electrónico o Contraseña incorrectos. En caso de haber olvidado tu datos de inicio de sesión puedes recuperar tus datos en el link ¿Olvidaste Tu contraseña? ";
		session_destroy();
	}
	else
	if($contrasena != '' and $email != '')
	{
		$contrasenaMala= "2";
		$con = mysqli_query($conectar,"select * from tbl_usuarios where (usu_correo = '".$email."' or UPPER(usu_usuario) = UPPER('".$email."')) and est_clave_int!=2 LIMIT 1");
		$dato = mysqli_fetch_array($con);
		$num = mysqli_num_rows($con);
		$usu = $dato['usu_usuario'];
		$nom = $dato['usu_nombre']." ".$dato['usu_apellido']; if($usu=="" || $usu==NULL){ $usu = $nom; }
		$ema = $dato['usu_correo'];
		$img = $dato['usu_imagen'];
		$contra = $dato['usu_contrasena'];
		$contra = decrypt($contra,'usuarios');
		$idu = $dato['usu_clave_int'];
		$per = $dato['prf_clave_int'];
		if( $contra != $contrasena )/*strtoupper($ema) != strtoupper($email) |||| $usu-email*/
		{
			$res = "error";
			$msn = "Correo electrónico o Contraseña incorrectos. En caso de haber olvidado tu datos de inicio de sesión puedes recuperar tus datos en el link ¿Olvidaste Tu contraseña? ";
			session_destroy();
		}
		else
		{

			$_SESSION['idusuarioPROYECTO1'] = $idu;
			/*$_SESSION['tiempoksas'] = time();
			$_SESSION["nombreksas"] = $nom;
			$_SESSION["imgksas"]= $img;
			$_SESSION["emaksas"]= $ema;*/
			$_SESSION["perfilPROYECTO1"]=$per;
			setcookie("imgPROYECTO1",$img, time() + (86400) , "/");//1 dia
			setcookie("nombrePROYECTO1",$nom, time() + (86400) , "/");//1 dia
			setcookie("usuarioPROYECTO1",$usu, time() + (86400) , "/");//1 dia
			setcookie("idusuarioPROYECTO1",$idu, time() + (86400) , "/");//1 dia
			$identificador= session_id();
			$url = "principal.php";			
			$res = "ok";
			$msn = "";
		}
	}
		
	$datos = array();
	$datos["res"] = $res;
	$datos["msn"] = $msn;
	$datos["url"] = $url;
	$json = json_encode($datos);
	echo json_encode($datos, JSON_FORCE_OBJECT);
?> 