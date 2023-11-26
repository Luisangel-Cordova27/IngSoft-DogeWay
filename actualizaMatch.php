<?php
require "./funciones/conecta.php";

$con = conecta();
$nameusuario = $_POST['usuarioname'];
$correo = $_POST['correo'];
$contra = $_POST['pasw'];

$sql = "INSERT INTO usuario (nickname, correo, contrasena) 
        VALUES ('$nameusuario', '$correo', '$contra')";
        
$result = mysqli_query($con, $sql);

if ($result) {
            // Obtén el ID del usuario recién insertado
    $id_usuario = mysqli_insert_id($con);
}
        

header("Location: registroUsuario2.php?id_usuario=$id_usuario");


?>