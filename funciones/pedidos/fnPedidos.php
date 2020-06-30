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
            <input type="text" class="form-control" id="buspedido" placeholder="Buscar un pedido">
        </div> 
    </div>
    <script>
        $('#buspedido').on('keyup',function(e){
            if(e.which==13)
            {
                CRUDPEDIDOS('LISTAPEDIDOS','')
            }
        })   

    </script>
    <?php
   echo "<script> CRUDPEDIDOS('LISTAPEDIDOS','')</script>";
}else if($opcion == "LISTAPEDIDOS"){
    ?>
    <table id="tbpedidos" class="table table-bordered table-striped display"  style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Pedido</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th> 
                    <th></th>
                    <th></th> 
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th></th>
                    <th>Pedido</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th> 
                    <th></th>
                    <th></th>
                    <th></th> 
                    <th></th>
                </tr>
            </tfoot>
        </table>
        <script src="jsdatatable/pedidos/jslistapedidos.js?<?php echo time(); ?>"></script>
    <?php
}else if($opcion == "NUEVO" || $opcion == "EDITAR"){
    $id = $_POST['id'];

    $result= mysqli_query($conectar,  "SELECT * from tbl_pedido WHERE ped_clave_int= $id");
    $row = mysqli_fetch_array($result);
    
    $txtfecha= $row['ped_fech'];
    $precio = $row['pro_precio'];
    $selcliente = $row[ 'usu_clave_int'];
    $est = $row['est_clave_int'];  


    if($id>0){
        $contotal = mysqli_query($conectar, "SELECT sum(pde_cantidad*pde_precio) totale FROM tbl_pedidodetalle  WHERE ped_clave_int= $id");
    }else{
         $contotal = mysqli_query($conectar, "SELECT sum(pde_cantidad*pde_precio) totale FROM tbl_pedidodetalle  WHERE est_clave_int = 0 and usu_clave_int = '".$idUsuario."' and pde_cantidad>0");
    }
    $datt = mysqli_fetch_array($contotal); $total = $datt['totale']; if($total<=0){ $total = 0; }

    ?>
    <i class="card card-primary">     
        <!-- form start -->
        <form id="frmpedidos" role="form" data-parsley-validate>
            <div class="card-body">
                <div class="form-group">
                
                               
                <div class="form-group">
                    <label>Cliente</label>
                    <select class="form-control" id="cliente" data-parsley-errors-container="#error1" required>
                        <option value="" >--Seleccione cliente--</option>
                        <?php
                        $query ="SELECT * from tbl_usuarios where est_clave_int = 1 or usu_clave_int = '$selcliente' ";
                        $result= mysqli_query($conectar,$query);
                        if( !$result ){
                            die('fail'.mysqli_error($conectar));
                        }

                        while ($row = mysqli_fetch_array($result)) {
                            
                            ?>
                            <option <?php if ($row['usu_clave_int'] == $selcliente) { echo 'selected';} ?> value="<?php echo $row['usu_clave_int']; ?>"><?php echo $row['usu_nombre']; ?></option>
                            <?php
                        }
                        ?>                        
                    </select>
                    <span id="error1"></span>
                </div>
                <div class="form-group">
                    <label >Fecha</label>
                    <input type="date" class="form-control" id="fechaped" placeholder="Agrega tu descripcion Completo" data-parsley-error-message="Se requiere un descripcion" value="<?php echo date("Y-m-d");?>" required>
                </div> 
                <div class="form-group">
                    <label >Productos</label>
                    <table id="tbproductos" class="table table-bordered table-striped display" data-pedido="<?php echo $id;?>" style="width:100%">
                        <thead>
                            <tr>
                              
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precios</th>
                                <th>Categoria</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                              
                            </tr>
                        </thead>
                                    
                        <tfoot>
                            <tr>
                                
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precios</th>
                                <th>Categoria</th>
                                <th>Total</th> 
                                <th><span id="spantotal" class="currency"><?php echo $total;?></span></th>
                              
                            </tr>
                        </tfoot>
                    </table>
                    <script src="jsdatatable/pedidos/jslistaproductos.js?<?php echo time(); ?>"></script>
                </div>                
            </div>  
    
            <!-- /.card-body -->

        </form>
    </div>

   

    <?php
    echo "<script> INICIALIZARCONTENIDO()</script>";


}else if($opcion == "GUARDAREDICION"){

    $id = $_POST['id'];
    $cliente = $_POST['cliente'];
    $fechaped = $_POST['fechaped'];
 
    $veri = mysqli_query($conectar,"SELECT * FROM tbl_pedidodetalle WHERE ped_clave_int = '".$id."' and pde_cantidad>0");
    $numv = mysqli_num_rows($veri);
    if($numv>0)
    {
        $contotal = mysqli_query($conectar, "SELECT sum(pde_cantidad*pde_precio) totale FROM tbl_pedidodetalle  WHERE  ped_clave_int = '".$id."' ");
        $datt = mysqli_fetch_array($contotal); $total = $datt['totale']; if($total<=0){ $total = 0; }

        $ins = mysqli_query($conectar, "UPDATE tbl_pedido set usu_clave_int ='".$cliente."'  ,ped_fecha='".$fechaped."' ,ped_total='".$total."' ,ped_usu_actualiz ='".$usuario."',ped_fec_actualiz='".$fecha."'   WHERE  ped_clave_int=$id ");

        if($ins>0)
        {
            $res = "ok";
            $msn = "Pedido editar correctamente";

        }
        else
        {
            $res = "error";
            $msn = "Surgió un error. Verificar";
        }
    }
    else{
        $res = "error";
        $msn  = "No hay productos agregados con cantidades mayores a cero";
    }
    $datos[] = array("res"=>$res, "msn"=>$msn,"idpedido"=>$idpedido);
    echo json_encode($datos);
 

}else if($opcion == "ELIMINAR"){
   
        $id = $_POST['id'];
    
        $con=mysqli_query($conectar, "UPDATE tbl_pedido set est_clave_int= 2 WHERE ped_clave_int= $id");
        
        
        if($con>0){
            $res = "ok";
            $msn = "El pedido se a eliminado correctamente";
        }else{
            $res = "error";
            $msn = "No se pudo eliminar este pedido";
        }
        $datos[] = array( "res"=> $res, "msn"=> $msn);
        echo json_encode($datos);
}else if($opcion == "MODIFICARCANTIDAD"){

    $cant = $_POST['cant'];
    $precio = $_POST['pre'];    
    $idpro = $_POST['idpro'];
    $idpedido=$_POST['idpedido'];
    $pretot = $cant * $precio;
    

    if($idpedido>0){
        $query1="SELECT * from tbl_pedido where pro_clave_int= $idpro and ped_clave_int = '".$idpedido."'";
        $query2="UPDATE tbl_pedidodetalle set pde_cantidad= '$cant',pde_precio= '$precio' WHERE pro_clave_int= $idpro and ped_clave_int = '".$idpedido."'";
        $query3="INSERT INTO  tbl_pedidodetalle (ped_clave_int,pro_clave_int,pde_cantidad,pde_precio,  pde_usu_actualiz,pde_fec_actualiz,est_clave_int,usu_clave_int) VALUE ('".$idpedido."','".$idpro."','$cant','$precio','$usuario','$fecha','1','".$idUsuario."' )";
        $query4="SELECT sum(pde_cantidad*pde_precio) totale FROM tbl_pedidodetalle  WHERE ped_clave_int = '".$idpedido."' and pde_cantidad>0";

        
    }else{
        $query1="SELECT * from tbl_pedidodetalle where pro_clave_int= $idpro and usu_clave_int = '".$idUsuario."' AND est_clave_int= 0";
        $query2="UPDATE tbl_pedidodetalle set pde_cantidad= '$cant',pde_precio= '$precio' WHERE pro_clave_int= $idpro and usu_clave_int = '".$idUsuario."' AND est_clave_int= 0";
        $query3=" INSERT INTO  tbl_pedidodetalle (pro_clave_int,pde_cantidad,pde_precio,  pde_usu_actualiz,pde_fec_actualiz,est_clave_int,usu_clave_int) VALUE ('".$idpro."','$cant','$precio','$usuario','$fecha','0','".$idUsuario."' )";
        $query4="SELECT sum(pde_cantidad*pde_precio) totale FROM tbl_pedidodetalle  WHERE est_clave_int = 0 and usu_clave_int = '".$idUsuario."' and pde_cantidad>0";
    }
    $ver = mysqli_query($conectar,$query1);
    $num = mysqli_num_rows($ver);
    if($num>0){
       
        $result= mysqli_query($conectar,$query2);
        if (!$result>0) {
            $res= "error";
            $msn=die('fail'.mysqli_error($conectar));
        } else { 
            $res= "ok";
            $msn="Datos modificados correctamente";
        }
        

    }else{
        $result= mysqli_query($conectar, $query3);
        if (!$result) {
        $res = "error";
        $msn=die('fail'.mysqli_error($conectar));

        } else {
            $res = "ok";
            $msn = "Datos guardados correctamente";

        }
    }
    if($idpedido>0 and $res =="ok")
    {
        $contotal = mysqli_query($conectar, "SELECT sum(pde_cantidad*pde_precio) totale FROM tbl_pedidodetalle  WHERE  ped_clave_int = '".$idpedido."' ");
        $datt = mysqli_fetch_array($contotal); $total = $datt['totale']; if($total<=0){ $total = 0; }

        $ins = mysqli_query($conectar, "UPDATE tbl_pedido set ped_total='".$total."' ,ped_usu_actualiz ='".$usuario."',ped_fec_actualiz='".$fecha."'   WHERE ped_clave_int=$idpedido ");
    }
 



    $contotal = mysqli_query($conectar,$query4);
    $datt = mysqli_fetch_array($contotal); $total = $datt['totale']; if($total<=0){ $total = 0; }

    $datos[]= array("res"=>$res,"msn"=>$msn,"total"=>$total,"pretot"=>$pretot);
    echo json_encode($datos);
   
}else if($opcion=="GUARDARPEDIDO"){

    $cliente = $_POST['cliente'];
    $fechaped = $_POST['fechaped'];
 
    $veri = mysqli_query($conectar,"SELECT * FROM tbl_pedidodetalle WHERE est_clave_int = 0 and usu_clave_int = '".$idUsuario."' and pde_cantidad>0");
    $numv = mysqli_num_rows($veri);
    if($numv>0)
    {
        $contotal = mysqli_query($conectar, "SELECT sum(pde_cantidad*pde_precio) totale FROM tbl_pedidodetalle  WHERE est_clave_int = 0 and usu_clave_int = '".$idUsuario."' and pde_cantidad>0");
        $datt = mysqli_fetch_array($contotal); $total = $datt['totale']; if($total<=0){ $total = 0; }

        $ins = mysqli_query($conectar, "INSERT INTO tbl_pedido (usu_clave_int ,ped_fecha,ped_total ,ped_usu_actualiz ,est_clave_int,ped_fec_actualiz,usu_creacion) VALUES('".$cliente."','".$fechaped."','".$total."','".$usuario."','0','".$fecha."','".$idUsuario."')");

        if($ins>0)
        {
            //$conmax = mysqli_Query($conectar, "SELECT max(ped_clave_int) ped from tbl_pedido where usu_clave_int = '".$idUsuario."' limit 1");
            //$datmax = mysqli_fetch_array($conmax); $idpedido = $datmax['ped'];
            $idpedido = mysqli_insert_id($conectar);

            $update = mysqli_query($conectar,"UPDATE tbl_pedidodetalle SET ped_clave_int = '".$idpedido."',est_clave_int = 1 WHERE est_clave_int = 0 and usu_clave_int = '".$idUsuario."' and pde_cantidad>0");
            $res = "ok";
            $msn = "Pedido guardado correctamente";

        }
        else
        {
            $res = "error";
            $msn = "Surgió un error. Verificar";
        }
    }
    else{
        $res = "error";
        $msn  = "No hay productos agregados con cantidades mayores a cero";
    }
    $datos[] = array("res"=>$res, "msn"=>$msn,"idpedido"=>$idpedido);
    echo json_encode($datos);
}else if($opcion=="IMPRIMIR"){
    $id = $_POST['id'];
    ?>
    <iframe src="modulos/pedidos/informes/impinforme.php?id=<?php echo $id;?>" class="col-md-12" style="height:600px; border:thin;overflow: hidden" scrolling="no"></iframe>
    <?PHP
}