<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Dogeway";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Recibe los datos del formulario
$fechaIncidente = isset($_POST['fechaIncidente']) ? $_POST['fechaIncidente'] : '';
$usuarioReportado = isset($_POST['usuarioReport']) ? $_POST['usuarioReport'] : '';
$nombreUsuario = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : '';
$apellidoUsuario = isset($_POST['apellidoUsuario']) ? $_POST['apellidoUsuario'] : '';
$ubicacionIncidente = isset($_POST['ubicacionIncidente']) ? $_POST['ubicacionIncidente'] : '';
$detallesIncidente = isset($_POST['detallesIncidente']) ? $_POST['detallesIncidente'] : '';

// Verifica los datos antes de insertarlos
if (!empty($fechaIncidente) && !empty($usuarioReportado) && !empty($nombreUsuario) && !empty($apellidoUsuario) && !empty($ubicacionIncidente) && !empty($detallesIncidente)) {

    $fechaIncidente = date('Y-m-d', strtotime($fechaIncidente));

    // Realiza la inserción en la base de datos
    $sql = "INSERT INTO formulario_quejas (fecha_incidente, usuario_reportado, nombre_usuario, apellido_usuario, ubicacion_incidente, detalles_incidente) 
            VALUES ('$fechaIncidente', '$usuarioReportado', '$nombreUsuario', '$apellidoUsuario', '$ubicacionIncidente', '$detallesIncidente')";

    if ($conn->query($sql) === TRUE) {
        
        echo "Formulario enviado correctamente";
        
    } else {
        
        echo "Error al enviar el formulario: " . $conn->error;
    }
} else {
    
    echo "Error: Datos incompletos";
}


$conn->close();
?>