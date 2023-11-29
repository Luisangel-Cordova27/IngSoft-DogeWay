<?php
    session_start(); //reanudas la sesion activa :)
    if(!isset($_SESSION['Admin'])){
        header("Location: login.php");
        exit();
    }
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <title>Mis Mascotas - Dogeway </title>
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
                    <img src="img/Logo.png" alt="logo" >
                </a>
            </h1>

            <nav class="landing-nav" >
                <ul class="opciones-landing">
                    <li><a href="catalogo_adopcion.php"><button class="button-Register" id="adopcionButton">ADOPCIÓN</button></a></li>
                    <li><a href="seleccion_match.php"><button class="button-Register" id="matchButton">MATCH</button></a></li>
                    <li><a href="lista_match.php"><button class="button-Register" id="listaMatchesButton">LISTA DE MATCHES</button></a></li>
                    <li><a href="misMascotas.php"><button class="button-Register" id="misMascotasButton">MIS MASCOTAS</button></a></li>
                    <li><a href="editarusuario.php"><button class="button-Register" id="misMascotasButton">MI PERFIL</button></a></li>
                    <li><a href="./funciones/cerrar_sesion.php">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="titulomypets">
        <div class="headliner2">
            <div class="texto">
            <h1 style='color:#0DCEDA;'>Mis  </h1>
            </div>
            <div class="texto" style="padding-left: 8px;">
            <u><h1>   Mascotas</h1></u>
            </div>
            <br>
            <h2>Haz click en la tarjeta de la mascota para ver más detalles y editarlos :) </h2>
        </div>
        <center><button class="button-Register" type="button" onclick="redirectToPage('./registromascotas.html')">AGREGAR MASCOTA</button></center>
    </section>
   
    <section class="catalogo" id="adopcion">
            <?php
            require('./funciones/conecta.php');
            $con = conecta();
            $userid = $_SESSION["Admin"]; 
            $sql = "SELECT * FROM mascota WHERE dueno = $userid";
            $res = $con->query($sql);
            $number = 0;
            ///Muestra los elementos dentro de la tabla
            while($row = $res->fetch_array())       {
                $id = $row["id_mascota"];
                $url = "edicionperfilmascota.php?id=" .$id;
                $foto = $row["foto"];
                $nombre = $row["nombre"];
                $raza = $row["raza"];                    
                $edad = $row["Edad"];?>
                        <div class="element" onclick="redirectToPage('<?php echo $url; ?>')">
                        <div class="contentbox">
                            <div class="box_user1">
                                <br>
                        <form action='edicionperfilmascota.php' METHOD='POST'>  
                           <a href="javascript:;" onclick="parentNode.submit();" id="edicion"><input type = "hidden" id="id" name="id" value="<?php echo $id ?>"/>
                           <img src="./img_mascotas/<?php echo $foto ?>" style="height: 175px; width: 250px; align-items:center;"/></a>
                        </form>
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