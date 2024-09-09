<?php
$servidor = "localhost";
$base_datos = "actividades";
$usuario = "root";
$clave = "";

$conn = new mysqli($servidor, $usuario, $clave , $base_datos);


if (!$conn)
 {
    die("Connectciòn Fallida: " . mysqli_connect_error());
}


?>