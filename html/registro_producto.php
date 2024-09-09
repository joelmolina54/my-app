<?php
include("../conexion.php");
$codigo = $conn->real_escape_string($_POST["cod_act"]);
$nombre1 = $conn->real_escape_string($_POST["n_act"]);
$fecha_inicio1 =  $conn->real_escape_string($_POST["fecha1"]);
$fecha_finalizacion1 =  $conn->real_escape_string($_POST["fecha2"]);
$descripcion1 = $conn->real_escape_string($_POST ["descripcion"] );

$sql = "INSERT INTO actividad (codigo, nombre,fecha_inicio,fecha_final,descripcion)
        VALUES ('$codigo','$nombre1','$fecha_inicio1','$fecha_finalizacion1', '$descripcion1')";

$conn->query($sql);
echo "ACTIVIDAD REGISTRADA.";
$conn->close();
?>
