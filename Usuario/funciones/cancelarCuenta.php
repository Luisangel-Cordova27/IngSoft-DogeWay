<?php
// Include the connection file (conecta.php)
require "conecta.php";
session_start();

$con = conecta();
$userid = $_SESSION["Admin"]; 


$sql = "UPDATE usuario set CANCELADO = 1 WHERE id=$userid"; 
$resultado = $con->query($sql);

if ($resultado) {
    unset($_SESSION["Admin"]);
    session_destroy();
    header("Location: ../index.html");
    exit();
} else {
    // Error inserting data
    echo "No pudimos eliminar tu cuenta... Contactate con el administrador." . $con->error;
}