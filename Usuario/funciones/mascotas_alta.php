<?php
// Include the connection file (conecta.php)
require "conecta.php";
session_start();

 $userid = $_SESSION["Admin"]; 

echo var_dump($_FILES);
// Get file details
    $file_name = $_FILES['archivo']['name'];
    $file_tmp = $_FILES['archivo']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $dir = "../../img_mascotas/";
    $file_enc = md5_file($file_tmp);

// Generate a unique filename
$fileName1 = "$file_enc.$ext";
$destination = $dir.$fileName1;

// Move and rename the uploaded file
if (move_uploaded_file($file_tmp, $destination)) {
    // File uploaded successfully

    // Get other form data
    $con = conecta();
    $nombre = $_POST['nombre'];
    $opciones = $_POST['opciones'];
    $descripcion = $_POST['desc'];
    $sexo = $_POST['sexo'];
    $fecha = $_POST['fecha'];
    $raza = $_POST['raza'];
    $condicion = $_POST['condicion'];
    $tipo = $_POST['tipo'];

    // Insert data into the database
    $sql = "INSERT INTO mascota (nombre, raza, caracteristicas, 
            color, marcas_especiales, sexo, edad, adopcion, foto, dueno) 
            VALUES('$nombre','$opciones','$descripcion', '$raza', 
            '$condicion', '$sexo', '$fecha', '$tipo', '$fileName1', '$userid')";
    $res = $con->query($sql);

    if ($result) {
        // Obtén el ID del usuario recién insertado
$id_mascota = mysqli_insert_id($con);
}
    

    if ($res) {
        // Data inserted successfully
        ?>
        <script language="javascript">
            window.location.replace("../misMascotas.php");
        </script>
        <?php
    } else {
        // Error inserting data
        echo "Error inserting data: " . $con->error;
    }
} else {
    // Error uploading file
    echo "Error uploading file.";
}
?>
