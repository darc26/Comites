<?php
session_start();
include('../../data/conexion.php');
error_reporting(E);


use  PHPMailer\PHPMailer\PHPMailer;
use  PHPMailer\PHPMailer\Exception;
require ('../../PHPMailer-master/src/PHPMailer.php');
require ('../../PHPMailer-master/src/Exception.php');
require ('../../PHPMailer-master/src/SMTP.php');
//$login     = isset($_SESSION['persona']);
// cookie que almacena el numero de identificacion de la persona logueada
$usuario   = $_COOKIE['usuarioPROYECTO1'];
$idUsuario = $_COOKIE['idusuarioPROYECTO1'];
$perfil    = $_SESSION["perfilPROYECTO1"];
date_default_timezone_set('America/Bogota');
$fecha  = date("Y/m/d H:i:s");
$opcion = $_POST['opcion'];
if($opcion== 'FILTROS'){
    ?>
    <div class="row">
        <div class="col-md-3">
            <label for="">Nombre</label>
            <input type="text" class="form-control " id="busNombre" placeholder="Buscar un nombre">
        </div>
    
        <div class="col-md-3">
        <label for="">Apellido</label>
            <input type="text" class="form-control " id="busapellido" placeholder="Buscar un apellido">
        </div>
  
        <div class="col-md-3">
            <label for="">Correo Eléctronico</label>
            <input type="text" class="form-control " id="buscorreo" placeholder="Buscar un correo">
        </div>
        <div class="col-md-3">
            <label for="">Buscar Perfil</label>
            <select class="selectpicker" id="busperfil" multiple data-actions-box="true" data-live-search="true" title="Selecione un perfil" onchange=" CRUDUSUARIOS('LISTAUSUARIOS','')">
           
            <?php
                $query ="SELECT * from tbl_perfil where est_clave_int = 1 or prf_clave_int = '$selperfil' ";
                $result= mysqli_query($conectar,$query);
                if( !$result ){
                    die('fail'.mysqli_error($conectar));
                }

                while ($row = mysqli_fetch_array($result)) {
                    
                    ?>
                    <option <?php if ($row['prf_clave_int'] == $selperfil) { echo 'selected';} ?> value="<?php echo $row['prf_clave_int']; ?>"><?php echo $row['prf_descripcion']; ?></option>
                    <?php
                }
            ?>
            </select>

        </div>
    </div>
    <script>
        $('#busNombre').on('keyup',function(e){
            if(e.which==13)
            {
                CRUDUSUARIOS('LISTAUSUARIOS','')
            }
        }) 
        $('#busapellido').on('keyup',function(e){
            if(e.which==13)
            {
                CRUDUSUARIOS('LISTAUSUARIOS','')
            }
        }) 
        $('#buscorreo').on('keyup',function(e){
            if(e.which==13)
            {
                CRUDUSUARIOS('LISTAUSUARIOS','')
            }
        }) 
        



    </script>

    <?php
   echo "<script> INICIALIZARCONTENIDO()</script>";
   echo "<script> CRUDUSUARIOS('LISTAUSUARIOS','')</script>";
}else if($opcion == "LISTAUSUARIOS"){
    include("../../data/validarpermisos.php");
    ?>
    
    <table id="tbusuarios" class="table table-bordered table-striped " data-edit="<?php echo $p3?>" data-elim="<?php echo $p8?>"  data-perm="<?php echo $p1?>" >
            <thead>
                <tr>
                    
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Nombre de usuario</th>
                    <th>Perfil</th>
                    <th>Estado</th>
                    <th></th>
                    <th></th> 
                    <th></th> 
                </tr>
            </thead>
            <tbody>
               
            </tbody>
            <tfoot>
                <tr>
                    
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th> 
                    <th></th>
                    <th></th> 
                    <th></th> 
                    
                </tr>
            </tfoot>
        </table>
        <script src="jsdatatable/usuarios/jslistausuarios.js?<?php echo time(); ?>"></script>
    <?php
 
    
  
}else if($opcion == "NUEVO" || $opcion=="EDITAR" || $opcion=="EDITARUSUARIO"){
    $id = $_POST['id'];
    $idu = $_POST['idu'];
    $query = "SELECT * from tbl_usuarios WHERE usu_clave_int= $id";

    $result= mysqli_query($conectar, $query);
    $row = mysqli_fetch_array($result);
    $txtnombre = $row['usu_nombre'];
    $txtapellido= $row['usu_apellido'];
    $txtemail = $row['usu_correo'];
    $txtperfil= $row['usu_imagen'];
    $txtcontrasena = $row[ 'usu_contrasena'];
    $txtcontrasena =decrypt( $txtcontrasena,'usuarios' );
    $txtusuario = $row['usu_usuario'];
    $selperfil = $row['prf_clave_int'];
    $est = $row['est_clave_int'];
    $opc=$_POST['opc'];

    if($opc==2)
    {
        $v1 = "";
        $v2 = "";
        $v3 = "";
        $v4 = "hide";
        $v5 = "hide";
        $v6 = "hide";
        $v7 = "hide";
        $v8 = "hide";

        $r1 = "required";
        $r2 = "required";
        $r3 = "required";
        $r4 = "";
        $r5 = "";
        $r6 = "";
        $r7 = "";
        $r2 = "";
    }

    if( $opcion=="EDITARUSUARIO"){
        $v7 = "hide";
    }



    ?>
    <div class="card card-primary">     
        <!-- form start -->
        <form id="frmusuario" role="form" data-parsley-validate>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6 <?php echo $v1;?>">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control form-control-sm" id="txtnombre" placeholder="Escribe tu Nombre " data-parsley-error-message="Se requiere un nombre" value="<?php echo $txtnombre; ?>" <?php echo $r1;?>>
                    </div>
                    <div class="form-group col-md-6 <?php echo $v2;?>">
                        <label for="exampleInputEmail1">Apellido</label>
                        <input type="text" class="form-control form-control-sm" id="txtapellido" placeholder="Escribe tu Apellido " data-parsley-error-message="Se requiere un apellido" value="<?php echo $txtapellido; ?>" <?php echo $r2;?>>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 <?php echo $v3;?>">
                        <label for="exampleInputPassword1">Correo Electrónico</label>
                        <input type="email" class="form-control form-control-sm" id="txtemail" placeholder="Escribe un Correo" data-parsley-error-message="Se requiere un correo" value="<?php echo $txtemail; ?>" <?php echo $r3;?>>
                    </div>
                    <div class="form-group col-md-6 <?php echo $v4;?>">
                        <label for="exampleInputEmail1">Nombre de Usuario</label>
                        <input type="text" class="form-control form-control-sm" id="txtusuario" placeholder="Escribe un Usuario" data-parsley-error-message="Se requiere un nombre de uusuario" value="<?php echo $txtusuario; ?>"<?php echo $r4;?>>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 <?php echo $v5;?>">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="check-seguridad form-control form-control-sm" id="txtcontrasena" placeholder="Agrega una Contraseña" data-parsley-error-message="Se requiere una contraseña " value="<?php echo $txtcontrasena; ?>" <?php echo $r5;?>>
                    </div>
                    <div class="form-group col-md-6 <?php echo $v6;?>">
                        <label for="exampleInputPassword1">Verificacion de Contraseña</label>
                        <input type="password" class="check-seguridad form-control form-control-sm" id="txtverificar" placeholder="Verifica la Contraseña" data-parsley-equalto="#txtcontrasena" value="<?php echo $txtcontrasena; ?>" <?php echo $r6;?>>
                    </div>
                </div>
                
            
            
                <div class="form-group  <?php echo $v7;?>">
                    <label>Perfil</label>
                    <select class="form-control form-control-sm" id="selperfil" data-parsley-errors-container="#error1" <?php echo $r7;?>>
                        <option value="" >--Seleccione perfil--</option>
                        <?php
                        $query ="SELECT * from tbl_perfil where est_clave_int = 1 or prf_clave_int = '$selperfil' ";
                        $result= mysqli_query($conectar,$query);
                        if( !$result ){
                            die('fail'.mysqli_error($conectar));
                        }

                        while ($row = mysqli_fetch_array($result)) {
                            
                            ?>
                            <option <?php if ($row['prf_clave_int'] == $selperfil ||  $selperfil== "") { echo 'selected';}
                            ?> value="<?php echo $row['prf_clave_int']; ?>"><?php echo $row['prf_descripcion']; ?></option>
                            <?php
                        }
                        ?>
                        
                    </select>
                    <span id="error1"></span>
                </div>
                
                <div class="form-group col-sm-4 <?php echo $v8;?>">
                    <label>Foto de Perfil</label>
                    <input onchange="setpreview('rutaperfil','txtperfil','frmusuario', 'tmp')" type="file" class="dropify" data-height="100" id="txtperfil" placeholder="Agrega Tu foto de perfil" data-parsley-error-message="Se requiere un producto" data-default-file="<?php echo $txtperfil; ?>" <?php echo $r8;?>>
                    <span data-no="0" id="rutaperfil" data-url="<?php echo $txtperfil; ?>"></span>
                </div>
                
                


                <div class="btn-group btn-group-toggle hide" data-toggle="buttons">
                    <label class="btn bg-olive <?php if ($est != 0|| $est == "") { echo 'active';} ?>">
                        <input type="radio"  id="option1" name="radestado" autocomplete="off" value="1" <?php if ($est != 0 || $est == "") { echo 'checked';} ?>> Activo
                    </label>
                    <label class="btn bg-olive <?php if ($est === 0) { echo 'active';} ?>">
                        <input type="radio"  id="option2" name="radestado" autocomplete="off" value="0" <?php if ($est === 0) { echo 'checked';} ?>> Inactivo
                    </label>
                </div>
            
            </div>  
                <?php

                if($opc==2){
                    ?>
                    
                    <div class="form-group mr-3 float-right hide ">
                    <button type="button" class="btn btn-primary " onclick="CRUDUSUARIOS('GUARDAR','','2')">Guardar</button>
                    </div>
                    <?php
                }

                ?>     
                
            </div>

        </form>
    </div>
    <script >

    var drEvent = $('#txtperfil').dropify();

    drEvent.on('dropify.beforeClear', function(event, element){
        $('#rutaperfil').attr('data-no',1);
    });
    </script>
        

    <?php 
  echo "<script> INICIALIZARCONTENIDO()</script>";
  echo "<script> CONTRASENASEGURA()</script>";

}else if($opcion == "GUARDAR") {
    
    $txtnombre = $_POST['txtnombre'];
    $txtapellido = $_POST['txtapellido'];
    $txtemail = $_POST['txtemail'];
    $txtcontrasena = $_POST['txtcontrasena'];
    $txtusuario = $_POST['txtusuario'];
    $selperfil = $_POST['selperfil'];
    $txtperfil= $_POST['txtperfil'];
    $est = $_POST['est'];
    $idc = $_POST['idc'];//IDCOMITE
    $trozos = explode(".",$txtperfil);
    $ext = end($trozos);
    $rutaant=$_POST['rutaant'];
    $txtcontrasena =encrypt( $txtcontrasena,'usuarios' );

    $ver = mysqli_query($conectar,"SELECT * from tbl_usuarios where(  usu_correo= '".$txtemail."') AND est_clave_int!= 2");
    $num = mysqli_num_rows($ver);
    


    if ($num>0) {
        $res = "error";
        $msn = "Ya hay un usuario con el correo electronico ingresado. Verificar";
    }else{
        $query = " INSERT INTO  tbl_usuarios(usu_nombre, usu_apellido, usu_correo, usu_contrasena, usu_usuario, prf_clave_int, usu_usu_actualiz,usu_fec_actualiz,est_clave_int) VALUE ('$txtnombre','$txtapellido','$txtemail','$txtcontrasena','$txtusuario','$selperfil','$usuario','$fecha','$est' )";
        
        $result= mysqli_query($conectar, $query);

        $idusus= mysqli_insert_id($conectar);
        $time= time();
        $rutaNueva= 'modulos/usuarios/img/'.$idusus.'_'.$time.'.'.$ext;


        if (!$result) {
            $res = "error";
            $msn=die('fail'.mysqli_error($conectar));

        } else {
            $idusu = mysqli_insert_id($conectar);
            if($idc>0 and $idusu>0)
            {
                $insas = mysqli_query($conectar, "INSERT INTO tbl_comitesasistentes (com_clave_int, usu_clave_int) VALUES('".$idc."','".$idusu."')");
            }

            if(rename("../../".$txtperfil,"../../".$rutaNueva ))
            {
                $query= "UPDATE tbl_usuarios set usu_imagen= '$rutaNueva' WHERE usu_clave_int =  '".$idusu."'";
                $result= mysqli_query($conectar,$query);
                unlink('../../$rutaold');
    
                if (!$result>0) {
                    $res= "error";
                    $msn=die('fail'.mysqli_error($conectar));
                } else {
                $res= "ok";
                $msn="Imagen modificados correctamente";
                }
                
            }
            

            $perm = mysqli_query($conectar,"INSERT INTO tbl_permisos_usuarios( per_clave_int, usu_clave_int) SELECT per_clave_int,'".$idusu."' FROM tbl_permisos_perfil where prf_clave_int = '".$selperfil."'");
            
            $res = "ok";
            $msn = "Datos guardados correctamente";

        }
    }

    $datos[]= array("res"=>$res,"msn"=>$msn,'idu'=>$idusus);
    echo json_encode($datos);
    
}else if($opcion == "GUARDAREDICION"){
    $no=$_POST['no'];
    $id = $_POST['id'];
    $txtnombre = $_POST['txtnombre'];
    $txtapellido = $_POST['txtapellido'];
    $txtemail = $_POST['txtemail'];
    $txtcontrasena = $_POST['txtcontrasena'];
    $txtusuario = $_POST['txtusuario'];
    $selperfil = $_POST['selperfil'];
    $txtperfil= $_POST['txtperfil'];
    $est = $_POST['est'];
    $trozos = explode(".",$txtperfil);
    $ext = end($trozos);
    $rutaant=$_POST['rutaant'];
    $txtcontrasena =encrypt( $txtcontrasena,'usuarios' );
    

    $ver = mysqli_query($conectar,"SELECT * from tbl_usuarios WHERE ( usu_correo ='".$txtemail."') and usu_clave_int!='".$id."' AND est_clave_int!= 2");
    $num = mysqli_num_rows($ver);

    $time= time();
    $rutaNueva= 'modulos/usuarios/img/'.$id.'_'.$time.'.'.$ext;

    if ($num>0) {
        $res = "error";
        $msn = "Ya hay un usuario con el correo electronico ingresado. Verifica";
    } else {
      $query ="UPDATE tbl_usuarios SET usu_nombre='$txtnombre',usu_apellido='$txtapellido',est_clave_int='$est',usu_correo='$txtemail',usu_contrasena = '$txtcontrasena', usu_usuario = '$txtusuario',prf_clave_int = '$selperfil' , usu_usu_actualiz='$usuario', usu_fec_actualiz='$fecha' WHERE  usu_clave_int  ='".$id."'";
    
        $result= mysqli_query($conectar,$query);



        if (!$result>0) {
            $res= "error";
            $msn=die('fail'.mysqli_error($conectar));
        } else {

            if(rename("../../".$txtperfil,"../../".$rutaNueva )and $txtperfil!="")
            {
                $query= "UPDATE tbl_usuarios set usu_imagen= '$rutaNueva' WHERE usu_clave_int =  '".$id."'";
                
               
                $result= mysqli_query($conectar,$query);
               
    
                if (!$result>0) {
                    $res= "error";
                    $msn=die('fail'.mysqli_error($conectar));
                } else { 
                    setcookie("imgPROYECTO1",$rutaNueva, time() + (86400) , "/");//1 dia
                    unlink('../../'.$rutaant);
                $res= "ok";
                $msn="Imagen modificados correctamente";
                }
                
            }else if($no==1 and $txtperfil==''){

                $query=mysqli_query($conectar,"UPDATE tbl_usuarios set usu_imagen= '' WHERE usu_clave_int = '".$id."'");
                $rutaNueva= '';
                unlink('../../'.$rutaant);
               
            }
            
            $res= "ok";
            $msn="Datos modificados correctamente";
        }
    }

    if($id!=$idUsuario){
        $rutaNueva="";
    }
    $datos[]= array("res"=>$res,"msn"=>$msn,"imguser"=>$rutaNueva);
    echo json_encode($datos);  

}else if($opcion == "ELIMINAR"){
   
    $id = $_POST['id'];

    $con=mysqli_query($conectar, "UPDATE tbl_usuarios set est_clave_int= 2 WHERE usu_clave_int= $id");
    
    
    if($con>0){
        $res = "ok";
        $msn = "El usuario se a eliminado correctamente";
    }else{
        $res = "error";
        $msn = "No se pudo eliminar este usuario";
    }
    $datos[] = array( "res"=> $res, "msn"=> $msn);
    echo json_encode($datos);

}else if($opcion=="RECUPERARCONTRASENA"){
    //header("Cache-Control: no-store, no-cache, must-revalidate");   
    $email = $_POST['email'];
    $con = mysqli_query($conectar,"select * from tbl_usuarios where usu_correo = '".$email."' and est_clave_int =1 limit 1");
    $dato = mysqli_fetch_array($con);
    $usucla = $dato['usu_clave_int'];
    $usu = $dato['usu_nombre']." ".$dato['usu_apellido'];
    $ema = $dato['usu_correo'];
    $act = $dato['est_clave_int'];
    $con = mysqli_query($conectar,"select * from tbl_recuperar where usu_clave_int = '".$usucla."' and rec_estado = 0");
    $num = mysqli_num_rows($con);
    if($num > 0)
    {
        $dato = mysqli_fetch_array($con);
        $random = $dato['rec_codigo'];
    }
    else
    {
        $length = 50;
        $random = "";
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; // change to whatever characters you want
        while ($length > 0) {
        $random .= $characters[mt_rand(0,strlen($characters)-1)];
        $length -= 1;
        }
        $con = mysqli_query($conectar,"insert into tbl_recuperar(rec_codigo,usu_clave_int,rec_estado) values('".$random."','".$usucla."','0')");
    }
    if($email != '')
    {
        if(($ema == $email))
        {
            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            $asunto1 = "Recuperar Clave CONTROL ACTAS Y COMITÉS";
            $asunto1 =  "=?ISO-8859-1?B?".base64_encode(utf8_decode($asunto1))."=?=";
            $mensaje= "<strong>Hola</strong>, ".$usu."!<br><br>";
            $mensaje.= "CONTROL ACTAS Y COMITÉS registra que has hecho una solicitud de recuperacion de contraseña.<br>";
            $mensaje.= "Para restablecer su contrasena, solo debes presionar clic en el siguiente enlace o copielo y peguelo en la barra de direcciones de su navegador:<br>";
            $mensaje.= "<strong>Fecha: </strong>".date("d/m/Y H:m:s")."<br><br>";
            $mensaje.= "<a href='https://www.pavas.com.co/PROYECTO1/recover_password.php?codigo=".$random."' target='_blank'>Click aqui </a>";
            //Nuestra cuenta
            $mail->SetFrom("andres.199207@gmail.com", "CONTROL ACTAS Y COMITÉS");
            //Usamos el AddReplyTo para decirle al script a quien tiene que responder el correo
            $mail->AddReplyTo("adminpavas@pavas.com.co","CONTROL ACTAS Y COMITÉS");
            $mail->addAddress($ema, "Usuario: " . $usu);
            $mail->Subject = utf8_decode($asunto1);
            $mail->msgHTML($mensaje);
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
        else
        {
            $res=  "error";
            $msn = "Correo electronico incorrecto";
        }
    }
    else
    {
            $res =  "error";
            $msn = "Correo electronico incorrecto";
    }
    $datos[] = array("res"=>$res,"msn"=>$msn);
    echo json_encode($datos);
}else if($opcion=="RESTABLECER"){
    $cod = $_POST['cod'];
    $con1 = $_POST['con1'];
    $con2 = $_POST['con2'];
    
    $con = mysqli_query($conectar,"select * from tbl_recuperar where rec_codigo = '".$cod."' and rec_estado = 1");
    $num = mysqli_num_rows($con);
    
    if($num > 0)
    {
        $res = "error";
        $msn = "Este codigo ya fue usado anteriormente";
    }
    else
    {
        if($con1 == $con2)
        {
            $con1= encrypt($con1,'usuarios');
            $con = mysqli_query($conectar,"SELECT u.usu_clave_int, u.usu_correo from tbl_recuperar r  join tbl_usuarios u on  u.usu_clave_int= r.usu_clave_int  where rec_codigo = '".$cod."'");
            $dato = mysqli_fetch_array($con);
            $usu = $dato['usu_clave_int'];
            $ema = $dato['usu_correo'];           
            $update = mysqli_query($conectar,"UPDATE tbl_usuarios SET usu_contrasena = '".$con1."' where usu_clave_int = '".$usu."'");
            
            if($update >0)
            { 
                $con = mysqli_query($conectar,"UPDATE tbl_recuperar set rec_estado = 1 where rec_codigo = '".$cod."'");
                $res = "ok";
                $msn  = "Su contraseña a sido restablecida correctamente!</div>";
            }
            else
            {
                $res = "error";
                $msn =  "Error al restablecer la contraseña";
            }
        }
        else
        {
            $res = "error";
            $msn = "Las contraseñas no coinciden>";
        }
    }
    $datos[] = array("res"=>$res,"msn"=>$msn,"ema"=>$ema);
    echo json_encode($datos);
}else if($opcion=='ASIGNARPERMISOS'){
    $idu=$_POST['id'];
    $conn=mysqli_query($conectar,"SELECT mod_clave_int, mod_descripcion FROM tbl_modulos");
    $numu=mysqli_num_rows($conn);
    ?>           
    <div class="row">
        <div class="col-7 col-sm-9">
            <div class="tab-content" id="vert-tabs-right-tabContent">       
                <div class="tab-pane fade show active" id="divpermisos" role="tabpanel" aria-labelledby="vert-tabs-right"></div>
            </div>
        </div>
        <div class="col-5 col-sm-3">
            <div class="nav flex-column nav-tabs nav-tabs-right h-100" id="vert-tabs-right-tab" role="tablist" aria-orientation="vertical">
            <?PHP 
                for($i=0;$i<$numu;$i++)
                {
                $dato = mysqli_fetch_array($conn);
                $idmo=$dato['mod_clave_int'];
                $nommo=$dato['mod_descripcion'];
                $idmod[]=$idmo;
                $nommod[]=$nommo;            
                ?>
                <a class="nav-link " id="vert-tabs-right-" data-toggle="pill" data-target="#divpermisos"  role="tab" aria-controls="vert-tabs-right-home" aria-selected="true"  onclick="CRUDUSUARIOS('LISTAPERMISOS','<?php echo $idu;?>','<?php echo $idmod[$i];?>')"><?php echo $nommod[$i];?></a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php echo "<script>CRUDUSUARIOS('LISTAPERMISOS','".$idu."','1');</script>";
}else if($opcion=='GUARDARPERMISOS'){
    $idp=$_POST['idp'];
    $idu=$_POST['idu'];

    $ver= mysqli_query($conectar,"SELECT * FROM tbl_permisos_usuarios WHERE per_clave_int = '".$idp."' and usu_clave_int = '".$idu."'");
    $numv= mysqli_num_rows($ver);

    if($numv>0){
        $sql= mysqli_query($conectar,"DELETE FROM tbl_permisos_usuarios WHERE  per_clave_int = '".$idp."' and usu_clave_int = '".$idu."'");
    }else{
        $sql= mysqli_query($conectar,"INSERT INTO tbl_permisos_usuarios (per_clave_int,usu_clave_int,peu_usu_actualiz,peu_fec_actualiz)VALUE ( '".$idp."', '".$idu."', '".$usuario."', '".$fecha."') ");

    } 
    if(!$sql){
        $res = "error";
        $msn =die('fail'.mysqli_error($conectar));
    } else {
        $res = "ok";
        $msn = "Datos  guardados correctamente";
    }
    $datos[]= array("res"=>$res,"msn"=>$msn);
    echo json_encode($datos);
}else if($opcion=='LISTAPERMISOS'){
    $idu=$_POST['id'];
    $ven=$_POST['ven'];

    $con= mysqli_query($conectar,"SELECT per_clave_int, per_descripcion FROM tbl_permisos Where mod_clave_int= '".$ven."'");
    $num= mysqli_num_rows($con);


    for($i=0;$i<$num;$i++)
    {
        $data=mysqli_fetch_array($con);
        $descrip=$data['per_descripcion'];
        $idp=$data['per_clave_int'];


        $verf = mysqli_query($conectar," SELECT * FROM tbl_permisos_usuarios WHERE  per_clave_int = '".$idp."' and usu_clave_int = '".$idu."'");
        $numus= mysqli_num_rows($verf);
        ?>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <ul class="to_do">
                <li>
                    <p>
                    <input  <?php if($numus>0){ echo 'checked';} ?> type="checkbox"  onclick="CRUDUSUARIOS('GUARDARPERMISOS','<?php echo $idp;?>','<?php echo $idu; ?>')">  <?php  echo $descrip  ?>
                    </p>
                </li>
            </ul>
        </div>
    <?php
    }
}