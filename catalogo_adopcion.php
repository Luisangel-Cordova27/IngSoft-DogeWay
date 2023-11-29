<?php
    session_start(); //reanudas la sesion activa :)
    if(!isset($_SESSION['Admin'])){
        header("Location: login.php");
        exit();
    }

    $userid = $_SESSION['Admin'];
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css?v=1.2">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <title>Dogeway - Adopcion </title>
<script>
    function redirectToPage(url){
                window.location.href = url;
            }
</script>
</head>
<body>
    <header>
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

    <section class="titulocatalogo">
        <div class="headliner">
            <div class="texto">
            <h1 style='color:#0DCEDA;'>Catálogo</h1>
            </div>
            <div class="texto">
            <u style="text-decoration: underline;"><h1>Adopción</h1></u>
            </div>
        </div>
        <br><br>  
    </section><br>
    <section class="catalogo" id="adopcion">
    <?php 
    require('./funciones/conecta.php');
        $con = conecta();
        $sql = "SELECT id_mascota,foto,nombre,raza,pet.Edad,nickname FROM mascota as pet 
                JOIN usuario ON dueno = id WHERE adopcion=1 AND dueno != $userid;";
        $res = $con->query($sql);
    if ($res && $res->num_rows > 0):
            ///Muestra los elementos dentro de la tabla?>
            <center><h2>Haz click en la carta de la mascota para ver más detalles c: </h2></center>
            <?php
            while($row = $res->fetch_array())       {
                $id = $row["id_mascota"];
                $url = "detalle_catalogo.php?id=" . $id;
                $foto = $row["foto"];
                $nombre = $row["nombre"];
                $user = $row['nickname'];
                $raza = $row["raza"];                    
                $edad = $row["Edad"];
                ?>
                
                        <div class="element" onclick="redirectToPage('<?php echo $url; ?>')">
                        <div class="contentbox">
                            <div class="box_user">
                            <?php
                                echo '<img src="./img/user_icon.png" style="height:30px;"><p style="font-size:15px;">
                                '.$user.'</p>
                            </div>';
                            ?>
                           <img src="./img_mascotas/<?php echo $foto ?>" style="height: 175px; width: 250px; align-items:center;"/>
                            <?php
                            echo '<p class="nombreAnimal" style="font-size:15px;" align="left">'.$nombre.'</p>';
                            echo '<p class="razaAnimal" style="font-size:15px; float:left; color: gray;">'.$raza.'</p>';
                            echo '<p class="EdadAnimal" style="font-size:15px; float:right;color: gray; ">'.$edad.' año(s)</p>';
                            ?>
                            </div>
               
                        </div>
                </div> 
            <?php
            }        
            ?>              
        
        </div>

    </div>
    <?php
    else : ?>
        <br>
        <img src="./img/noHayAdopcion.png" width="100%" style="padding-top: 10px">

    <?php endif;?>

    </section>

    <br>
    <footer class="landingpage">
        <div class="info-footer">
            <div class="datos-footer">
                <ul>
                    <li><span class="datos-titulo">DIRECCIÓN:</span><span class="datos-texto">Centro Universitario de Ciencias Exactas e Ingenierías &#40;CUCEI&#41;</span></li>

                    <li><span class="datos-titulo">TELEFONO:</span><span class="datos-texto">+84 1102 2703</span></li>

                    <li><span class="datos-titulo">CORREO ELECTRÓNICO:</span><span class="datos-texto">hello@dogeway.com</span></li>
                </ul>
            </div>
            <div class="iconos-footer">
                <img src="img/Logo.png">

                <div style="margin-top: 45px;">
                    <span class="datos-titulo">SOCIAL:</span>
                    <ul>
                        <li><img src="img/entypo-social_twitter-with-circle.png"></li>
                        <li><img src="img/entypo-social_linkedin-with-circle.png"></li>
                        <li><img src="img/twitter.png"></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer_element">
            <h3>® 2023 DogeWay. All Rights reserved<h3><br>
        </div>
    </footer>

    <script src="./js/navigation.js"></script>
</body>
</html>