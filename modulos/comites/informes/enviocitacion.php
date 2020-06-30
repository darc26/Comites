 <?php
 
    session_start();
    include('../../../data/conexion.php');
    $id=$_POST['idco'];
    $nombresession = $_COOKIE["nombrePROYECTO1"];
    $usuario   = $_COOKIE['usuarioPROYECTO1'];
    $idUsuario = $_COOKIE['idusuarioPROYECTO1'];
    $perfil    = $_SESSION["perfilPROYECTO1"];
    date_default_timezone_set('America/Bogota');
    $fecha  = date("Y/m/d H:i:s");
    use  PHPMailer\PHPMailer\PHPMailer;
    use  PHPMailer\PHPMailer\Exception;
    require ('../../../PHPMailer-master/src/PHPMailer.php');
    require ('../../../PHPMailer-master/src/Exception.php');
    require ('../../../PHPMailer-master/src/SMTP.php');
    $query = $result= mysqli_query($conectar,"SELECT * from tbl_comites  WHERE com_clave_int= $id");  
    $row = mysqli_fetch_array($query);
    $txtnombcomite = $row['com_nombre'];
    $fechacom = $row['com_fecha'];
    $horainicio = $row[ 'com_hora_inicio'];
    $horafin = $row['com_hora_fin'];
    $txtdesarrollo = $row['com_tema'];
    $est = $row['est_clave_int'];
    $asistente   =$row['usu_nombre'];
     
    $con= mysqli_query($conectar,"SELECT 
    ast.ast_clave_int,
    usu.usu_clave_int,
    usu.usu_apellido,
    usu.usu_correo,
    usu.usu_nombre
    FROM 
    tbl_comitesasistentes ast
    JOIN tbl_usuarios usu on usu.usu_clave_int = ast.usu_clave_int
    WHERE
    ast.com_clave_int = '".$id."'");

    while($dato = mysqli_fetch_array($con)){
           
        $usucla = $dato['usu_clave_int'];
        $usu = $dato['usu_nombre']." ".$dato['usu_apellido'];
        $ema = $dato['usu_correo'];
        $act = $dato['est_clave_int'];
        
        $asunto1 = "Citación al Comité ".$id."";
        $asunto1 =  "=?ISO-8859-1?B?".base64_encode(utf8_decode($asunto1))."=?=";
        $contenido = file_get_contents('https://www.pavas.com.co/comites/funciones/comites/plantillas/plantilla.php');
        $contenido = str_replace('%titulo%', $txtnombcomite, $contenido);
        $contenido = str_replace('%usunombre%', $usu, $contenido);
        $contenido = str_replace('%fecha%', $fechacom, $contenido);
        $contenido = str_replace('%horaini%', $horainicio, $contenido);

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
            $msn .= 'No se envio mensaje al siguiente email<strong>(' . $ema . ')</strong>' . $mail->ErrorInfo . '<br>';
        }
        else
        {
            $res = "ok";
            $msn = "Su contraseña a sido recuperada satisfactoriamente<br> Por favor revise su correo:".$ema;
        }             
    }   