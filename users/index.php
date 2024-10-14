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
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si la solicitud es AJAX
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($isAjax) {
    error_log('Solicitud AJAX recibida');
    // Decodificar el JSON recibido
    $input = file_get_contents('php://input');
    error_log('Datos recibidos: ' . $input);  // Depuración
    $data = json_decode($input, true);
    
    // Verificar si se recibieron los datos
    if (isset($data['name']) && isset($data['lastName']) && isset($data['gender']) && isset($data['date'])) {
        // Procesar e insertar en la base de datos
        $name = mysqli_real_escape_string($connection, $data['name']);
        $lastName = mysqli_real_escape_string($connection, $data['lastName']);
        $gender = mysqli_real_escape_string($connection, $data['gender']);
        $date = mysqli_real_escape_string($connection, $data['date']);
        
        $insertData = "INSERT INTO user (name, lastName, gender, date) VALUES ('$name', '$lastName', '$gender', '$date')";
        
        if (mysqli_query($connection, $insertData)) {
            echo json_encode(['status' => 'success', 'message' => 'Datos enviados con JS']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al insertar datos: ' . mysqli_error($connection)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se recibieron todos los datos necesarios.']);
    }
} else {
    // Procesar datos de envío tradicional (POST sin AJAX)
    if (isset($_POST['name']) && isset($_POST['lastName']) && isset($_POST['gender']) && isset($_POST['date'])) {
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
        $gender = mysqli_real_escape_string($connection, $_POST['gender']);
        $date = mysqli_real_escape_string($connection, $_POST['date']);
        
        $insertData = "INSERT INTO user (name, lastName, gender, date) VALUES ('$name', '$lastName', '$gender', '$date')";
        
        if (mysqli_query($connection, $insertData)) {
            echo json_encode(['status' => 'success', 'message' => 'Datos enviados con PHP']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al insertar datos: ' . mysqli_error($connection)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Datos enviados con JS.']);
    }
}

// Cerrar la conexión
mysqli_close($connection);
?>