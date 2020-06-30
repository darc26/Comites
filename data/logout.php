<?php

session_start();
setcookie("usuarioTrilladora", "", time() - 3600, "/");
setcookie("idusuarioTrilladora", "", time() - 3600, "/");
//setcookie("clave", "", time() - 3600, "/");
session_destroy();
header("LOCATION:../index.php");
?>