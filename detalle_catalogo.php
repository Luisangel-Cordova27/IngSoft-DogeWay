<?php
    session_start(); //reanudas la sesion activa :)
    if(!isset($_SESSION['Admin'])){
        header("Location: login.php");
        exit();
    }
?>

<?php

require "funciones/conecta.php";
$con = conecta();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM mascota WHERE id_mascota=$id";
    $res = $con->query($sql);
    $row = $res->fetch_array();

    //datos de la mascota
    $foto = $row['foto'];
    $nombre = $row['nombre'];
    $tipo = $row["raza"];                    
    $edad = $row["Edad"];
    $descrip = $row['caracteristicas'];
    $raza = $row['color'];
    $dueno = $row['dueno'];

    //datos de contacto
    $sql= "SELECT fullname, telefono, UBICACION, nickname FROM `usuario`
    JOIN mascota on id = dueno
    WHERE dueno ='$dueno'";
    $res = $con->query($sql);
    $row = $res->fetch_array();
    $nombreDueno = $row['fullname'];
    $telDueno = $row['telefono'];
    $ubiDueno = $row['UBICACION'];
    $userDueno = $row['nickname'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&display=swap" rel="stylesheet">
    <title>Detalle - Mascota</title>
</head>
<body>
    <header >
        <div class="container-header">
            <h1> 
                <a href="landingPage.html">
                    <img src="img/Logo.png" alt="logo">
                </a>
            </h1>

            <nav class="landing-nav">
                <ul class="opciones-landing">
                    <li><a href="catalogo_adopcion.php"><button class="button-Register" id="adopcionButton">ADOPCIÓN</button></a></li>
                    <li><a href="match.php"><button class="button-Register" id="matchButton">MATCH</button></a></li>
                    <li><a href="lista_match.php"><button class="button-Register" id="listaMatchesButton">LISTA DE MATCHES</button></a></li>
                    <li><a href="misMascotas.php"><button class="button-Register" id="misMascotasButton">MIS MASCOTAS</button></a></li>
                    <li><a href="./funciones/cerrar_sesion.php">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <a href="catalogo_adopcion.php"><button class="button-Register" style="margin-left:30px; margin-bottom: 30px;">Regresar</button></a>
    <div style="height: 700px; width: 90%; margin: 0 auto; display: flex; gap: 2%;">
        <div id="left-match">
            <div class="user">
                <img src="img/user-icon.png" alt="" srcset="">
                <p><?php echo $userDueno; ?></p>
            </div>
            
            <img src="img_mascotas/<?php echo $foto; ?>" class="img-match">

            
        </div>

        <div id="right-match">
            <div class="info-match">
                <h1 style="font-size: 24px; font-weight: bold;"><?php echo $nombre; ?></h1>
                <div class="caracteristicas-mascota">
                    <p>Especie: <span><?php echo $tipo; ?></span></p> <p style="margin-left: 45px;">Edad: <span><?php echo $edad; ?> años</span></p> <p style="margin-left: 45px;">Raza: <span><?php echo $raza; ?></span></p>
                </div>
                
                <p> <?php echo $descrip; ?></p>

                <h1 style="font-size: 24px; font-weight: bold;">Datos de contacto</h1>
                <p>Dueño: <span><?php echo $nombreDueno; ?></span></p> 
                <p>Telefono: <span><?php echo $telDueno; ?></span></p> 
                <p>Ubicacion: <span><?php echo $ubiDueno; ?></span></p>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer_element_mascotas">
            <h3>® 2023 DogeWay. All Rights reserved<h3><br>
                <div class="footer_element_mascotas_imagenes">
                    <img src="img/entypo-social_twitter-with-circle.png">
                    <img src="img/entypo-social_linkedin-with-circle.png">
                    <img src="img/twitter.png">
                </div>
        </div>
    </footer>
</body>
</html>

