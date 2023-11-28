<?php
    require 'conecta.php';

    $con = conecta();
    $id = $_POST['id'];
    $codigo_ingresado = $_POST['codigo'];
    
    //Consulta del codigo en el registro con ese id
    $sql = "SELECT codigo_verificacion FROM usuario WHERE id='$id'";
    $res = $con->query($sql);
    $row = $res->fetch_array();
    $codigoDeVerificacion = $row['codigo_verificacion'];

    if($codigo_ingresado == $codigoDeVerificacion){
        $sql = "UPDATE usuarios SET VERIFICACION='1' WHERE id='$id'";
        $res = $con->query($sql);
        header("Location: ../login.php");
        exit();
    }
    else{
        header("Location: ../emailConfirmation.php?id=".$id."&error=codigo");
        exit();
    }
?>