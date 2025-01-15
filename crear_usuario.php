<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    // Conexión a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'practica_asir');
    if ($conexion->connect_errno) {
        die('Lo siento, hubo un problema con el servidor');
    }

    // Inserción del nuevo usuario
    $sql = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, password, rol) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $nombre_usuario, $password, $rol);
    if ($sql->execute()) {
        echo "¡Usuario creado exitosamente!";
    } else {
        echo "Error al crear el usuario.";
    }

    $sql->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
</head>
<body>
    <h1>Crear Usuario</h1>
    <form action="crear_usuario.php" method="post">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="rol">Rol:</label>
        <select id="rol" name="rol">
            <option value="estandar">Estándar</option>
            <option value="admin">Admin</option>
        </select><br>
        <input type="submit" value="Crear Usuario">
    </form>
</body>
</html>
