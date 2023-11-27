
<?php
// Include the connection file (conecta.php)
require "conecta.php";
session_start();

$userid = $_SESSION["Admin"]; 

echo var_dump($_FILES);
// Get file details
    $file_name = $_FILES["archivo"]['name'];
    $file_tmp = $_FILES["archivo"]['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $dir = "../img_mascotas/";
    $file_enc = md5_file($file_tmp);

// Generate a unique filename
$fileName1 = "$file_enc.$ext";
$destination = $dir.$fileName1;

// Move and rename the uploaded file
if (move_uploaded_file($file_tmp, $destination)) {
    // File uploaded successfully
    // Get other form data
    $con = conecta();
    $id_mascota = $_POST['id']; 
    $nombre = $_POST['nombre'];
    $opciones = $_POST['opciones'];
    $descripcion = $_POST['desc'];
    $sexo = $_POST['sexo'];
    $fecha = $_POST['fecha'];
    $raza = $_POST['raza'];
    $condicion = $_POST['condicion'];
    $tipo = $_POST['tipo'];
    

$sql = "UPDATE mascota SET nombre = '$nombre',raza = '$opciones', caracteristicas = '$descripcion', color = '$raza'
, marcas_especiales = '$condicion', sexo = '$sexo', edad = '$fecha', adopcion = '$tipo', foto = '$fileName1'  WHERE id_mascota = '$id_mascota'";

$res = $con->query($sql);

header("Location: ../misMascotas.php");
 }
?>