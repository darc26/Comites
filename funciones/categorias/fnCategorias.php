<?php
session_start();
include('../../data/conexion.php');
error_reporting(0);
//$login     = isset($_SESSION['persona']);
// cookie que almacena el numero de identificacion de la persona logueada
$usuario   = $_COOKIE['usuarioPROYECTO1'];
$idcategoria = $_COOKIE['iducategoriaPROYECTO1'];
$categoria    = $_SESSION["categoriaPROYECTO1"];
date_default_timezone_set('America/Bogota');
$fecha  = date("Y/m/d H:i:s");
$opcion = $_POST['opcion'];
if($opcion== 'FILTROS'){
    ?>
    <div class="row">
        <div class="col-md-4">
            <input type="text" class="form-control" id="buscategoria" placeholder="Buscar una categoria">
        </div>
    </div>
    <script>
        $('#buscategoria').on('keyup',function(e){
            if(e.which==13)
            {
                CRUDCATEGORIA('LISTACATEGORIAS','')
            }
        })  
    </script>
    <?php
   echo "<script> CRUDCATEGORIA('LISTACATEGORIAS','')</script>";

}else if($opcion== 'LISTACATEGORIAS'){
    ?>
    <table id="tbcategoria" class="table table-bordered table-striped">
            <thead>
                <tr>                    
                    <th>Descripción</th>
                    <th>Estado</th> 
                    <th></th>
                    <th></th> 
                </tr>
            </thead>
            <tbody>
               
            </tbody>
            <tfoot>
                <tr>                    
                    <th>Descripción</th>  
                    <th>Estado</th>                     
                    <th></th>
                    <th></th> 
                </tr>
            </tfoot>
        </table>
         <script src="jsdatatable/categorias/jslistacategorias.js?<?php echo time(); ?>"></script>
   <?php

}else if($opcion== 'NUEVO' || $opcion== 'EDITAR') {
    $id = $_POST['id'];
   
    $query = "SELECT * from tbl_categorias WHERE cat_clave_int= $id";

    $result= mysqli_query($conectar, $query);
    $row = mysqli_fetch_array($result);
    $txtcategoria = $row['cat_descripcion'];
    $est = $row['est_clave_int'];
   
     

    ?>
    <div class="card card-primary">     
        <!-- form start -->
        <form id="frmcategoria" role="form" data-parsley-validate>
            <div class="card-body">

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Descripción</label>
                        <input type="text" class="form-control" id="txtcategoria" placeholder="Agrega una Descripción" data-parsley-error-message="Se requiere una descripción" value="<?php echo $txtcategoria; ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
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
    $txtcategoria = $_POST['txtcategoria'];
    $est = $_POST['est'];

    $ver = mysqli_query($conectar, "SELECT * from tbl_categorias where cat_descripcion='".$txtcategoria."' AND est_clave_int!= 2 " );
    $num = mysqli_num_rows($ver);

    if ($num>0) {
        $res = "error";
        $msn = "Ya hay una descripción ingresada. Verifica";
    } else {
        $query = "INSERT INTO  tbl_categorias(cat_descripcion, cat_fec_actualiz, cat_usu_actualiz, est_clave_int) VALUE ('$txtcategoria','$fecha','$usuario', $est)";

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
    $txtcategoria = $_POST['txtcategoria'];
    $est = $_POST['est'];
    
    $ver = mysqli_query($conectar,"SELECT *from tbl_categorias where (cat_descripcion='".$txtcategoria."'and cat_clave_int!='".$id."' ) AND est_clave_int!= 2");
    if ($num>0) {
        $res = "error";
        $msn = "Ya hay una Descripción ingresada. Verificar";

    } else {
        $query = "UPDATE tbl_categorias SET cat_descripcion = '$txtcategoria',est_clave_int='$est' , cat_usu_actualiz = '$usuario'
        ,cat_fec_actualiz= '$fecha' where cat_clave_int =  $id";

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

    $query = "UPDATE tbl_categorias SET est_clave_int=2 where cat_clave_int = $id ";
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
    
   
}
