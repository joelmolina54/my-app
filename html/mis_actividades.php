<?php
session_start();
include '../conexion.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['username'])) {
    echo "Por favor, inicia sesión para ver tus actividades.";
    exit();
}

$usuario = $_SESSION['username'];

// Consulta para obtener la foto del usuario
$sqlFoto = "SELECT foto FROM usuario WHERE usuario = ?";
$stmtFoto = $conn->prepare($sqlFoto);
$stmtFoto->bind_param("s", $usuario);
$stmtFoto->execute();
$resultFoto = $stmtFoto->get_result();

if ($resultFoto->num_rows > 0) {
    $fila = $resultFoto->fetch_assoc();
    $foto = $fila['foto'];
} else {
    echo "No se encontró el perfil del usuario.";
    exit();
}

$stmtFoto->close();

// Manejar la eliminación de la relación usuario-actividad
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    $codigoEliminar = $_POST['codigo'];

    $sqlEliminar = "DELETE FROM user_activities WHERE usuario = ? AND activity_code = ?";
    $stmtEliminar = $conn->prepare($sqlEliminar);
    $stmtEliminar->bind_param("ss", $usuario, $codigoEliminar);

    if ($stmtEliminar->execute()) {
        // Muestra un mensaje y luego redirige usando JavaScript
        echo "<p>Actividad eliminada correctamente de tus actividades.</p>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'mis_actividades.php';
                }, 1000);
              </script>";
    } else {
        echo "<p>Error al eliminar la actividad de tus actividades.</p>";
    }

    $stmtEliminar->close();
}

// Consulta para obtener las actividades del usuario
$sqlActividades = "SELECT a.codigo, a.nombre, a.descripcion, a.fecha_inicio, a.fecha_final 
                    FROM actividad a
                    JOIN user_activities ua ON a.codigo = ua.activity_code
                    WHERE ua.usuario = ?";
$stmtActividades = $conn->prepare($sqlActividades);
$stmtActividades->bind_param("s", $usuario);
$stmtActividades->execute();
$resultActividades = $stmtActividades->get_result();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Página de Inicio - Escuela Jipijapa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../upload/WhatsApp Image 2024-07-14 at 23.10.40-Photoroom.ico" type="image/x-icon">
    <link rel="stylesheet" href="..\style\mis_actividades.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>


    <div class="barra-menu">
        <div class="izquierda">
        <a href="cronograma.php">Inicio</a> 
        <a href="../html/perfil.php" class="">Ver Perfil</a>
        <a href="../html/cerrarsesion.php">Cerrar Sesión</a>
        </div>
        <div class="derecha">
            <img src="../upload/<?php echo htmlspecialchars($foto); ?>" alt="Foto de perfil"
                class="w-18 h-20 rounded-full mx-auto flex"> 
        </div>
    </div>

    <div class="container table-container">
        <?php
        if ($resultActividades->num_rows > 0) {
            echo '<table class="table table-bordered table-hover" id="tabla_datos">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Fecha inicio</th>
                            <th>Fecha finalizacion</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            while ($filas = $resultActividades->fetch_assoc()) {
                echo '<tr>
                        <td>' . htmlspecialchars($filas["codigo"]) . '</td>
                        <td>' . htmlspecialchars($filas["nombre"]) . '</td>
                        <td>' . htmlspecialchars($filas["fecha_inicio"]) . '</td>
                        <td>' . htmlspecialchars($filas["fecha_final"]) . '</td>
                        <td>' . htmlspecialchars($filas["descripcion"]) . '</td>
                        <td>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="codigo" value="' . htmlspecialchars($filas["codigo"]) . '">
                                <button type="submit" name="eliminar" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>';
            }
            
            echo '</tbody>
                </table>';
        } else {
            echo '<p>No tienes actividades registradas.</p>';
        }

        // Liberar el resultado y cerrar la conexión
        $resultActividades->free();
        $stmtActividades->close(); // Cierra el statement preparado
        $conn->close(); // Cierra la conexión a la base de datos
        ?>
    </div>

    <script>
    $(document).ready(function() {
        $('#tabla_datos').DataTable({
            "language": {
                "url": "config/espaniol.json"
            }
        });
    });
    </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</body>

</html>