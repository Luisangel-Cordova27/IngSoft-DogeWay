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
$usuarioReportado = isset($_POST['usuarioReportado']) ? $_POST['usuarioReportado'] : '';
$usuarioQueReporta = isset($_POST['usuarioQueReporta']) ? $_POST['usuarioQueReporta'] : '';
$ubicacionIncidente = isset($_POST['ubicacionIncidente']) ? $_POST['ubicacionIncidente'] : '';
$detallesIncidente = isset($_POST['detallesIncidente']) ? $_POST['detallesIncidente'] : '';

// Verifica los datos antes de insertarlos
if (!empty($fechaIncidente) && !empty($usuarioReportado) && !empty($usuarioQueReporta) &&  !empty($ubicacionIncidente) && !empty($detallesIncidente)) {

    $fechaIncidente = date('Y-m-d', strtotime($fechaIncidente));

    // Realiza la inserción en la base de datos
    $sql = "INSERT INTO formulario_quejas (fecha_incidente, id_usuario_reportado, id_usuario_quereporta, ubicacion_incidente, detalles_incidente) 
            VALUES ('$fechaIncidente', '$usuarioReportado', '$usuarioQueReporta', '$ubicacionIncidente', '$detallesIncidente')";

    if ($conn->query($sql) === TRUE) {
        
        echo '<script type="text/javascript">window.alert("Formulario enviado correctamente :)");</script>'  ;
        
    } else {
        
        echo '<script type="text/javascript">window.alert("Error de envío. Inténtalo nuevamente :)");</script>';

    }
} else {
    
    echo '<script type="text/javascript">window.alert("Error: Datos incompletos.");</script>';


}
