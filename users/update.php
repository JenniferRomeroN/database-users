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
    $name = mysqli_real_escape_string($connection, $data['name']);
    $lastName = mysqli_real_escape_string($connection, $data['lastName']);
    $gender = mysqli_real_escape_string($connection, $data['gender']);
    $date = mysqli_real_escape_string($connection, $data['date']);

    // Actualizar datos en la tabla
    $updateData = "UPDATE user SET name='$name', lastName='$lastName', gender='$gender', date='$date' WHERE id='$userId'";

    if (mysqli_query($connection, $updateData)) {
        echo json_encode(['status' => 'success', 'message' => 'Usuario actualizado con éxito']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el usuario: ' . mysqli_error($connection)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se recibió el ID del usuario.']);
}

// Cerrar la conexión
mysqli_close($connection);
?>
