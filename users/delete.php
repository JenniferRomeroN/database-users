<?php
// Permitir todas las solicitudes de origen cruzado (para desarrollo local)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

$servidor = "localhost";
$user = "root";
$password = "";
$dataBase = "users";

// Conectar a la base de datos
$connection = mysqli_connect($servidor, $user, $password, $dataBase);

// Verificar conexión
if (!$connection) {
    die(json_encode(['status' => 'error', 'message' => 'Error de conexión: ' . mysqli_connect_error()]));
}

// Leer los datos enviados por AJAX
$input = file_get_contents('php://input');
$data = json_decode($input, true); // Convertir JSON a un array asociativo

if (isset($data['userId'])) {
    // Escapar datos para evitar inyecciones SQL
    $userId = mysqli_real_escape_string($connection, $data['userId']);

    // Eliminar datos de la tabla
    $deleteData = "DELETE FROM user WHERE id = '$userId'"; // Asegúrate de que 'id' sea el nombre correcto de tu columna

    if (mysqli_query($connection, $deleteData)) {
        echo json_encode(['status' => 'success', 'message' => 'Usuario eliminado con éxito']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el usuario: ' . mysqli_error($connection)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se recibió el ID del usuario.']);
}

// Cerrar la conexión
mysqli_close($connection);
?>
