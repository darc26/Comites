<?php

$con=mysqli_query($conectar,"SELECT * 
FROM tbl_comitesdesarrollo o 
LEFT JOIN tbl_usuarios usu ON usu.usu_clave_int= o.usu_clave_int 
WHERE o.com_clave_int = '".$id."' AND o.usu_clave_int ='0' AND o.est_clave_int !=2  ");
$rowss= mysqli_num_rows($con);

$conv=mysqli_query($conectar,"SELECT * 
FROM tbl_comitesdesarrollo o 
LEFT JOIN tbl_usuarios usu ON usu.usu_clave_int= o.usu_clave_int 
WHERE o.com_clave_int = '".$id."' AND o.usu_clave_int !='0' AND o.est_clave_int !=2  ");
$rows= mysqli_num_rows($conv);

$conp=mysqli_query($conectar,"SELECT * 
FROM tbl_comitesasistentes o 
LEFT JOIN tbl_usuarios usu ON usu.usu_clave_int= o.usu_clave_int 
WHERE o.com_clave_int = '".$id."' AND o.usu_clave_int !='0' AND o.est_clave_int !=2  ");
$rowp= mysqli_num_rows($conp);

$conn=mysqli_query($conectar,"SELECT 
com_clave_int,
com_nombre,
date_format(com_fecha, '%d-%m-%Y') fecha,
date_format(com_hora_inicio, '%H:%i') horai,
date_format(com_hora_fin, '%H:%i' ) horaf
FROM tbl_comites 
WHERE com_clave_int = '".$id."' ");
$rown= mysqli_fetch_array($conn);
$fechacom=$rown['fecha'];
$hoicom=$rown['horai'];
$hofcom=$rown['horaf'];

?>
<style>
    .titulo{

        padding-top: 7px;
        padding-bottom: 7px;
        text-align: center;
        
        background-color: #dad8d8;
      

    }
    #doc{
     margin-left: 385px;
    }
    h3{
        display: flex;
        justify-items: center;
    }
    .titulo1{
        padding-top: 7px;
        padding-bottom: 7px;
        text-align: center;
        background-color:#dad8d8;
    }
    .contenido{
        padding: 3px;
        text-align: left;
    }
</style>
<page backtop="5mm" backleft="1mm" backright="5mm" backbottom="1mm" footer="page" style="font-size: 18px">
    <page_header>
    </page_header>
    <page_footer>
    <p class="login-box-msg  bg-cyan"  style="border-bottom-left-radius:20px ; border-bottom-right-radius: 20px;">
 <small>CONTROL ACTAS Y COMITÉS      - PAVAS S.A.S.</small>
 <small id="doc"> Doc N° <?php echo $rown['com_clave_int']; ?></small>
  </p>
    </page_footer>
    <div style="width: 650px">
        <table border="0" style="width: 100%" >
				<tr> 
					<th style="height: 30px; padding-top:5px; margin-left:10px;  text-align: center; font-size:30px; " colspan="5">  <?php echo $rown['com_nombre']; ?></th>
                </tr>
                <tr>
                    <th style="text-align: center; width: 230px;" >Fecha: <?php echo $rown['fecha']; ?></th>
                    <th style="text-align: center; width: 230px;" >Hora de inicio: <?php echo $rown['horai']; ?></th>
                    <th style="text-align: center; width: 230px;" >Hora fin: <?php echo $rown['horaf']; ?></th>
                </tr>
        </table>
        <table border="0" style="width: 100%" >
            <tbody>
                <tr>
               
                    <td colspan="3">
                    
                        <table border="1" style="width: 100%" cellspacing="0" cellspading="0">
                        
                            <tbody>
                                <tr>
                                    <th colspan="3" style="text-align: center; font-size:25px; padding-top: 35px; " border="0"> PARTICIPANTES</th>
                                </tr>
                                <tr>
                                    <th class="titulo1">N°</th>
                                    <th class="titulo1" style="width: 100px;">Nombres</th>
                                    <th class="titulo1" style="width: 200px;">Correo</th>
                                   
                                </tr>
                                <?php 
                                $i=1;
                                while ($i <= $rowp) { 
                                    while ($rowpp= mysqli_fetch_array($conp)) {
                                ?>
                                <tr>
                                <?php
                                    
                                    ?> 
                                    <td class="contenido"><?php echo  $i?></td>
                                    <?php
                                        
                                        ?>
                                    <td class="contenido"  style="width: 330px;"><?php echo $rowpp['usu_nombre'];?>  <?php echo  $rowpp['usu_apellido'];?></td>
                                    <td class="contenido"  style="width: 310px;"><?php echo $rowpp['usu_correo'];?></td>
                                </tr>
                                <?php
                                        $i++;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php
                if($rowss>0){
                ?>
                <tr>
                    <td colspan="3">
                 
                        <table border="1" style="width: 100%" cellspacing="0" cellspading="0">
                            <tbody>
                                <tr >
                                    <th colspan="2" style="text-align: center; font-size:25px; padding-top: 35px;" border="0"> TEMAS GENERALES</th>
                                </tr>
                                <tr>
                                    <th class="titulo1">N°</th>
                                    <th class="titulo1" style="width: 655px;">Desarrollo</th>
                                </tr>
                                <?php 
                                $i=1;
                                while ($i <= $rowss) { 
                                    while ($row= mysqli_fetch_array($con)) {
                                ?>
                                <tr>
                                <?php
                                    ?> 
                                     <td class="contenido"><?php echo  $i?></td>
                                     <?php
                                        
                                        ?>
                                    <td class="contenido"  style="width: 655px;"><?php echo $row['obc_desarrollo']; ?></td>
                                </tr>
                                <?php
                                        $i++;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <?php
                }
                if($rows>0){
                ?>
                <tr>
                    <td colspan="3">
                   
                        <table border="1" style="width: 100%" cellspacing="0" cellspading="0">
                            <tbody>
                                 <tr>
                                    <th colspan="4" style="text-align: center;  font-size:25px; padding-top: 35px;  " border="0"> COMPROMISOS</th>
                                </tr>
                                <tr>
                                    <th class="titulo">N°</th>
                                    <th class="titulo" style="width: 360px;">Desarrollo</th>
                                    <th class="titulo" style="width: 155px;">Participantes</th>                                  
                                    <th class="titulo" style="width: 120px;">Cumplimiento</th>
                                </tr>
                                <?php
                                $i=1;
                                while ($i <= $rows) { 
                                    while ($row = mysqli_fetch_array($conv)) {                                        
                                    ?>
                                <tr> 
                                
                                    <td class="contenido"><?php echo $i; ?></td>
                                    
                                    <td class="contenido" style="width: 360px;" ><?php echo $row['obc_desarrollo']; ?></td>
                                    <td class="contenido" style="width: 155px; text-align: center;"><?php echo $row['usu_nombre'];?>  <?php echo  $row['usu_apellido'];?></td>
                                    <td class="contenido" style=" text-align: center;"><?php echo $row['obc_fechcumpli']; ?></td>
                                </tr>
                                <?php
                                 $i++;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table> 
    </div>
</page>