<?php
///funcion que conecta
require "conecta.php";
$con = conecta();
$admin = $_POST["correo"];
$pass = $_POST["pasw"];

session_start();
            
$_SESSION["Admin"] = $admin;
//Variable Global
$query = "SELECT * FROM usuario WHERE correo = '$admin' && contrasena = '$pass'";
$res = $con->query($query);

if($res && $res->num_rows > 0){
    // Redirige si hay al menos un registro
    ?>
    <script language="javascript">
        window.location.replace("../misMascotas.php");
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
