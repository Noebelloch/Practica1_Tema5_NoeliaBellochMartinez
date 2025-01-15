<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Login</title>
</head>
<body>
    <form action="login.php" method="post">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="rol">Rol:</label>
        <select id="rol" name="rol">
            <option value="estandar">Estándar</option>
            <option value="admin">Admin</option>
        </select><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    // Conexión a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'practica_asir');
    if ($conexion->connect_errno) {
        die('Lo siento, hubo un problema con el servidor');
    }

    // Consulta preparada para verificar las credenciales
    $sql = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ? AND password = ? AND rol = ?");
    $sql->bind_param("sss", $nombre_usuario, $password, $rol);
    $sql->execute();
    $resultado = $sql->get_result();

    if ($resultado->num_rows > 0) {
        $user = $resultado->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
        $_SESSION['rol'] = $user['rol'];
        header('Location: menu.php');
        exit();
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }

    $sql->close();
    $conexion->close();
}
?>
