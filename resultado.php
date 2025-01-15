<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$nombre_usuario = $_SESSION['nombre_usuario'];
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos del Usuario</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $nombre_usuario; ?>!</h1>
    <p>Tu ID de usuario es: <?php echo $user_id; ?></p>
    <p>Tu rol es: <?php echo $rol; ?></p>
</body>
</html>
