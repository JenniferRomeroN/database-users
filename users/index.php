<?php
// Permitir todas las solicitudes de origen cruzado (para desarrollo local)
//accede al recurso desde cualquier origen con *
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");


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

// Leer el cuerpo de la solicitud (los datos enviados por fetch)
$input = file_get_contents('php://input');
$data = json_decode($input, true); // Convertir JSON a un array asociativo

// Verificar que se recibieron los datos correctamente
if (isset($data['name']) && isset($data['lastName']) && isset($data['gender']) && isset($data['date'])) {
    // Escapar datos para evitar inyecciones SQL
    $name = mysqli_real_escape_string($connection, $data['name']);
    $lastName = mysqli_real_escape_string($connection, $data['lastName']);
    $gender = mysqli_real_escape_string($connection, $data['gender']);
    $date = mysqli_real_escape_string($connection, $data['date']);

    // Insertar datos en la tabla
    $insertData = "INSERT INTO user (name, lastName, gender, date) VALUES ('$name', '$lastName', '$gender', '$date')";

    // Ejecutar la consulta
    if (mysqli_query($connection, $insertData)) {
        echo "Datos insertados correctamente";
    } else {
        echo "Error al insertar datos: " . mysqli_error($connection);
    }
} else {
    echo "No se recibieron todos los datos necesarios.";
}

// Cerrar la conexión
mysqli_close($connection);
?>
