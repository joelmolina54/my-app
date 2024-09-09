<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "actividades";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_POST['username'];
$pass = $_POST['password'];


$sql = "INSERT INTO usuario (usuario, contrasena) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user, $pass);

if ($stmt->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>