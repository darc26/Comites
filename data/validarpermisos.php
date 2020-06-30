<?php

$sqlp1 = mysqli_query($conectar,"SELECT per_clave_int, usu_clave_int FROM tbl_permisos_usuarios WHERE per_clave_int = '1' and usu_clave_int ='".$idUsuario."' ");
$p1 = mysqli_num_rows($sqlp1);

$sqlp2 = mysqli_query($conectar,"SELECT per_clave_int, usu_clave_int FROM tbl_permisos_usuarios WHERE per_clave_int = '2' and usu_clave_int ='".$idUsuario."' ");
$p2 = mysqli_num_rows($sqlp2);

$sqlp3 = mysqli_query($conectar,"SELECT per_clave_int, usu_clave_int FROM tbl_permisos_usuarios WHERE per_clave_int = '3' and usu_clave_int ='".$idUsuario."' ");
$p3 = mysqli_num_rows($sqlp3);

$sqlp4 = mysqli_query($conectar,"SELECT per_clave_int, usu_clave_int FROM tbl_permisos_usuarios WHERE per_clave_int = '4' and usu_clave_int ='".$idUsuario."' ");
$p4 = mysqli_num_rows($sqlp4);

$sqlp5 = mysqli_query($conectar,"SELECT per_clave_int, usu_clave_int FROM tbl_permisos_usuarios WHERE per_clave_int = '5' and usu_clave_int ='".$idUsuario."' ");
$p5 = mysqli_num_rows($sqlp5);

$sqlp6 = mysqli_query($conectar,"SELECT per_clave_int, usu_clave_int FROM tbl_permisos_usuarios WHERE per_clave_int = '6' and usu_clave_int ='".$idUsuario."' ");
$p6 = mysqli_num_rows($sqlp6);

$sqlp7 = mysqli_query($conectar,"SELECT per_clave_int, usu_clave_int FROM tbl_permisos_usuarios WHERE per_clave_int = '7' and usu_clave_int ='".$idUsuario."' ");
$p7 = mysqli_num_rows($sqlp7);

$sqlp8 = mysqli_query($conectar,"SELECT per_clave_int, usu_clave_int FROM tbl_permisos_usuarios WHERE per_clave_int = '8' and usu_clave_int ='".$idUsuario."' ");
$p8 = mysqli_num_rows($sqlp8);

$sqlp9 = mysqli_query($conectar,"SELECT per_clave_int, usu_clave_int FROM tbl_permisos_usuarios WHERE per_clave_int = '9' and usu_clave_int ='".$idUsuario."' ");
$p9 = mysqli_num_rows($sqlp9);

$sqlp10 = mysqli_query($conectar,"SELECT per_clave_int, usu_clave_int FROM tbl_permisos_usuarios WHERE per_clave_int = '10' and usu_clave_int ='".$idUsuario."' ");
$p10 = mysqli_num_rows($sqlp10);

$sqlp11 = mysqli_query($conectar,"SELECT per_clave_int, usu_clave_int FROM tbl_permisos_usuarios WHERE per_clave_int = '11' and usu_clave_int ='".$idUsuario."' ");
$p11 = mysqli_num_rows($sqlp11);

$sqlp12 = mysqli_query($conectar,"SELECT per_clave_int, usu_clave_int FROM tbl_permisos_usuarios WHERE per_clave_int = '12' and usu_clave_int ='".$idUsuario."' ");
$p12 = mysqli_num_rows($sqlp12);

$sqlp13 = mysqli_query($conectar,"SELECT per_clave_int, usu_clave_int FROM tbl_permisos_usuarios WHERE per_clave_int = '13' and usu_clave_int ='".$idUsuario."' ");
$p13 = mysqli_num_rows($sqlp13);

