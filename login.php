<?php
session_start();
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "actividades";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuario WHERE usuario = ? AND contrasena = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error al preparar la consulta: " . $conn->error);
}

$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    $_SESSION['username'] = $username;
    
    if ($user['rol'] == 'admin') {
        header("Location: ..\actividades\html\cronograma_admin.php");
    } else {
        header("Location: ..\actividades\html\cronograma.php");
    }
    exit();
} else {
    echo "Usuario o contraseña incorrectos";
}

$stmt->close();
$conn->close();
?>

