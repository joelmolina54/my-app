<?php
session_start();
include '../conexion.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['username'])) {
    echo "Por favor, inicia sesión para cambiar tu foto de perfil.";
    exit();
}

$usuario = $_SESSION['username'];

// Verifica si se ha subido un archivo
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    // Obtener la información del archivo
    $fileTmpPath = $_FILES['foto']['tmp_name'];
    $fileName = $_FILES['foto']['name'];
    $fileSize = $_FILES['foto']['size'];
    $fileType = $_FILES['foto']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Definir la carpeta de destino y el nombre del archivo
    $uploadFileDir = '../upload/';
    $newFileName = $usuario . '.' . $fileExtension;
    $dest_path = $uploadFileDir . $newFileName;

    // Mover el archivo al directorio de destino
    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        // Actualizar la base de datos con la nueva foto
        $sql = "UPDATE usuario SET foto = ? WHERE usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $newFileName, $usuario);
        
        if ($stmt->execute()) {

            header("Location: perfil.php?status=success");
        } else {
            echo "Error al actualizar la foto en la base de datos.";
        }

        $stmt->close();
    } else {
        echo "Error al mover el archivo subido.";
    }
} else {
    echo "No se ha subido ningún archivo o ha ocurrido un error.";
}

$conn->close();
?>
