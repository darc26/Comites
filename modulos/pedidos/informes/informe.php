<?php
     
    $query = mysqli_query($conectar ,"SELECT p.ped_clave_int, 
    usu.usu_nombre, 
    usu.usu_apellido,
	usu.usu_correo,
    p.ped_fecha, 
    p.ped_total 
    FROM tbl_pedido p 
    JOIN tbl_usuarios usu ON usu.usu_clave_int = p.usu_clave_int 
    WHERE p.ped_clave_int = '".$id."' ");
    $row = mysqli_fetch_array($query);
    $idped = $row['ped_clave_int'];     
    $fechaped = $row['ped_fecha'];
    $pedTotal = $row['ped_total'];
    $nombre = $row['usu_nombre'];
    $apellido = $row['usu_apellido'];
    $correo = $row['usu_correo'];

    $querypro= "SELECT 
    p.pde_clave_int,
    pr.pro_nombre,
    p.pde_cantidad,
    p.pde_precio,
    p.pde_cantidad * p.pde_precio AS total
    FROM
    tbl_pedidodetalle p
    JOIN tbl_productos pr ON pr.pro_clave_int = p.pro_clave_int
    WHERE p.ped_clave_int = '".$id."'";
    $nombrePro= $data['pro_nombre'];
    $cantida= $data['pde_cantidad'];
    $precio= $data['pde_precio'];
    $totalPde= $data['total'];
    $result= mysqli_query($conectar,$querypro); 
    



?>
<style>

    td,
    th {
        border: 1px solid black;
    }

    
    
    .td1 {
        width: 250px;
       
    }
</style>
<page backtop="10mm" backleft="8mm" backright="10mm" backbottom="30mm" footer="date;time;page" style="font-size: 14px">
    <page_header>

    </page_header>
    <table style="width: 600px">
        <tr>
            <td rowspan="2">
                <h2>Proyecto 1</h2>
                <h4>Pedido N° <?php  echo sprintf(" %04d",$row['ped_clave_int']); ?></h4>
                <p>Fecha: <?php echo $row['ped_fecha'];?></p>
            </td>
            <td fa-border>
                <h4>Pavas s.a</h4>
                <p>Tel: 444 44 44</p>
                <p>Direcion: CaLLe 58 N° 32-23</p>
                <p>Email: <?php echo $row['usu_correo'];?></p>
                <h4>Notas de Cliente: <?php echo $row['usu_nombre'];?>  <?php echo $row['usu_apellido'];?></h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Notas del Cliente</h4>
            </td>
        </tr>
        <tr>
            <td colspan="2" >
                <table style="width: 600px">

                    <tr>
                        <th>Cantidad</th>
                        <th>Productos</th>
                        <th>P.Unidad</th>
                        <th>Total</th>
                    </tr>
                 
                    <?php
                    



                    while ($data= mysqli_fetch_array($result)) {
                    ?>
                     <tr>
                  
                        <td><?php echo $data['pde_cantidad']; ?></td>
                        <td class="td1"><?php echo $data['pro_nombre']; ?></td>
                        <td>$ <?php echo $data['pde_precio']; ?></td>
                        <td>$ <?php echo $data['total']; ?></td>
                    </tr>
                    <?php
                    }
                    ?>
               

                    <tr>
                        <td colspan="2"></td>
                        <td>Total</td>
                        <td>$ <?php echo  $row['ped_total'];?></td>
                    </tr>


                </table>
            </td>
        </tr>
    </table>
 
</page>