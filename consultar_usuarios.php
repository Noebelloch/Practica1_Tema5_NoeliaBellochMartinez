<?php
session_start();

// Comprobar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener el nombre de usuario y rol del usuario logueado
$nombre_usuario = $_SESSION['user_id']; // Consistencia en el nombre de la sesión
$rol = $_SESSION['rol'];

// Verificar los valores de sesión
echo "Usuario: " . htmlspecialchars($nombre_usuario) . "<br>";
echo "Rol: " . htmlspecialchars($rol) . "<br>";

// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'practica_asir'); // Actualiza con tu información de conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si la conexión fue exitosa
echo "Conexión exitosa<br>";

if ($rol == 'admin') {
    // Consultar todos los usuarios
    $sql = "SELECT id, nombre_usuario, rol FROM usuarios";
} else {
    // Consultar solo los propios datos
    $sql = "SELECT id, nombre_usuario, rol FROM usuarios WHERE nombre_usuario = ?";
}

$stmt = $conn->prepare($sql);
if ($rol != 'admin') {
    $stmt->bind_param("s", $nombre_usuario);
}

$stmt->execute();
$result = $stmt->get_result();

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    echo "Usuarios encontrados:<br>";
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . htmlspecialchars($row['id']) . " - Nombre de Usuario: " . htmlspecialchars($row['nombre_usuario']) . " - Rol: " . htmlspecialchars($row['rol']) . "<br>";
    }
} else {
    echo "No se encontraron usuarios.<br>";
}

// Guardar los resultados en un array
$usuarios = [];
while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();

// Devuelve los datos de los usuarios para su uso posterior
return $usuarios;
?>
