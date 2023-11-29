
<?php
// Include the connection file (conecta.php)
require "conecta.php";
session_start();
$con = conecta();

$userid = $_SESSION["Admin"]; 


echo var_dump($_FILES);
// Get file details

if(isset($_FILES["archivo"]['name']) && !empty($_FILES["archivo"]['name'])){
    $file_name = $_FILES["archivo"]['name'];
    $file_tmp = $_FILES["archivo"]['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $dir = "../img_mascotas/";

    // Check if the file was uploaded successfully
    if (move_uploaded_file($file_tmp, $dir.$file_name)) {
        $file_enc = md5_file($dir.$file_name);
        $fileName1 = "$file_enc.$ext";
        $destination = $dir.$fileName1;

        $id_mascota = $_POST['id']; 
        $nombre = $_POST['nombre'];
        $opciones = $_POST['opciones'];
        $descripcion = $_POST['desc'];
        $sexo = $_POST['sexo'];
        $fecha = $_POST['fecha'];
        $raza = $_POST['raza'];
        $condicion = $_POST['condicion'];
        $tipo = $_POST['tipo'];

        $sql = "UPDATE mascota SET nombre = '$nombre',raza = '$opciones', 
        caracteristicas = '$descripcion', color = '$raza', 
        marcas_especiales = '$condicion', sexo = '$sexo', 
        edad = '$fecha', adopcion = '$tipo', foto = '$fileName1'  WHERE id_mascota = '$id_mascota'";

            
        $res = $con->query($sql);

        header("Location: ../misMascotas.php");
        exit();
    }
        else {
            // H
            echo "Error subiendo imagen";
        }
}
else{
    $id_mascota = $_POST['id']; 
    $nombre = $_POST['nombre'];
    $opciones = $_POST['opciones'];
    $descripcion = $_POST['desc'];
    $sexo = $_POST['sexo'];
    $fecha = $_POST['fecha'];
    $raza = $_POST['raza'];
    $condicion = $_POST['condicion'];
    $tipo = $_POST['tipo'];

    $sql = "UPDATE mascota SET nombre = '$nombre',raza = '$opciones', 
    caracteristicas = '$descripcion', color = '$raza', 
    marcas_especiales = '$condicion', sexo = '$sexo', 
    edad = '$fecha', adopcion = '$tipo' WHERE id_mascota = '$id_mascota'";

    $res = $con->query($sql);

    header("Location: ../misMascotas.php");
    exit();
 }

?>