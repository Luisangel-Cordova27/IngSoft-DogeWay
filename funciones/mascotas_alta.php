<?php

require "conecta.php";
///
$file_name = $_FILES['archivo']['name']; ///NOMBRE REAL DEL ARCHIVO
$file_tmp = $_FILES['archivo']['tmp_name']; ///NOMBRE TEMPORAL DEL ARCHIVO ///COPIA TEMPORAL DEL ARCHIVO
$cadena = explode(".", $file_name); ///SEPARA EL NOMBRE PARA OBTENER LA EXTENSION
$ext = $cadena[1]; /// EXTENSION
$dir = "../img_mascotas/";  ////CARPETA DONDE SE GUARDAN LOS ARCHIVOS
$file_enc = md5_file($file_tmp); ///NOMBRE DEL ARCHIVO ENCRIPTADO, me genera una cadena en base al contenido del archivo, el contenido es unico

$fileName1 = "$file_enc.$ext";
copy($file_tmp, $dir.$fileName1);


///HACER FORMATO PARA CONCATENAR NOMBRE DE ARCHIVO DE VACUNAS
/// CON EL NOMBRE DEL USUARIO

$con = conecta();
$nombre = $_POST['nombre'];
$opciones = $_POST['opciones'];
$descripcion = $_POST['desc'];
$fecha = $_POST['fecha'];
$condicion = $_POST['condicion'];
$tipo = $_POST['tipo'];



$sql = "INSERT INTO mascotas (nombre, raza, caracteristicas, 
color, marcas_especiales, fecha_nac, adopcion, foto, dueno) 
VALUES('$nombre','$opciones','$descripcion', 'nose', '$condicion', '$fecha', '$tipo', '$fileName1', '1')";
$res = $con->query($sql);
?>
<script language="javascript">
    window.location.replace("B1_ListaDeAdmins.php");
</script>
