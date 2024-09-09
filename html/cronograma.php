<?php
session_start();


if (!isset($_SESSION['username'])) {
  echo "Not Found
The requested URL was not found on this server.";
  exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>Página de Inicio - Escuela Jipijapa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="../upload/WhatsApp Image 2024-07-14 at 23.10.40-Photoroom.ico" type="image/x-icon">
    <link rel="stylesheet" href="..\style\cronograma.css">
</head>
<body>
<div class="barra-menu">
  <div class="izquierda">
    <div class="usuario">Hola <?php echo htmlspecialchars($username); ?></div>
    <a href="../html/perfil.php" class="">Ver Perfil</a>
  </div>
  <div class="derecha">
    <a href="../html/mis_actividades.php">Mis Actividades</a>
    <a href="../html/guardar_actividad.php">Guardar actividad</a>
    <a href="../html/cerrarsesion.php">Cerrar Sesión</a>
  </div>
</div>

  <div class="container table-container">
    <?php
    include("../conexion.php");

    // Si se envió un formulario para guardar una actividad
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar'])) {
        $codigoActividad = $_POST['codigo'];
        
        // Verificar si la actividad ya está guardada
        $checkQuery = "SELECT * FROM user_activities WHERE usuario = ? AND activity_code = ?";
        $stmtCheck = $conn->prepare($checkQuery);
        $stmtCheck->bind_param("ss", $username, $codigoActividad);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows == 0) { // Si no está guardada, insertar
            $insertQuery = "INSERT INTO user_activities (usuario, activity_code) VALUES (?, ?)";
            $stmtInsert = $conn->prepare($insertQuery);
            $stmtInsert->bind_param("ss", $username, $codigoActividad);

            if ($stmtInsert->execute()) {
              header("Location: " . $_SERVER['PHP_SELF']);
              exit();
          } else {
              echo "<p>Error al guardar la actividad.</p>";
          }

          $stmtInsert->close();
      } else {
          echo "<p>Ya has guardado esta actividad.</p>";
      }

      $stmtCheck->close();
    }

    // Consulta para mostrar todas las actividades
    $consulta = "SELECT * FROM actividad";
    if ($resultado = $conn->query($consulta)) {
        echo '<table class="table table-bordered table-hover" id="tabla_datos">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Finalización</th>
                        <th>Descripción</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>';
        while ($filas = $resultado->fetch_assoc()) {
            echo '<tr>
                    <td>' . htmlspecialchars($filas["codigo"]) . '</td>
                    <td>' . htmlspecialchars($filas["nombre"]) . '</td>
                    <td>' . htmlspecialchars($filas["fecha_inicio"]) . '</td>
                    <td>' . htmlspecialchars($filas["fecha_final"]) . '</td>
                    <td>' . htmlspecialchars($filas["descripcion"]) . '</td>
                    <td>
                        <form method="POST" style="display:inline-block;">
                            <input type="hidden" name="codigo" value="' . htmlspecialchars($filas["codigo"]) . '">
                            <button type="submit" name="guardar" class="btn btn-success btn-sm">Guardar</button>
                        </form>
                    </td>
                </tr>';
        }
        echo '</tbody>
              </table>';
        $resultado->free();
    }
    mysqli_close($conn);
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
