<?php
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Users</title>
</head>
<body>
    <!-- navbar -->
    <!-- As a heading -->
    <nav class="navbar">
        <div class="container-fluid">
            <span class="navbar-brand">Register</span>
        </div>
    </nav>
    <div class="container">
        <div class="card">
            <form name="users" method="post" id="user">
                <div class="form-group row">
                    <label name="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name = "name"placeholder="Name..">
                    </div>
                </div>
        
                <div class="form-group row">
                    <label name="lastName" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lastName" name ="lastName" placeholder="Last Name..">
                    </div>
                </div>
        
                <div class="form-group row">
                    <label name="gender" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <select name="gender" class="form-control">
                            <option selected>Choose...</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
        
                <div class="form-group row">
                    <label for="date" class="col-sm-2 col-form-label" name="date">Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="date" pattern="\d{4}-\d{2}-\d{2}">
                    </div>
                </div>
        
                <div class="form-group row container-button">
                <button type="submit" class="btn btn-primary button" name="submit" id="buttonSubmit">Submit</button>

                </div>

<script src="javascript/script.js"></script>
</body>
</html>

<?php
    if(isset($_POST['submit'])){
        // Escapar datos para evitar inyecciones SQL
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
        $gender = mysqli_real_escape_string($connection, $_POST['gender']);
        $date = mysqli_real_escape_string($connection, $_POST['date']);

        // Insertar datos en la tabla, especificando las columnas
        $insertData = "INSERT INTO user (name, lastName, gender, date) VALUES ('$name', '$lastName', '$gender', '$date')";

        // Ejecutar la consulta
        if (mysqli_query($connection, $insertData)) {
            echo "Datos insertados correctamente";
        } else {
            echo "Error al insertar datos: " . mysqli_error($connection);
        }
    }

    // Cerrar la conexión
    mysqli_close($connection);
?>
