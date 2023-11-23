<?php
    require "conecta.php";
    $con = conecta();
    
    if(isset($_POST["correo"]) && isset($_POST["pasw"])){
        $correo = $_POST["correo"];
        $password =  $_POST["pasw"];
            
        $query = "SELECT * FROM usuario WHERE correo ='".$correo."' AND contrasena='".$password."'";
        $result = mysqli_query($con, $query);
        $contador = mysqli_num_rows($result);
        if($contador>0){
            $respuesta=1;
        }
        else{
            $respuesta=0;
        }
    }
    echo $respuesta;
?>