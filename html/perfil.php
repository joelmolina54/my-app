<?php
session_start();
include '../conexion.php';

if (!isset($_SESSION['username'])) {
    echo "Por favor, inicia sesión para ver tu perfil.";
    exit();
}

$usuario = $_SESSION['username'];

$sql = "SELECT foto FROM usuario WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $fila = $result->fetch_assoc();
    $foto = $fila['foto'];
} else {
    echo "No se encontró el perfil del usuario.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Escuela Jipijapa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="../upload/WhatsApp Image 2024-07-14 at 23.10.40-Photoroom.ico" type="image/x-icon">
    <style>
    body {
        background-image: url("../upload/WhatsApp\ Image\ 2024-08-13\ at\ 19.24.49.jpeg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    </style>
</head>

<body class="bg-gray-100 text-gray-900">
    <nav class="bg-green-600 p-4 flex justify-between items-center p-6">
        <a href="cronograma.php" class="text-white text-xl pl-1 ">&larr; Volver</a>
        <h1 class="text-2xl text-white font-semibold pl-1 pr-4">Perfil de Usuario - Escuela Jipijapa</h1>
    </nav>
    <div class="container mx-auto mt-8 p-4 flex justify-between items-start space-x-4">

        <section class="w-full md:w-1/2 bg-white bg-opacity-80 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-green-800 mb-4">¡Gracias por ser parte de nuestra comunidad!</h2>
            <p class="mb-4 text-gray-700">
                Querido usuario, en nombre de <strong class="text-green-800 mb-4">La escuela Jipijapa</strong>, estamos
                verdaderamente agradecidos
                de que hayas
                decidido ser parte de nuestra comunidad. Sabemos que hoy en día existen muchas opciones disponibles, por
                lo que valoramos enormemente tu confianza al elegirnos como tu plataforma de actividades.
            </p>
            <p class="mb-4 text-gray-700">
                Nuestro equipo trabaja con pasión y dedicación para asegurarse de que cada actividad esté a la altura de
                tus expectativas y te permita desarrollar nuevas habilidades, explorar tus intereses, y conectar con
                personas que comparten tus mismas pasiones.
            </p>
            <p class="mb-4 text-gray-700">
                Esperamos que disfrutes cada momento aquí y que las actividades que ofrecemos sigan siendo una fuente de
                inspiración, aprendizaje y entretenimiento para ti. Siempre estamos aquí para escuchar tus sugerencias y
                mejorar, porque queremos que tu experiencia sea la mejor posible.
            </p>
            <p class="mb-4 text-gray-700">
                Gracias de nuevo por ser parte de las actividades de la <strong class="text-green-800 mb-4">La escuela
                    Jipijapa</strong>. Tu
                entusiasmo y participación son
                la razón por la que hacemos lo que hacemos.
            </p>
            <p class="mb-4 text-gray-700">
                ¡Te deseamos lo mejor en todas tus actividades y esperamos verte por aquí con frecuencia!
            </p>
            <p class="mb-4 text-gray-700">
                Con gratitud,
            </p>
            <p class="text-gray-700">
                El equipo de <strong class="text-green-800 mb-4">La escuela Jipijapa</strong>
            </p>
            <!-- link -->
            <a href="../html/politicas.php">
                <!-- politicas -->
                 Ver Politicas de seguridad de <strong class="text-green-800 mb-4">La escuela Jipijapa</strong>
            </a>

        </section>

        <section class="w-full md:w-1/2 bg-white bg-opacity-90  p-6 rounded-lg shadow-md items-center justify-between">
            <h2 class="text-xl font-bold text-green-800 mb-4 text-center">Perfil de
                <?php echo htmlspecialchars($usuario); ?></h2>
            <div class="img_perfil mb-4r">
                <img class="w-32 h-35 rounded-full mx-auto pb-5" src="../upload/<?php echo htmlspecialchars($foto); ?>"
                    alt="Foto de perfil">
            </div>
            <p class="mb-4 text-gray-700 text-center">Nombre: <?php echo htmlspecialchars($usuario); ?></p>

            <form action="subir_foto.php" method="post" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Cambiar foto de
                        perfil:</label>
                    <input type="file" name="foto" id="foto" accept="image/*" required
                        class="block w-full text-sm text-black-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-500 file:text-green-700 hover:file:bg-green-200">
                </div>
                <button class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700" type="submit">Subir
                    Foto</button>
            </form>
        </section>
    </div>
</body>

</html>