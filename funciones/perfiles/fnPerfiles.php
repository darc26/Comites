<?php
session_start();
include('../../data/conexion.php');
error_reporting(0);


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
        <div class="col-md-4">
            <label for="">Perfil</label>
            <input type="text" class="form-control" id="busperfil" placeholder="Buscar un perfil">
        </div>
    </div>
    <script>
        $('#busperfil').on('keyup',function(e){
            if(e.which==13)
            {
                CRUDPERFIL('LISTAPERFILES','')
            }
        })  
    </script>
    <?php
   echo "<script> CRUDPERFIL('LISTAPERFILES','')</script>";

}else if($opcion== 'LISTAPERFILES'){

    include("../../data/validarpermisos.php");

    ?>
    <table id="tbperfil" class="table table-bordered table-striped" data-edit="<?php echo $p3?>"  data-elim="<?php echo $p4 ?>"   data-perm="<?php echo $p1?>">
            <thead>
                <tr>                    
                    <th>Descripción</th>
                    <th>Estado</th> 
                    <th style="width: 9px;"></th>
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
         <script src="jsdatatable/perfiles/jslistaperfiles.js?<?php echo time(); ?>"></script>
   <?php

}else if($opcion== 'NUEVO' || $opcion== 'EDITAR') {
    $id = $_POST['id'];
   
    $query = "SELECT * from tbl_perfil WHERE prf_clave_int= $id";

    $result= mysqli_query($conectar, $query);
    $row = mysqli_fetch_array($result);
    $txtperfil = $row['prf_descripcion'];
    $est = $row['est_clave_int'];
   
     

    ?>
    <div class="card card-primary">     
        <!-- form start -->
        <form id="frmperfil" role="form" data-parsley-validate>
            <div class="card-body">

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Descripción</label>
                        <input type="text" class="form-control" id="txtperfil" placeholder="Agrega una Descripción" data-parsley-error-message="Se requiere una descripción" value="<?php echo $txtperfil; ?>" required>
                    </div>
                </div>
                <div class="col-md-4 hide">
                    <label for="">Estado</label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn bg-olive <?php if ($est != 0) { echo 'active';} ?>">
                            <input type="radio"  id="option1" name="radestado" autocomplete="off" value="1" <?php if ($est != 0) { echo 'checked';} ?>> Activo
                        </label>
                        <label class="btn bg-olive <?php if ($est == 0) { echo 'active';} ?>">
                            <input type="radio"  id="option2" name="radestado" autocomplete="off" value="0" <?php if ($est == 0) { echo 'checked';} ?>> Inactivo
                        </label>
                    </div>    
                </div> 
            </div>  
                  

    
            </div>
            <!-- /.card-body -->

        </form>
    </div>


   <?php
}else if($opcion== 'GUARDAR'){
    $txtperfil = $_POST['txtperfil'];
    $est = $_POST['est'];

    $ver = mysqli_query($conectar, "SELECT * from tbl_perfil where prf_descripcion='".$txtperfil."' AND est_clave_int!= 2 " );
    $num = mysqli_num_rows($ver);

    if ($num>0) {
        $res = "error";
        $msn = "Ya hay una descripción ingresada. Verifica";
    } else {
        $query = "INSERT INTO  tbl_perfil(prf_descripcion, prf_fec_actualiz, prf_usu_actualiz, est_clave_int) VALUE ('$txtperfil','$fecha','$usuario', $est)";

        $result= mysqli_query($conectar, $query);
        if (!$result) {
            $res = "error";
            $msn =die('fail'.mysqli_error($conectar));
        } else {
            $res = "ok";
            $msn = "Datos  guardados correctamente";
        }
        $datos[]= array("res"=>$res,"msn"=>$msn);
        echo json_encode($datos);
        
    }
    
}else if($opcion== 'GUARDAREDICION') {
    $id = $_POST['id'];
    $txtperfil = $_POST['txtperfil'];
    $est = $_POST['est'];
    
    $ver = mysqli_query($conectar,"SELECT *from tbl_perfil where (prf_descripcion='".$txtperfil."'and prf_clave_int!='".$id."' ) AND est_clave_int!= 2");
    if ($num>0) {
        $res = "error";
        $msn = "Ya hay una Descripción ingresada. Verificar";

    } else {
        $query = "UPDATE tbl_perfil SET prf_descripcion = '$txtperfil',est_clave_int='$est' , prf_usu_actualiz = '$usuario'
        ,prf_fec_actualiz= '$fecha' where $id = prf_clave_int";

        $result= mysqli_query($conectar ,$query);

        if (!$result>0) {
            $res = "error";
            $msn = die('fail'.mysqli_error($conectar));         
        } else {
            $res = "ok";
            $msn = "Datos modificados correctamenete";
        }        
    }
    $datos[]= array("res"=>$res,"msn"=>$msn);
    echo json_encode($datos);
    

}else if($opcion== 'ELIMINAR'){

    $id = $_POST['id'];

    $query = "UPDATE tbl_perfil SET est_clave_int=2 where prf_clave_int = $id ";
    $result = mysqli_query($conectar,$query);

    if ($result>0) {
        $res = "ok";
        $msn = "La descripcion se a eliminado correctamente";
    } else {
        $res= "error";
        $msn= "No se pudo elisminar correctamente";
    }
    $datos[]= array("res"=>$res,"msn"=>$msn);
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
                <a class="nav-link " id="vert-tabs-right-" data-toggle="pill" data-target="#divpermisos"  role="tab" aria-controls="vert-tabs-right-home" aria-selected="true"  onclick="CRUDPERFIL('LISTAPERMISOS','<?php echo $idu;?>','<?php echo $idmod[$i];?>')"><?php echo $nommod[$i];?></a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php echo "<script>CRUDPERFIL('LISTAPERMISOS','".$idu."','1');</script>";
}else if($opcion=='GUARDARPERMISOS'){
    $idp=$_POST['idp'];
    $idu=$_POST['idu'];

    $ver= mysqli_query($conectar,"SELECT * FROM tbl_permisos_perfil WHERE per_clave_int = '".$idp."' and prf_clave_int = '".$idu."'");
    $numv= mysqli_num_rows($ver);
    if($numv>0){
        $sql= mysqli_query($conectar,"DELETE FROM tbl_permisos_perfil WHERE  per_clave_int = '".$idp."' and prf_clave_int = '".$idu."'");
    }else{
        $sql= mysqli_query($conectar,"INSERT INTO tbl_permisos_perfil (per_clave_int,prf_clave_int)VALUE ( '".$idp."', '".$idu."') ");

        if(!$sql){
            $res = "error";
            $msn =die('fail'.mysqli_error($conectar));
        } else {
            $res = "ok";
            $msn = "Datos  guardados correctamente";
        }
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


        $verf = mysqli_query($conectar," SELECT * FROM tbl_permisos_perfil WHERE  per_clave_int = '".$idp."' and prf_clave_int = '".$idu."'");
        $numus= mysqli_num_rows($verf);
        ?>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <ul class="to_do">
                <li>
                    <p>
                    <input  <?php if($numus>0){ echo 'checked';} ?> type="checkbox"  onclick="CRUDPERFIL('GUARDARPERMISOS','<?php echo $idp;?>','<?php echo $idu; ?>')">  <?php  echo $descrip  ?>
                    </p>
                </li>
            </ul>
        </div>
    <?php
    }
}
