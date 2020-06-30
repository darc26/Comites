<?php
session_start();
include('../../data/conexion.php');
error_reporting(0);
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
      
        <div class="col-sm-2">
            <label for="">N° Comite</label>
            <input type="text" class="form-control" id="buscomite" placeholder="Buscar N° Comite">
        </div>
        <div class="col-sm-2">
            <label for="">Nombre del comité</label>
            <input type="text" class="form-control" id="busnombre" placeholder="Buscar un nombre">
        </div>
        <div class="col-sm-2">
            <label for="">Fecha desde</label>
            <input type="date" class="form-control" id="busfecha1"  name="busfecha1" placeholder="<?php echo date("Y-m-d") ?> ">
        </div>    
        <div class="col-sm-2">
            <label for="">Fecha hasta</label>
            <input type="date" class="form-control" id="busfecha2"  name="busfecha2"  placeholder="<?php echo date("Y-m-d") ?>">
        </div> 
           
        <div class="col-sm-1">
            <label for="">Estado</label>
            <select class="selectpicker" multiple  data-live-search="true"  id="busestado" title="Selecione un estado" onchange=" CRUDCOMITES('LISTACOMITES','')">             
                <option  value="1">En proceso</option>
                <option  value="0">Cerrado</option>
            </select>
        </div>
    </div>
    <script>
        $('#buscomite').on('keyup',function(e){
            if(e.which==13)
            {
                CRUDCOMITES('LISTACOMITES','')
            }
        }) 
        $('#bustema').on('keyup',function(e){
            if(e.which==13)
            {
                CRUDCOMITES('LISTACOMITES','')
            }
        }) 
        $('#busestado').on('keyup',function(e){
            if(e.which==13)
            {
                CRUDCOMITES('LISTACOMITES','')
            }
        }) 
        $('#busfecha1').on('keyup',function(e){
            if(e.which==13)
            {
                CRUDCOMITES('LISTACOMITES','')
            }
        }) 
        $('#busfecha2').on('keyup',function(e){
            if(e.which==13)
            {
                CRUDCOMITES('LISTACOMITES','')
            }
        })
        $('#busnombre').on('keyup',function(e){
            if(e.which==13)
            {
                CRUDCOMITES('LISTACOMITES','')
            }
        }) 
    </script>

    <?php
   echo "<script> INICIALIZARCONTENIDO()</script>";
   echo "<script> CRUDCOMITES('LISTACOMITES','')</script>";
}else if($opcion == "LISTACOMITES" || $opcion== "LISTACOMITESMES"){
    $est=$_POST['est'];
    include("../../data/validarpermisos.php");
    ?>
    <table id="tbcomite" class="table table-bordered table-striped" data-estado="<?php echo $est?>"  data-opcion="<?php echo $opcion?>" data-edit="<?php echo $p11?>" data-elim="<?php echo $p12?>">
        <thead>
            <tr>
                <th></th>
                <th>N° Comite</th>
                <th>Nombre </th>
                <th>Fecha</th>
                <th>Hora de inicio</th> 
                <th>Hora final</th>               
                <th>Estado</th>
                <th>Motivo</th>
                <th>Fecha de anulación</th>               
                <th  style="width: 9px;"></th>
                <th  style="width: 9px;"></th> 
                <th  style="width: 9px;"></th> 
                
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
                <th></th>   
                <th></th> 
                <th></th>          
            </tr>
        </tfoot>
    </table>
        <script src="jsdatatable/comites/jslistacomites.js?<?php echo time(); ?>"></script>
    <?php
}else if($opcion == "NUEVO" || $opcion=="EDITAR"){
    $id = $_POST['id'];
    $query = $result= mysqli_query($conectar,"SELECT * from tbl_comites  WHERE com_clave_int= $id");  
    $row = mysqli_fetch_array($query);
    $txtnombcomite = $row['com_nombre'];
    $fechacom = $row['com_fecha'];
    $horainicio = $row[ 'com_hora_inicio'];
    $horafin = $row['com_hora_fin'];
    $txtdesarrollo = $row['com_tema'];
    $est = $row['est_clave_int'];
    $asistente   =$row['usu_nombre'];
    
    if($horainicio== ""){
        $horainicio = date("H:i");
    }
    if($horafin== ""){
        $horafin = date("H:i");
    }
    if($fechacom== ""){
        $fechacom = date("Y-m-d");
    }  
    if($fechcumpli== ""){
        $fechcumpli = date("");
    } 
    if($opcion=="EDITAR"){
        if($est==3 || $est==2){
            $vis="disabled";
        }
    }

    $query = $result= mysqli_query($conectar,"SELECT * from tbl_comites WHERE com_clave_int= $id");  
    echo "<script> INICIALIZARCONTENIDO()</script>";
    ?>
    <div class="card card-primary"  >     
        <form  id="frmcomite" role="form" class="form-horizontal"  data-parsley-validate>           
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="txtnombcomite">Nombre de comite:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="txtnombcomite" placeholder="Agrega el nombre del comite" data-parsley-error-message="Se requiere el nombre del acta" value="<?php echo $txtnombcomite; ?>" required  <?php echo $vis;?>>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Fecha:</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" id="fechacom"  data-parsley-error-message="Se requiere una fecha" value="<?php echo $fechacom ?>" required <?php echo $vis;?>>
                </div>        
                <label class="col-sm-2 col-form-label">Hora de inicio:</label>                
                <div class="col-sm-2">
                    <input type="time" class="form-control" id="horainicio" data-parsley-error-message="Se requiere un Hora de inicio" value="<?php echo $horainicio ?>" required <?php echo $vis;?>>
                </div>               
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Participantes:</label>
                <div class="col-sm-10">
                    <div class="input-group mb-3">
                    <select class="form-control selectpicker" name="asistente" id="asistente" onchange="CRUDCOMITES('CARGARRESPONSABLES')" data-parsley-errors-container="#error1" multiple data-actions-box="true" data-live-search="true" title="Selecione los participantes"   required <?php echo $vis;?>>
                        <?php
                        $con = mysqli_query($conectar, "SELECT * from tbl_usuarios u inner 0 tbl_perfil p on (p.prf_clave_int = u.prf_clave_int) where  p.prf_clave_int IN (0,1,2,4,6,7,8,9,12) and u.est_clave_int = 1 order by u.usu_nombre");
                        $num = mysqli_num_rows($con);

                        for($i = 0; $i < $num; $i++) {
                            $dato = mysqli_fetch_array($con);
                            $clave = $dato['usu_clave_int'];
                            $usu = $dato['usu_nombre']." ".$dato['usu_apellido'];
                            $ema= $dato['usu_correo'];
                            $usutec = $dato['usu_usuario'];
                            $prf = $dato['prf_descripcion'];

                            $conn = mysqli_query($conectar,"SELECT
                            a.ast_clave_int,
                            a.com_clave_int,
                            a.usu_clave_int                           
                            FROM  tbl_comitesasistentes a
                            where a.com_clave_int= '".$id."' and  a.usu_clave_int = '".$clave."'and a.est_clave_int = 1");
                            $numv= mysqli_num_rows($conn);

                        ?>
                        <option <?php if ($numv>0 ) { echo 'selected';}?>  value="<?php echo $clave; ?>"  data-tokens="<?php echo $usu. " - " . $prf; ?> "  data-subtext="<?php echo $ema; ?>"> <?php echo $usu. " - " . $prf; ?> </option>
                        <?php
                        }
                        ?>    
                    </select>
                    <div class="input-group-append">
                        <a class="btn  btnusuario  btn-primary " data-backdrop="static" data-keyboard="false" style="color: white">Nuevo Invitado</i></a>
                    </div>
                    </div>
                    <span id="error1"></span>
                </div>
            </div>
            <div class="form-group row"  >             
                <label class="col-sm-2 col-form-label" >Desarrollo:</label>            
                <div class="col-sm-10">
                    <div class="input-group mb-3" > 
                        <textarea class="textarea"  id="txtdesarrollo" placeholder="Agrega un tema" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" <?php echo $vis;?>></textarea>
                        <div class="input-group-append select"  style="display: none" >
                            <select class="form-control selectpicker" name="" id="asistentesdes"  data-pendiente="<?php //echo $id;?>"   data-actions-box="true" data-live-search="true" <?php echo $vis;?>>
                            
                            </select>
                        </div>
                        <div class="input-group-append select"  style="display: none">
                            <input type="date" class="form-control" id="fechcumpli"  data-parsley-error-message="Se requiere una fecha" value="<?php echo $fechcumpli ?>">
                        </div>
                        <div class="input-group-append select"  style="display: none">
                            <button id="btnguardar4" class="btn btn-outline-secondary" onClick="CRUDCOMITES('GUARDARDESARROLLO','<?PHP echo $id;?>')" type="button"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>               
            </div>
            <div class="form-group col-md-12" id="frmdesarrollo" >                        
                <table id="tbdesarrollo" class="table table-bordered table-striped" data-comites ='<?php echo $id;?>' data-est="<?php echo  $est;?>">
                    <thead>
                        <tr>
                            <th width= "695px">Desarrollo</th>
                            <th width= "136px">Responsable</th>
                            <th width= "86px">Fecha de cumplimiento</th>
                            <th style="width: 9px;"></th>
                            <th style="width: 9px;"></th>

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
                        </tr>
                    </tfoot>
                </table>
                <script src="jsdatatable/comites/jslistaobjetivos.js?<?php echo time(); ?>"></script>
            </div>
            <div class="form-group row ">
                <label class="col-sm-2 col-form-label">Hora de fin:</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" id="horafin"data-parsley-error-message="Se requiere un Hora de fin" value="<?php echo $horafin?>" required <?php echo $vis;?>>
                </div>
            </div>
            <div class="col-md-3 hide">
                <label for="">Estado</label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn bg-olive <?php if ($est != 0 ||$est == "") { echo 'active';} ?>">
                        <input type="radio"  id="options1" name="radestados" autocomplete="off" value="1" <?php if ($est != 0 ||$est == "") { echo 'checked';} ?>> Abierto
                    </label>
                    <label class="btn bg-olive <?php if ($est == 0) { echo 'active';} ?>">
                        <input type="radio"  id="options2" name="radestados" autocomplete="off" value="0" <?php if ($est == 0) { echo 'checked';} ?>> Cerrado
                    </label>
                </div>    
            </div> 
        </form>
    </div>
    <?php
   if($est==3 || $est==2){
    ?><script > 
        $(document).ready(function() {
            $('#btnguardar3').hide()
            $('#btnguardar2').hide()
        });
    </script><?php   
   }

  ?>
    <script>
    
    $(function () {
        // Summernote
        // $('.textarea').summernote({
        //     width: 1000,
        //     tooltip: false,            
        // });
        // $('.textarea').on('summernote.change', function(we, contents, $editable) {
        //     console.log('summernote\'s content is changed.');
        //     var tem = $("#txtdesarrollo").val();
        //     console.log(tem);
        //     if(tem!= ""){
        //         $('.select').show();
        //     }else{
        //         $('.select').hide();
        //     }
        // });
        // var edit = function() {
        //     $('.textarea').summernote({focus: true});
        // };
           
    })

    // $(document).ready(function(){                                    
    //     $("#txtdesarrollo").keydown(function(){
    //         var tem = $(this).val();
    //         if(tem!= ""){
    //             $('.select').show();
    //         }else{
    //             $('.select').hide();
    //         }
    //     });                                   
    // });
    $('.btnusuario').on('click', function(){//{backdrop: 'static', keyboard: false}

        $('#myModal').modal({backdrop: 'static', keyboard: false});
        //$('#myModal').attr('data-backdrop' ,'static', );
        $('#myModal>.modal-dialog').removeClass('modal-lg');
        $('#overlaymodal').css('display','block !important');
        $('#titlemodal').html("Nuevo Invitado" );
        $('#btnguardar').attr('onclick',"CRUDUSUARIOS('GUARDAR','',2)");
        $('#btnguardar').html("Guardar");

        $.post('funciones/usuarios/fnUsuarios.php',{opcion:"NUEVO",opc:2},
            function(data)
            {
            // origin.tooltipster('content',"<div id='divnuevousuario' data-comite = '<?php echo $id;?>'>"+data+"</div>");
                //content:'';

                $('#contentmodal').html(data);
            });

     });
        /*$('.btnusuario').tooltipster({		        
            content:"",
            contentAsHTML: true,
            interactive: true,
            trigger: 'click',
            theme: 'tooltipster-light',
            animation: 'swing',
            minWidth:300,
            multiple: false,
            position: 'left',
            side: [ 'left', 'bottom'],
            functionBefore: function(origin, continueTooltip) {
                continueTooltip();
                $.post('funciones/usuarios/fnUsuarios.php',{opcion:"NUEVO",opc:2},
                function(data)
                {
                    origin.tooltipster('content',"<div id='divnuevousuario' data-comite = '<?php echo $id;?>'>"+data+"</div>");
                    content:'';
                });
            }
        });*/
       //MNO VA AHI POR QUE ENTONCE SI NO GUARDA TB SE LLIMPIA
        /*$(document).ready(function() {
            $('#btnguardar4').click(function() {
                $('#txtdesarrollo').val('');
                $('#fechcumpli').val('');
                $("#asistentesdes").val(0);
                $("#asistentesdes").change();
            });
        });*/
      
      
    </script>
    <?php
    echo "<script>CRUDCOMITES('CARGARRESPONSABLES')</script>";
    echo "<script> INICIALIZARCONTENIDO()</script>";
    echo "<script> TOOLTIPS()</script>";

}else if($opcion == "GUARDAR") {
    $txtnombcomite = $_POST['txtnombcomite'];
    $fechacom = $_POST['fechacom'];
    $horainicio = $_POST['horainicio'];
    $horafin = $_POST['horafin'];
    $est = $_POST['est'];
    $asistentesdes = $_POST['asistentesdes'];
    $asistentes = $_POST['asistentes'];
    $asistentes = implode(",",(array)$asistentes);


    $verif = mysqli_query($conectar,"SELECT * from tbl_comites where com_fecha = '".$fechacom."' and com_hora_inicio='".$horainicio."' and com_hora_fin='".$horafin."'");
    $numv = mysqli_num_rows($verif);

    if( $numv > 0){
        $res = "error";
        $msn = "Ya hay un comite programado para esa hora";
    }
    else
    {
        $query = " INSERT INTO  tbl_comites
        (com_nombre, 
        com_fecha, 
        com_hora_inicio, 
        com_hora_fin, 
        com_usu_actualiz,
        com_fec_actualiz,        
        est_clave_int) 
        VALUE (
            '$txtnombcomite',
            '$fechacom',
            '$horainicio',
            '$horafin',
            '$usuario',
            '$fecha',
            '1' 
        )";
        
        $result= mysqli_query($conectar, $query);
        if (!$result) {
            $res = "error";
            $msn=die('fail'.mysqli_error($conectar));

        } else {
            $idcomite = mysqli_insert_id($conectar);

            //Asosciar desarrollo al comite
            $update = mysqli_query($conectar,"UPDATE tbl_comitesdesarrollo SET com_clave_int = '".$idcomite."',est_clave_int = 1 WHERE est_clave_int = 0 "); 

            //Inserta ASISTENTE
            $insasis = mysqli_query ($conectar,"INSERT into tbl_comitesasistentes (com_clave_int, usu_clave_int , est_clave_int) SELECT '".$idcomite."',usu_clave_int, 1 FROM tbl_usuarios   WHERE usu_clave_int in(".$asistentes.") ");             
           
            if(!$insasis){
                
                $res = "error";
               // $msn =die('fail'.mysqli_error($conectar));
            } else {
                $res = "ok";
                $msn = "Datos  guardados correctamente";
            } 
            
            


            $res = "ok";
            $msn = "Datos guardados correctamente";
        }
    }
    
    $datos[]= array("res"=>$res,"msn"=>$msn,"id"=>$idcomite);
    echo json_encode($datos);
    
}else if($opcion == "GUARDAREDICION"){
    
    $id = $_POST['id'];
    $txtnombcomite = $_POST['txtnombcomite'];
    $fechacom = $_POST['fechacom'];
    $horainicio = $_POST[ 'horainicio'];
    $horafin = $_POST['horafin'];
    $est = $_POST['est'];
    $txtdesarrollo = $_POST['txtdesarrollo'];    
    $asistentesdes = $_POST['asistentesdes']; 
    $asistentes = $_POST['asistentes'];
    $asistentes = implode(",",(array)$asistentes);
     
    $verif = mysqli_query($conectar,"SELECT * from tbl_comites where com_fecha = '".$fechacom."' and com_hora_inicio='".$horainicio."' and com_hora_fin='".$horafin."'");
    $numv = mysqli_num_rows($verif);
    if ($num>0) {
        $res = "error";
        $msn = "Ya hay un usuario con el correo electronico ingresado. Verifica";
    } else {

      $query ="UPDATE tbl_comites SET com_nombre='$txtnombcomite',com_fecha='$fechacom',est_clave_int='1',com_hora_inicio='$horainicio',com_hora_fin = '$horafin', com_usu_actualiz='$usuario', com_fec_actualiz='$fecha' WHERE $id = com_clave_int";
    
        $result= mysqli_query($conectar,$query);

        if (!$result>0) {
            $res= "error";
            $msn=die('fail'.mysqli_error($conectar));
        } else {
            $idcomite = mysqli_insert_id($conectar);

            //Inserta ASISTENTE
            $insasis = mysqli_query ($conectar,"INSERT into tbl_comitesasistentes (com_clave_int, usu_clave_int  , est_clave_int) 
            SELECT '".$id."',usu_clave_int,1 FROM tbl_usuarios  WHERE usu_clave_int in(".$asistentes.") and usu_clave_int not in(select usu_clave_int from tbl_comitesasistentes where com_clave_int = '".$id."')");             
        
            if(!$insasis){
 
                $res = "error";
            // $msn =die('fail'.mysqli_error($conectar));
            } else {
                
                $delsel = mysqli_query($conectar, "DELETE FROM tbl_comitesasistentes WHERE com_clave_int = '".$id."' and usu_clave_int not in(".$asistentes.")");
                
            }         
            $res= "ok";
            $msn="Datos modificados correctamente";
           
        }
    }
    $datos[]= array("res"=>$res,"msn"=>$msn,"id"=>$id);
    echo json_encode($datos);  

}else if($opcion == "ELIMINAR"){
    $id = $_POST['id'];
    $motivo=$_POST['motivo'];

    
        $con=mysqli_query($conectar, "UPDATE tbl_comites set est_clave_int= 2 ,com_motivo='".$motivo."',com_fec_eliminacion='".$fecha."' WHERE com_clave_int= $id");
        
        
        if($con>0){
            $res = "ok";
            $msn = "El pedido se a eliminado correctamente";
        }else{
            $res = "error";
            $msn = "No se pudo eliminar este pedido";
        }
        $datos[] = array( "res"=> $res, "msn"=> $msn);
        echo json_encode($datos);

}else if($opcion == "GUARDARDESARROLLO"){
    $idcomite=$_POST['id'];    
    $txtdesarrollo = $_POST['txtdesarrollo'];    
    $asistentesdes = $_POST['asistentesdes']; 
    $fechcumpli= $_POST['fechcumpli']; 


    if($idcomite>0){
        $query="INSERT INTO tbl_comitesdesarrollo(com_clave_int,obc_desarrollo,est_clave_int,obc_fechcumpli, usu_clave_int) VALUE ('".$idcomite."', '" . $txtdesarrollo."', 1,'".$fechcumpli."', '".$asistentesdes."')"; 
    }else{
        $query="INSERT INTO tbl_comitesdesarrollo(com_clave_int,obc_desarrollo,est_clave_int,obc_fechcumpli, usu_clave_int) VALUE ('".$idcomite."', '" . $txtdesarrollo."', 0, '".$fechcumpli."','".$asistentesdes."')"; 
    }
    
 
  
    $result= mysqli_query($conectar, $query);
    if (!$result) {
    $res = "error";
    $msn=die('fail'.mysqli_error($conectar));

    } else {
  
        $res = "ok";
        $msn = "Datos guardados correctamente";
    }


    $datos[]= array("res"=>$res,"msn"=>$msn,"idc"=>$idcomite);
    echo json_encode($datos);
}else if($opcion == "MODIFICARDESARROLLO"){
    $idcomite=$_POST['id'];    
    $txtdesarrollo = $_POST['txtdesarrollo'];    
    $asistentesdes = $_POST['asistentesdes']; 
    $fechcumpli= $_POST['fechcumpli']; 

    if($idcomite>0){
        $query="UPDATE  tbl_comitesdesarrollo SET com_clave_int = '".$idcomite."',obc_desarrollo =  '" . $txtdesarrollo."',est_clave_int= 1,obc_fechcumpli='".$fechcumpli."', usu_clave_int ='".$asistentesdes."' WHERE com_clave_int = '".$idcomite."'"; 
    }else{
        $query="UPDATE  tbl_comitesdesarrollo SET com_clave_int = '".$idcomite."',obc_desarrollo =  '" . $txtdesarrollo."',est_clave_int= 0,obc_fechcumpli='".$fechcumpli."', usu_clave_int ='".$asistentesdes."' WHERE com_clave_int = '".$idcomite."'"; 
    }
 
    $result= mysqli_query($conectar, $query);
    if (!$result) {
    $res = "error";
    $msn=die('fail'.mysqli_error($conectar));

    } else {
  
        $res = "ok";
        $msn = "Datos guardados correctamente";
    }

    $datos[]= array("res"=>$res,"msn"=>$msn,"idc"=>$idcomite);
    echo json_encode($datos);
}else if($opcion == "ELIMINARASISTENTES"){
    $id = $_POST['id'];
    
        $con=mysqli_query($conectar, "UPDATE tbl_comitesasistentes set est_clave_int= 2 WHERE ast_clave_int= $id");
        
        
        if($con>0){
            $res = "ok";
            $msn = "Asistente se a eliminado correctamente";
        }else{
            $res = "error";
            $msn = "No se pudo eliminar este asistente";
        }
        $datos[] = array( "res"=> $res, "msn"=> $msn);
        echo json_encode($datos);

}else if($opcion == "ELIMINARDESARROLLO"){
    $id = $_POST['id'];
    
        $con=mysqli_query($conectar, "UPDATE tbl_comitesdesarrollo set est_clave_int= 2 WHERE obc_clave_int= $id");
        
        
        if($con>0){
            $res = "ok";
            $msn = "Desarrrollo se a eliminado correctamente";
        }else{
            $res = "error";
            $msn = "No se pudo eliminar este Desarrrollo";
        }
        $datos[] = array( "res"=> $res, "msn"=> $msn);
        echo json_encode($datos);

}else if($opcion == "CARGARUSUARIOS"){
   
    $id = $_POST['id'];
    $sel = $_POST['sel'];
    $idu = $_POST['idu'];

    $sql = mysqli_query($conectar, "SELECT * from 
    tbl_usuarios u 
    inner join tbl_perfil p on (p.prf_clave_int = u.prf_clave_int) 
    where u.est_clave_int = 1 order by u.usu_nombre");

    $num = mysqli_num_rows($sql);
    
    if ($num>0){
        while($dat = mysqli_fetch_array($sql)){ 

            $clave = $dat['usu_clave_int'];
            $usu = $dat['usu_nombre']." ".$dat['usu_apellido'];
            $usutec = $dat['usu_usuario'];
            $prf = $dat['prf_descripcion'];
            $ema= $dat['usu_correo'];
            $conn = mysqli_query($conectar,"SELECT
            a.ast_clave_int,
            a.com_clave_int,
            a.usu_clave_int                           
            FROM  tbl_comitesasistentes a
            where a.com_clave_int= '".$id."' and  a.usu_clave_int = '".$clave."' ");
            $numv= mysqli_num_rows($conn);
            
            if($numv>0 || in_array($clave,$sel) ||$idu==$clave){
                $datos[]= array("id"=>$clave,"ema"=>$ema,"usunombre"=>$usu,"prperfil"=>$prf,"res"=>"si","select"=>"selected" );
            }else{
                $datos[]= array("id"=>$clave,"ema"=>$ema,"usunombre"=>$usu,"prperfil"=>$prf,"res"=>"si","select"=>"");
            }
        }
    }else {
        $datos[]= array("res"=>"no");   
    }
    echo json_encode($datos);
}else if($opcion == "TERMINAR") {
    
    $txtnombcomite = $_POST['txtnombcomite'];
    $fechacom = $_POST['fechacom'];
    $horainicio = $_POST['horainicio'];
    $horafin = $_POST['horafin'];
    $est = $_POST['est'];
    $asistentesdes = $_POST['asistentesdes'];
    $asistentes = $_POST['asistentes'];
    $asistentes = implode(",",(array)$asistentes);


    $verif = mysqli_query($conectar,"SELECT * from tbl_comites where com_fecha = '".$fechacom."' and com_hora_inicio='".$horainicio."' and com_hora_fin='".$horafin."'");
    $numv = mysqli_num_rows($verif);

    if( $numv > 0){
        $res = "error";
        $msn = "Ya hay un comite programado para esa hora";
    }
    else
    {
        $query = " INSERT INTO  tbl_comites
        (com_nombre, 
        com_fecha, 
        com_hora_inicio, 
        com_hora_fin, 
        com_usu_actualiz,
        com_fec_actualiz,        
        est_clave_int) 
        VALUE (
            '$txtnombcomite',
            '$fechacom',
            '$horainicio',
            '$horafin',
            '$usuario',
            '$fecha',
            '1' 
        )";
        
        $result= mysqli_query($conectar, $query);
        if (!$result) {
            $res = "error";
            $msn=die('fail'.mysqli_error($conectar));

        } else {
            $idcomite = mysqli_insert_id($conectar);

            //Asosciar desarrollo al comite
            $update = mysqli_query($conectar,"UPDATE tbl_comitesdesarrollo SET com_clave_int = '".$idcomite."',est_clave_int = 1 WHERE est_clave_int = 0 "); 

            //Inserta ASISTENTE
            $insasis = mysqli_query ($conectar,"INSERT into tbl_comitesasistentes (com_clave_int, usu_clave_int , est_clave_int) SELECT '".$idcomite."',usu_clave_int, 1 FROM tbl_usuarios   WHERE usu_clave_int in(".$asistentes.") ");             
           
            if(!$insasis){
                
                $res = "error";
               // $msn =die('fail'.mysqli_error($conectar));
            } else {
                $res = "ok";
                $msn = "Datos  guardados correctamente";
            }      
            
            $res = "ok";
            $msn = "Comité guardados correctamente";
        }
    }
    
    $datos[]= array("res"=>$res,"msn"=>$msn,"id"=>$idcomite);
    echo json_encode($datos);
}else if($opcion == "TERMINAR1") {
    $id = $_POST['id'];
    $txtnombcomite = $_POST['txtnombcomite'];
    $fechacom = $_POST['fechacom'];
    $horainicio = $_POST[ 'horainicio'];
    $horafin = $_POST['horafin'];
    $est = $_POST['est'];
    $txtdesarrollo = $_POST['txtdesarrollo'];    
    $asistentesdes = $_POST['asistentesdes']; 
    $asistentes = $_POST['asistentes'];
    $asistentes = implode(",",(array)$asistentes);
     
    

    $verif = mysqli_query($conectar,"SELECT * from tbl_comites where com_fecha = '".$fechacom."' and com_hora_inicio='".$horainicio."' and com_hora_fin='".$horafin."'");
    $numv = mysqli_num_rows($verif);
    if ($num>0) {
        $res = "error";
        $msn = "Ya hay un usuario con el correo electronico ingresado. Verifica";
    } else {

      $query ="UPDATE tbl_comites SET com_nombre='$txtnombcomite',com_fecha='$fechacom',est_clave_int='3',com_hora_inicio='$horainicio',com_hora_fin = '$horafin', com_usu_actualiz='$usuario', com_fec_actualiz='$fecha' WHERE $id = com_clave_int";
    
        $result= mysqli_query($conectar,$query);

        if (!$result>0) {
            $res= "error";
            $msn=die('fail'.mysqli_error($conectar));
        } else {
            $idcomite = mysqli_insert_id($conectar);

            //Asosciar desarrollo al comite
            // $update = mysqli_query($conectar,"UPDATE tbl_comitesdesarrollo SET com_clave_int = '".$idcomite."',est_clave_int = 1 WHERE est_clave_int = 0 and usu_clave_int = '".$asistentesdes."'"); 

            //Inserta ASISTENTE
            $insasis = mysqli_query ($conectar,"INSERT into tbl_comitesasistentes (com_clave_int, usu_clave_int  , est_clave_int) 
            SELECT '".$id."',usu_clave_int,1 FROM tbl_usuarios  WHERE usu_clave_int in(".$asistentes.") and usu_clave_int not in(select usu_clave_int from tbl_comitesasistentes where com_clave_int = '".$id."')");             
        
            if(!$insasis){
 
                $res = "error";
            // $msn =die('fail'.mysqli_error($conectar));
            } else {
                
                $delsel = mysqli_query($conectar, "DELETE FROM tbl_comitesasistentes WHERE com_clave_int = '".$id."' and usu_clave_int not in(".$asistentes.")");
            }  
            $res= "ok";
            $msn="Comité Cerrado correctamente";
           
           
        }
    }
    $datos[]= array("res"=>$res,"msn"=>$msn,"id"=>$id);
    echo json_encode($datos);  
}else if($opcion == "CARGARRESPONSABLES") {
    $asistentes = $_POST['asi'];
    $asistentes = implode(",",(array)$asistentes);

    $sql = mysqli_query($conectar, "SELECT * from 
    tbl_usuarios u 
    inner join tbl_perfil p on (p.prf_clave_int = u.prf_clave_int) 
    where u.est_clave_int = 1 and  usu_clave_int in(".$asistentes.") order by u.usu_nombre");

    $num = mysqli_num_rows($sql);
    
    if ($num>0){
        while($dat = mysqli_fetch_array($sql)){ 

            $clave = $dat['usu_clave_int'];
            $usu = $dat['usu_nombre']." ".$dat['usu_apellido'];
            $usutec = $dat['usu_usuario'];
            $prf = $dat['prf_descripcion'];
            $ema= $dat['usu_correo'];
            
            $datos[]= array("id"=>$clave,"ema"=>$ema,"usunombre"=>$usu,"prperfil"=>$prf,"res"=>"si","select"=>"selected" );
            
        }
    }else {
        $datos[]= array("res"=>"no");   
    }
    echo json_encode($datos);
}else if($opcion=="IMPRIMIR"){
    $id = $_POST['id'];
    ?>
    <iframe src="modulos/comites/informes/impinformes.php?id=<?php echo $id;?>" class="col-md-12" style="height:600px; border:thin;overflow: hidden" scrolling="no"></iframe>
    <?PHP
}