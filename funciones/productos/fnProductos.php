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
if($opcion == 'FILTROS'){
    ?>
    <div class="row">
        <div class="col-md-4">
            <input type="text" class="form-control" id="busnombre" placeholder="Buscar un nombre">
        </div> 
    </div>
    <script>
        $('#busnombre').on('keyup',function(e){
            if(e.which==13)
            {
                CRUDPRODUCTOS('LISTAPRODUCTOS','')
            }
        })   

    </script>
    <?php
   echo "<script> CRUDPRODUCTOS('LISTAPRODUCTOS','')</script>";
}else if($opcion == "LISTAPRODUCTOS"){
    ?>
    <table id="tbproductos" class="table table-bordered table-striped display"  style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precios</th>
                    <th>Categoria</th>
                    <th>Estado</th>
                    <th></th>
                    <th></th> 
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precios</th>
                    <th>Categoria</th>
                    <th>Estado</th> 
                    <th></th>
                    <th></th> 
                </tr>
            </tfoot>
        </table>
        <script src="jsdatatable/productos/jslistaproductos.js?<?php echo time(); ?>"></script>
    <?php
}else if($opcion == "NUEVO" || $opcion == "EDITAR"){
    $id = $_POST['id'];
    $query = "SELECT * from tbl_productos WHERE pro_clave_int= $id";

    $result= mysqli_query($conectar, $query);
    $row = mysqli_fetch_array($result);
    $txtnombre = $row['pro_nombre'];
    $txtdescripcion= $row['pro_descripcion'];
    $txtprecio = $row['pro_precio'];
    $selcategoria = $row[ 'cat_clave_int'];
    $txtproducto = $row['pro_producto'];
    $est = $row['est_clave_int'];  

    ?>
    <div class="card card-primary">     
        <!-- form start -->
        <form id="frmproductos" role="form" data-parsley-validate>
            <div class="card-body">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="txtnombre" placeholder="Agrega tu Nombre Completo" data-parsley-error-message="Se requiere un nombre" value="<?php echo $txtnombre; ?>" required>
                </div>
                <div class="form-group">
                    <label >Descripcion</label>
                    <input type="text" class="form-control" id="txtdescripcion" placeholder="Agrega tu descripcion Completo" data-parsley-error-message="Se requiere un descripcion" value="<?php echo $txtdescripcion; ?>" required>
                </div>
                <div class="form-group">
                    <label>Precio</label>
                    <input type="text"  onkeypress="return validar_texto(event)" class="form-control currency"  id="txtprecio" placeholder="Agrega un precio" data-parsley-error-message="Se requiere un precio" value="<?php echo $txtprecio; ?>" required>
                </div>
                               
                <div class="form-group">
                    <label>Categoria</label>
                    <select class="form-control" id="selcategoria" data-parsley-errors-container="#error1" required>
                        <option value="" >--Seleccione categorias--</option>
                        <?php
                        $query ="SELECT * from tbl_categorias where est_clave_int = 1 or cat_clave_int = '$selcategoria' ";
                        $result= mysqli_query($conectar,$query);
                        if( !$result ){
                            die('fail'.mysqli_error($conectar));
                        }

                        while ($row = mysqli_fetch_array($result)) {
                            
                            ?>
                            <option <?php if ($row['cat_clave_int'] == $selcategoria) { echo 'selected';} ?> value="<?php echo $row['cat_clave_int']; ?>"><?php echo $row['cat_descripcion']; ?></option>
                            <?php
                        }
                        ?>                        
                    </select>
                    <span id="error1"></span>
                </div>
                <div class="form-group">
                    <label>Producto</label>
                    <input onchange="setpreview('rutaproducto','txtproducto','frmproductos', 'tmp')" type="file" class="dropify" data-height="100" id="txtproducto" placeholder="Agrega un producto" data-parsley-error-message="Se requiere un producto" data-default-file="<?php echo $txtproducto; ?>" required>
                    <span id="rutaproducto" data-url="<?php echo $txtproducto; ?>"></span>
                </div>
                
                

                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn bg-olive <?php if ($est != 0) { echo 'active';} ?>">
                        <input type="radio"  id="option1" name="radestado" autocomplete="off" value="1" <?php if ($est != 0) { echo 'checked';} ?>> Activo
                    </label>
                    <label class="btn bg-olive <?php if ($est == 0) { echo 'active';} ?>">
                        <input type="radio"  id="option2" name="radestado" autocomplete="off" value="0" <?php if ($est == 0) { echo 'checked';} ?>> Inactivo
                    </label>
                </div>               
                   
               
            </div>  

                   
                
    
            <!-- /.card-body -->

        </form>
    </div>

   

    <?php
    echo "<script> INICIALIZARCONTENIDO()</script>";

}else if($opcion == "GUARDAR") {
    
    $txtnombre = $_POST['txtnombre'];
    $txtdescripcion = $_POST['txtdescripcion'];
    $txtprecio = $_POST['txtprecio'];    
    $txtproducto = $_POST['txtproducto'];
    $selcategoria = $_POST['selcategoria'];
    $est = $_POST['est'];
    $trozos = explode(".",$txtproducto);
    $ext = end($trozos);


    $query = " INSERT INTO  tbl_productos (pro_nombre, pro_descripcion, pro_precio,  cat_clave_int,  pro_usu_actualiz, pro_fec_actualiz, est_clave_int) VALUE ('$txtnombre','$txtdescripcion','$txtprecio','$selcategoria','$usuario','$fecha','$est' )";
    
    $result= mysqli_query($conectar, $query);
    $idproducto= mysqli_insert_id($conectar);
    $time= time();
    $rutaNueva= 'modulos/productos/img/'.$idproducto.'_'.$time.'.'.$ext;

    if (!$result) {
    $res = "error";
    $msn=die('fail'.mysqli_error($conectar));

    } else {
        if(rename("../../".$txtproducto,"../../".$rutaNueva ))
        {
            $query= "UPDATE tbl_productos set pro_producto= '$rutaNueva' WHERE pro_clave_int =  '".$idproducto."'";
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

        $res = "ok";
        $msn = "Datos guardados correctamente";

    }
    

    $datos[]= array("res"=>$res,"msn"=>$msn);
    echo json_encode($datos);
    
}else if($opcion == "GUARDAREDICION"){
    $id = $_POST['id'];
    $txtnombre = $_POST['txtnombre'];
    $txtdescripcion = $_POST['txtdescripcion'];
    $txtprecio = $_POST['txtprecio'];
   
    $txtproducto = $_POST['txtproducto'];
    $selcategoria = $_POST['selcategoria'];
    $est = $_POST['est'];
    $trozos = explode(".",$txtproducto);
    $ext = end($trozos);
    $rutaant=$_POST['rutaant'];

  
    

    $ver = mysqli_query($conectar,"SELECT * from tbl_productos WHERE pro_clave_int!='".$id."' AND est_clave_int!= 2");
    $num = mysqli_num_rows($ver);

    $time= time();
    $rutaNueva= 'modulos/productos/img/'.$id.'_'.$time.'.'.$ext;

    if ($num>0) {
        $res = "error";
        $msn = "Ya hay un usuario con el correo electronico ingresado. Verifica";
    } else {
      $query ="UPDATE tbl_productos SET pro_nombre='$txtnombre',pro_descripcion='$txtdescripcion',est_clave_int='$est',pro_precio='$txtprecio',cat_clave_int = '$selcategoria' , pro_usu_actualiz='$usuario', pro_fec_actualiz='$fecha' WHERE  pro_clave_int = $id";
    
        $result= mysqli_query($conectar,$query);

        if (!$result>0) {
            $res= "error";
            $msn=die('fail'.mysqli_error($conectar));
        } else {
            if(rename("../../".$txtproducto,"../../".$rutaNueva )and $txtproducto!="")
        {
            $query= "UPDATE tbl_productos set pro_producto= '$rutaNueva' WHERE pro_clave_int =  '".$id."'";
            $result= mysqli_query($conectar,$query);
           

            if (!$result>0) {
                $res= "error";
                $msn=die('fail'.mysqli_error($conectar));
            } else { 
                unlink('../../'.$rutaant);
            $res= "ok";
            $msn="Imagen modificados correctamente";
            }
            
        }
            $res= "ok";
            $msn="Datos modificados correctamente";
        }
    }
    $datos[]= array("res"=>$res,"msn"=>$msn,"sql");
    echo json_encode($datos);  

}else if($opcion == "ELIMINAR"){
   
        $id = $_POST['id'];
    
        $con=mysqli_query($conectar, "UPDATE tbl_productos set est_clave_int= 2 WHERE pro_clave_int= $id");
        
        
        if($con>0){
            $res = "ok";
            $msn = "El usuario se a eliminado correctamente";
        }else{
            $res = "error";
            $msn = "No se pudo eliminar este usuario";
        }
        $datos[] = array( "res"=> $res, "msn"=> $msn);
        echo json_encode($datos);
}