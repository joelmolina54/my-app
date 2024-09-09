<?php
session_start();
include '../conexion.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Verifica si se ha enviado un código para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    $codigoEliminar = $_POST['codigo'];

    // Consulta para eliminar la actividad
    $sqlEliminar = "DELETE FROM actividad WHERE codigo = ?";
    $stmtEliminar = $conn->prepare($sqlEliminar);
    $stmtEliminar->bind_param("s", $codigoEliminar);

    if ($stmtEliminar->execute()) {
        echo "<p>Actividad eliminada correctamente.</p>";
    } else {
        echo "<p>Error al eliminar la actividad.</p>";
    }

    $stmtEliminar->close();
}

// Redirige de vuelta a la página de actividades
header("Location: ../html/cronograma_admin.php");
exit();
?>
