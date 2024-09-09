<?php
session_start();
include '../conexion.php';


if (!isset($_SESSION['username'])) {
    echo "Por favor, inicia sesión para registrar actividades.";
    exit();
}

$usuario = $_SESSION['username']; 
$activity_code = $_POST['activity_code'];


$sql = "SELECT codigo FROM actividad WHERE codigo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $activity_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Actividad no encontrada.";
    exit();
}


$sql = "SELECT * FROM user_activities WHERE usuario = ? AND activity_code = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $activity_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Esta actividad ya está registrada en tus actividades.";
    exit();
}


$sql = "INSERT INTO user_activities (usuario, activity_code) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $activity_code);

if ($stmt->execute()) {
    echo "Actividad registrada con éxito.";
} else {
    echo "Error al registrar la actividad.";
}

$stmt->close();
$conn->close();
?>
