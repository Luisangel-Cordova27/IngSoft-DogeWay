<?php
require "./funciones/conecta.php";


$con = conecta();
$id_usuario = $_POST['id']; 
$nombre = $_POST['nombre'];
$primer_apellido = $_POST['primer-apellido'];
$segundo_apellido = $_POST['segundo-apellido'];
$fecha_nacimiento = $_POST['fecha-nacimiento'];
$tel = $_POST['telefono'];
$ubi = $_POST['ubicacion'];
$curp = $_POST['curp'];
$identificacion = $_POST['identificacion'];
$img_perfil = $_POST['img-perfil'];

$sql = "UPDATE usuario SET fullname = '$nombre', edad = '$fecha_nacimiento', telefono = '$tel'
, CURP = '$curp', INE = '$identificacion', UBICACION = '$ubi' WHERE id = '$id_usuario'";

$res = $con->query($sql);

header("Location: misMascotas.php");

?>