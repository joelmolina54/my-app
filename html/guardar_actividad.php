<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Actividad</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../upload/WhatsApp Image 2024-07-14 at 23.10.40-Photoroom.ico" type="image/x-icon">
</head>
<body>
    <div class="container mt-5">
        <h2>Registrar Actividad</h2>
        <form action="register_activity.php" method="post">
            <div class="form-group">
                <label for="activity_code">Código de la Actividad:</label>
                <input type="text" id="activity_code" name="activity_code" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Actividad</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
