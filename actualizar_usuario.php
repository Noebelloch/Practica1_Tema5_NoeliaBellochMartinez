<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    // Conexión a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'practica_asir');
    if ($conexion->connect_errno) {
        die('Lo siento, hubo un problema con el servidor');
    }

    // Actualización del usuario
    $sql = $conexion->prepare("UPDATE usuarios SET nombre_usuario = ?, password = ?, rol = ? WHERE id = ?");
    $sql->bind_param("sssi", $nombre_usuario, $password, $rol, $user_id);
    if ($sql->execute()) {
        echo "¡Usuario actualizado exitosamente!";
    } else {
        echo "Error al actualizar el usuario.";
    }

    $sql->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Usuario</title>
</head>
<body>
    <h1>Actualizar Usuario</h1>
    <form action="actualizar_usuario.php" method="post">
        <label for="user_id">ID de Usuario:</label>
        <input type="text" id="user_id" name="user_id" required><br>
        <label for="nombre_usuario">Nuevo Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required><br>
        <label for="password">Nueva Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="rol">Nuevo Rol:</label>
        <select id="rol" name="rol">
            <option value="estandar">Estándar</option>
            <option value="admin">Admin</option>
        </select><br>
        <input type="submit" value="Actualizar Usuario">
    </form>
</body>
</html>
