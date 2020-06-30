<?php
    session_start();
    include('../../../data/conexion.php');
    $id=$_POST['id'];
    $nombresession = $_COOKIE["nombrePROYECTO1"];
    $usuario   = $_COOKIE['usuarioPROYECTO1'];
    $idUsuario = $_COOKIE['idusuarioPROYECTO1'];
    $perfil    = $_SESSION["perfilPROYECTO1"];
    date_default_timezone_set('America/Bogota');
    $fecha  = date("Y/m/d H:i:s");
    $titulo = "Comité N° ".$id;
    ob_start();
    include('informes.php');
    $content = ob_get_clean();  
    setlocale(LC_ALL,"es_ES.utf8","es_ES","esp");
    require_once('../../../clases/pdf/html2pdf.class.php');
    use  PHPMailer\PHPMailer\PHPMailer;
    use  PHPMailer\PHPMailer\Exception;
    require ('../../../PHPMailer-master/src/PHPMailer.php');
    require ('../../../PHPMailer-master/src/Exception.php');
    require ('../../../PHPMailer-master/src/SMTP.php');
	$archivo = utf8_decode($titulo.'.pdf');//Cambiar por nuevo campo en BD para fecha cierre de la intervencion
	$message = utf8_decode("Hola, a continuación se adjunta archivo de ".$titulo.".<br><br>Este mensaje es generado automáticamente por CONTROL ACTAS Y COMITÉS, por favor no responda a este correo, cualquier duda adicional,comuniquese con nosotros ");			
    //correo de la empresa 
    try
    {  
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(15, 10, 15, 15)); //Configura la hoja
        $html2pdf->pdf->SetDisplayMode('fullpage'); //Ver otros parÃ¡metros para SetDisplaMode
        $html2pdf->writeHTML($content); //Se escribe el contenido         
        $html2pdf->Output('envios/'.$archivo, 'F');
        $query = $result= mysqli_query($conectar,"SELECT * from tbl_comites  WHERE com_clave_int= $id");  
        $row = mysqli_fetch_array($query);
        $txtnombcomite = $row['com_nombre'];
        

        $con= mysqli_query($conectar,"SELECT
        desa.obc_clave_int,
        desa.obc_desarrollo,
        desa.com_clave_int,
        desa.obc_fechcumpli,
        usu.usu_clave_int,
        usu.usu_apellido,
        usu.usu_correo,
        usu.usu_nombre
        FROM
            tbl_comitesdesarrollo desa
        JOIN tbl_usuarios usu ON usu.usu_clave_int = desa.usu_clave_int
        WHERE
        desa.com_clave_int =  '".$id."'");
        while($dato = mysqli_fetch_array($con)){

            $usucla = $dato['usu_clave_int'];
            $usu = $dato['usu_nombre']." ".$dato['usu_apellido'];
            $ema = $dato['usu_correo'];
            $act = $dato['est_clave_int'];
            $txtnombdesar = $dato['obc_desarrollo'];
            $fechalim= $dato['obc_fechcumpli'];
            
            $asunto1 = "Desarrollo al Comité ".$id."";
            $asunto1 =  "=?ISO-8859-1?B?".base64_encode(utf8_decode($asunto1))."=?=";
            $contenido = file_get_contents('https://www.pavas.com.co/comites/funciones/comites/plantillas/plantilla1.php');
            $contenido = str_replace('%titulo%', $txtnombcomite, $contenido);
            $contenido = str_replace('%usunombre%', $usu, $contenido);
            $contenido = str_replace('%fecha%', $fechalim, $contenido);
            $contenido = str_replace('%tema%', $txtnombdesar, $contenido);
    
            $mail = new PHPMailer();
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";
            $mail->From = "adminpavas@pavas.co";
            $mail->FromName = "CONTROL ACTAS Y COMITÉS";	
            $mail->Subject = utf8_decode($asunto1);
            $mail->AddAddress($ema, "Empleado: ".$usu);
            $mail->AddReplyTo("adminpavas@pavas.co","CONTROL ACTAS Y COMITÉS");
            $mail->MsgHTML($contenido);

            if (!$mail->send())
            {
                $res = "error";
                $msn .= 'No se envio mensaje al siguiente email<strong>(' . $ema . ')</strong>' . $mails->ErrorInfo . '<br>';
            }
            else
            {
                $res = "ok";
                $msn = "Su contraseña a sido recuperada satisfactoriamente<br> Por favor revise su correo:".$ema;
            }             
        }
       // $html2pdf->Output($archivo); //Nombre default del PDF
    }
    catch(HTML2PDF_exception $e) {
        $msn  = $e;
        $res = "error";//exit;
    }
	$datos[] = array("msn"=>$msn,"res"=>$res);
	echo json_encode($datos);

?>