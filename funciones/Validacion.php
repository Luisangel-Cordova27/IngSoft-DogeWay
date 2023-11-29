<?php
///funcion que conecta
require "conecta.php";
$con = conecta();
$admin = $_POST["correo"];
$pass = $_POST["pasw"];


//Variable Global
$query = "SELECT * FROM usuario WHERE correo = '$admin' AND contrasena = '$pass' AND CANCELADO=0";
$res = $con->query($query);


if($res && $res->num_rows > 0){
    // Redirige si hay al menos un registro
    $row = $res->fetch_array(); 
    $id = $row["id"];
    session_start();         
    $_SESSION["Admin"] = $id;
    ?>
    <script language="javascript">
        window.location.replace("../Usuario/misMascotas.php");
    </script>
    <?php
} else {
    // Redirige si la consulta no fue exitosa o no hay registros
    ?>
    <script language="javascript">
        window.location.replace("../login.php");
    </script>
    <?php
}
?>
