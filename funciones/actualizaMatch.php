<?php
// Include the connection file (conecta.php)
require "conecta.php";
session_start();

$con = conecta();
$userid = $_SESSION["Admin"]; 

$mascota1 = $_POST["mascota1"]; //nosotros
$mascota2 = $_POST["mascota2"]; //mascota con la que interactuamos
$like = $_POST["like"];

$consulta = "SELECT * FROM lista_match WHERE (mascota1 = $mascota1 AND mascota2 = $mascota2) 
OR (mascota1 = $mascota2 AND mascota2 = $mascota1)";
$resultado = $con->query($consulta);
if($resultado && $resultado->num_rows > 0){
        $row = $resultado->fetch_array();
        $masc1 = $row['mascota1'];
        $masc2 = $row['mascota2'];    
        if(($mascota1==$masc1 && isset($row["like1"])) && ($mascota2==$masc2 && !isset($row["like2"]))){
            header("Location: ../seleccion_match.php");
            exit(); //caso que no sera utilizado, debido a que no mostrará a los usuarios con los que  
                                        //ya se interactúo en el match.
        }
        if(($mascota1==$masc2 && !isset($row["like2"])) && ($mascota2==$masc1 && isset($row["like1"]))){
            //se asegura de que, si el usuario 2 ve al interesado, solo actualice su registro existente de match
            //en la tabla y no registre otro match con los mismos usuarios.
            $sql = "UPDATE lista_match SET like2 = $like";
            $res = $con->query($sql);
            if ($res) {
                header("Location: ../seleccion_match.php");
                exit();
            } else {
                // Error inserting data
                echo "no jaló :c" . $con->error;
            }
        }
        
    }
else{ 
    $sql2 = "INSERT INTO lista_match (mascota1, like1, mascota2) 
            VALUES('$mascota1','$like','$mascota2')";

    $res2 = $con->query($sql2);
    
    if ($res2) {
        header("Location: ../seleccion_match.php");
        exit();
    } else {
        // Error inserting data
        echo "no jaló :c" . $con->error;
    }
} 
?>
