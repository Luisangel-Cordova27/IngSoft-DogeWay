<?php

// Include the connection file (conecta.php)
require "conecta.php";

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

?>