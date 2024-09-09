<?php
session_start(); 

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio - Escuela Jipijapa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="icon" href="../upload/WhatsApp Image 2024-07-14 at 23.10.40-Photoroom.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style/cronograma_admin.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <header class="bg-success text-white p-3 mb-4">
        <div class="container">
            <h1>Hola, <?php echo $username; ?>!</h1>
            <a href="formulario.php" class="btn btn-light btn-lg">Registrar una nueva actividad</a>
        </div>
    </header>

    <div class="container">
        <h2 class="mb-4">Actividades Registradas</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tabla_datos">
                <thead class="table-dark">
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Fecha inicio</th>
                        <th>Fecha finalización</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("../conexion.php");
                    $consulta = "SELECT * FROM actividad";
                    if ($resultado = $conn->query($consulta)) {
                        while ($filas = $resultado->fetch_assoc()) {
                            echo '<tr>
                                    <td>' . htmlspecialchars($filas["codigo"]) . '</td>
                                    <td>' . htmlspecialchars($filas["nombre"]) . '</td>
                                    <td>' . htmlspecialchars($filas["fecha_inicio"]) . '</td>
                                    <td>' . htmlspecialchars($filas["fecha_final"]) . '</td>
                                    <td>' . htmlspecialchars($filas["descripcion"]) . '</td>
                                    <td>
                                        <form method="POST" style="display:inline-block;" action="../html/eliminar_actividad.php">
                                            <input type="hidden" name="codigo" value="' . htmlspecialchars($filas["codigo"]) . '">
                                            <button type="submit" name="eliminar" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>';
                        }
                        $resultado->free();
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>

            </table>
        </div>
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
    
</body>
</html>
