<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];

    // Conexión a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'practica_asir');
    if ($conexion->connect_errno) {
        die('Lo siento, hubo un problema con el servidor');
    }

    // Eliminación del usuario
    $sql = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
    $sql->bind_param("i", $user_id);
    if ($sql->execute()) {
        echo "¡Usuario eliminado exitosamente!";
    } else {
        echo "Error al eliminar el usuario.";
    }

    $sql->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Borrar Usuario</title>
</head>
<body>
    <h1>Borrar Usuario</h1>
    <form action="borrar_usuario.php" method="post">
        <label for="user_id">ID de Usuario:</label>
        <input type="text" id="user_id" name="user_id" required><br>
        <input type="submit" value="Borrar Usuario">
    </form>
</body>
</html>
