<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Principal</title>
</head>
<body>
    <h1>Menú Principal</h1>
    <?php if ($rol == 'admin') { ?>
        <h2>Opciones de Administrador</h2>
        <ul>
            <li><a href="crear_usuario.php">Crear Usuario</a></li>
            <li><a href="actualizar_usuario.php">Editar Usuario</a></li>
            <li><a href="borrar_usuario.php">Eliminar Usuario</a></li>
            <li><a href="consultar_usuarios.php">Consultar Todos los Usuarios</a></li>
        </ul>
    <?php } else { ?>
        <h2>Opciones de Usuario Estándar</h2>
        <ul>
            <li><a href="consultar_mis_datos.php">Consultar Mis Datos</a></li>
        </ul>
    <?php } ?>
    <br>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
