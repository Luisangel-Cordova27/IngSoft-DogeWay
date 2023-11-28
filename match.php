<?php
    session_start(); //reanudas la sesion activa :)
    if(!isset($_SESSION['Admin'])){
        header("Location: login.php");
        exit();
    }

    $userid = $_SESSION["Admin"];

    require('./funciones/conecta.php');
    $con = conecta();
    $ownpetid = $_POST["seleccion"];
    $ownpettipo = $_POST["especie"];
    $ownpetraza = $_POST["raza"];

    $sql = "SELECT mascota.*, usuario.id, usuario.fullname, usuario.telefono, usuario.nickname, 
    lista_match.mascota1, lista_match.mascota2, lista_match.like1, lista_match.like2
    FROM mascota 
    INNER JOIN usuario ON usuario.id = mascota.dueno 
    LEFT JOIN lista_match ON (mascota.id_mascota = lista_match.mascota1 OR mascota.id_mascota = lista_match.mascota2)
    WHERE dueno != $ownpetid AND adopcion = 0 AND raza = '$ownpettipo' AND color = '$ownpetraza' 
    AND (lista_match.like1 IS NULL AND lista_match.like2 IS NULL) ORDER BY RAND()";

    $res = $con->query($sql);

   while ($row = $res->fetch_array()) {
        $id = $row["id_mascota"];
        $dueno = $row["dueno"];
        $foto = $row["foto"];
        $nombre = $row["nombre"];
        $raza = $row["raza"];
        $color = $row["color"];
        $edad = $row["Edad"];
        $sexo = $row["sexo"];
        $descripcion = $row["caracteristicas"];
        $duenoname = $row["nickname"];
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
    <title>DogeWay - Match</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
        function cargarSiguienteRegistro(){
            $.ajax({
                url: "actualiza_match.php",
                type: "POST",
                dataType: "text",
                data: id1:<?php echo $userid?>
                success:
            })
        }

</script>
</head>
<body>
    <header >
        <div class="container-header">
            <h1> 
                <a href="index.html">
                    <img src="img/Logo.png" alt="logo">
                </a>
            </h1>

            <nav class="landing-nav">
                <ul class="opciones-landing">
                    <li><a href="catalogo_adopcion.php"><button class="button-Register" id="adopcionButton">ADOPCIÓN</button></a></li>
                    <li><a href="seleccion_match.php"><button class="button-Register" id="matchButton">MATCH</button></a></li>
                    <li><a href="lista_match.php"><button class="button-Register" id="listaMatchesButton">LISTA DE MATCHES</button></a></li>
                    <li><a href="misMascotas.php"><button class="button-Register" id="misMascotasButton">MIS MASCOTAS</button></a></li>
                    <li><a href="./funciones/cerrar_sesion.php">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

<!--HAZ UN IF-->

<?php if ($res && $res->num_rows > 0):?>

    <div style="height: 700px; width: 90%; margin: 0 auto; display: flex; gap: 2%;">
        <div id="left-match" class="mascota-container">
            <form id="next" name="next" method="POST" action="actualizaMatch.php" >
        
            <div class="user">
                <img src="img/user-icon.png" alt="" srcset="">
                <p><?php echo $duenoname ?><p>
                
            </div>
            
            <img src="./img_mascotas/<?php echo $foto ?>" class="img-match">
        
            <div class="contenedor-likeDismiss"> 
            <form id="match" name="match" method="POST" action="./funciones/actualizaMatch.php">
                <input type="hidden" name="mascota1" id="mascota1" value="<?php echo $ownpetid ;?>" readonly> 
                <input type="hidden" name="mascota2" id="mascota2" value="<?php echo $id ?>" readonly>
                <input type="hidden" name="like" id="like" value="1" readonly> 
                <a onclick="parentNode.submit();" id="nexttButton" ><img src="img/Love.png" alt="" srcset="" ></a>
            </form>
            <form id="match2" name="match2" method="POST" action="./funciones/actualizaMatch.php">
                <input type="hidden" name="mascota1" id="mascota1" value="<?php echo $ownpetid ;?>" readonly> 
                <input type="hidden" name="mascota2" id="mascota2" value="<?php echo $id ?>" readonly>
                <input type="hidden" name="like" id="like" value="0" readonly> 
                <a onclick="parentNode.submit();" id="nextButton"><img src="img/Dismiss.png" alt="" srcset=""></a>
            </form>   
           </div>
        
        </div>

        <div id="right-match" class="mascota-container">
            <div class="info-match">
                <h1 style="font-size: 24px; font-weight: bold;"><?php echo $nombre ?></h1>
                <div class="caracteristicas-mascota">
                    <p>Especie: <span><?php echo $raza ?></span></p> <p style="margin-left: 45px;">Edad: <span><?php echo $edad ?></span></p> <p style="margin-left: 45px;">Raza: <span><?php echo $color ?></span></p>
                </div>
                
                <p><?php echo $descripcion ?></p>
            </div>
        </div>
    </div>
    </form>
    <?php
    else : ?>


    <?php endif;?>

<!--CIERRA IF -->
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