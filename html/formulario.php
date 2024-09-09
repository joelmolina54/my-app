<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container m-3">
        <div class="row">
            <div class="col">
                <form action="../html/registro_producto.php" method="post">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="cod_act" placeholder="Código de actividad" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="n_act" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <input type="date" class="form-control" name="fecha1" placeholder="Fecha de inicio" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="fecha2" placeholder="Fecha de finalización" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="descripcion" placeholder="Descripción" rows="3" required></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Enviar">
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
