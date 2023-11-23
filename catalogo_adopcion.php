<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <title>Dogeway - Adopcion </title>
</head>
<body>
    <header>
        <div class="container-header">
            <h1> 
                <a href="landingPage.html">
                    <img src="img/Logo.png" alt="logo">
                </a>
            </h1>

            <nav class="landing-nav">
                <ul class="opciones-landing">
                    <li><a href="login.php">Iniciar sesión</a></li>
                    <li><button class="button-Register">Registrarse</button></li>
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
    <center><h2>Haz click en la foto de la mascota para ver más detalles c: </h2><center>
    <section class="catalogo" id="adopcion">

            <?php
            require('./funciones/conecta.php');
            $con = conecta();
            $sql = "SELECT * FROM mascota WHERE adopcion = 1 LIMIT 8";
            $res = $con->query($sql);
            $number = 0;
            ///Muestra los elementos dentro de la tabla
            while($row = $res->fetch_array())       {
                $id = $row["id_mascota"];
                $foto = $row["foto"];
                $nombre = $row["nombre"];
                $raza = $row["raza"];                    
                $edad = $row["Edad"];?>
                        <div class="element">
                        <div class="contentbox">
                            <div class="box_user">
                            <?php
                                echo '<p class="etiquetaUser" style="font-size:15px;">
                                <img src="./img/user_icon.png" style="height:30px;">'.$nombre.'</p>
                            </div>';
                            ?>
                           <a href="detalleMascota.php"><img src="./img/collage-1.png" style="height: 175px; width: 250px; align-items:center;"/></a>
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