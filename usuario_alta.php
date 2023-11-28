<?php
require "./funciones/conecta.php";

$con = conecta();
$nameusuario = $_POST['usuarioname'];
$correo = $_POST['correo'];
$contra = $_POST['pasw'];
$codigo_verificacion = rand(0,999999);

$sql = "INSERT INTO usuario (nickname, correo, contrasena,codigo_verificacion) 
        VALUES ('$nameusuario', '$correo', '$contra', '$codigo_verificacion')";
        
$result = mysqli_query($con, $sql);

if ($result) {
            // Obtén el ID del usuario recién insertado
    $id_usuario = mysqli_insert_id($con);
}
        

header("Location: registroUsuario2.php?id_usuario=$id_usuario");


?>