<?php
require "conecta.php";
$con = conecta();
if (!empty($_POST['email'])) {
    $correo = $_POST['email'];
    $sql = "SELECT * FROM usuario WHERE correo='$correo'";
    $res = $con->query($sql);
    $rows = $res->num_rows;
    
    echo $rows;
};

?>