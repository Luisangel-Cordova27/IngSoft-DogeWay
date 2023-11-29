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
        $nickname = $_POST['nickname'];
        $edad = $_POST['edad'];
        $telefono = $_POST['telefono'];
        $CURP = $_POST['curp'];
        $ubicacion = $_POST['ubicacion'];

        $sql = "UPDATE usuario SET fullname = '$nombre',nickname = '$nickname', edad = '$edad', telefono = '$telefono'
        , CURP = '$CURP', UBICACION = '$ubicacion' WHERE id = '$userid'";

            
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
        $nickname = $_POST['nickname'];
        $edad = $_POST['edad'];
        $telefono = $_POST['telefono'];
        $CURP = $_POST['curp'];
        $ubicacion = $_POST['ubicacion'];

        $sql = "UPDATE usuario SET fullname = '$nombre',nickname = '$nickname', edad = '$edad', telefono = '$telefono'
        , CURP = '$CURP', UBICACION = '$ubicacion' WHERE id = '$userid'";

    $res = $con->query($sql);

    header("Location: ../misMascotas.php");
    exit();
 }

?>