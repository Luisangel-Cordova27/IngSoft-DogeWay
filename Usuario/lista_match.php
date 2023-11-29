<?php
    session_start(); //reanudas la sesion activa :)
    if(!isset($_SESSION['Admin'])){
        header("Location: login.php");
        exit();
    }

    $userid = $_SESSION["Admin"];
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <title>Edicion de perfil de Mascota</title>
  <style>
        .contenedor-info {
            display: none;
        }
        .contenedor-info.mostrar {
            display: block;
        }
    </style>
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
                    <li><a href="datosusuario.php"><button class="button-Register" id="misMascotasButton">MI PERFIL</button></a></li>
                    <li><a href="./funciones/cerrar_sesion.php">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="titulo-RM">
        <h1><span style="color: #0DCEDA;">Lista&nbsp;</span>De matches</h1>
    </div>

    <?php
    require('./funciones/conecta.php');
    $con = conecta();
    $sql = "SELECT * FROM `mascota` 
    JOIN usuario ON dueno = id
    WHERE id_mascota IN (SELECT mascota2 FROM `mascota`
                        JOIN usuario ON dueno = id
                        JOIN lista_match on id_mascota = mascota1
                        WHERE dueno = $userid AND like1=1 AND like2=1)
    OR id_mascota IN 	(SELECT mascota1 FROM `mascota`
                        JOIN usuario ON dueno = id
                        JOIN lista_match on id_mascota = mascota2
                        WHERE dueno = $userid AND like1=1 AND like2=1);";
    $res = $con->query($sql);
    
    if ($res && $res->num_rows > 0):
    while ($row = $res->fetch_array()) {
        $iddueno = $row['dueno'];
        $mascotaid = $row['id_mascota'];
        $nombremascota = $row['nombre'];  
        $especiemascota = $row['raza'];
        $caracteristicasmascota = $row['caracteristicas'];
        $razamascota = $row['color'];
        $saludmascota = $row['marcas_especiales'];
        $edadmascota = $row['Edad'];
        $sexomascota = $row['sexo'];
        $fotomascota = $row['foto'];
        $fullnameusuario = $row['fullname'];  
        $telefonousuario = $row['telefono'];  
    ?>

<div class="elementlista">
            <div class="contentboxlista">
                <div class="box_user1">
                    <div class="menu-desplegable">
                        <form method = "POST" action="chat.php">
                        <input type = "hidden" id = "receptor" name = "receptor" value = "<?php echo $iddueno;?>" readonly>
                        <input type = "hidden" id = "emisor" name = "emisor" value = "<?php echo $userid;?>" readonly>
                        <input type = "hidden" id = "mascotainteres" name = "mascotainteres" value = "<?php echo $mascotaid;?>" readonly>
                        <div class = "button-lista">
                            <?php echo '<p class="nombreAnimal" style="font-size:15px;" align="left">'.$fullnameusuario.'</p>'; ?>
                            <p><?php echo 'Nombre Mascota: '.$nombremascota; ?> </p>
                            <p><?php echo 'Edad: '.$edadmascota; ?></p>
                            <p><?php echo 'Raza: '.$razamascota; ?></p>
                            <img src="../img_mascotas/<?php echo $fotomascota?>" style="height: 100px; width: 175px; align-items:right;"/>
                            <button class="button-irchat" type="submit">CHAT</button>
                            <button class="button-detalles" type="button" onclick="toggleLista()">DETALLES</button>
                        </div>
    </form>
                        <div class="contenedor-info" id="menuDesplegable">
                            <p><?php echo 'Teléfono: '.$telefonousuario; ?></p>
                            <p><?php echo 'Especie: '.$especiemascota; ?></p>
                            <p><?php echo 'Caracteristicas: '.$caracteristicasmascota; ?></p>
                            <p><?php echo 'Salud: '.$saludmascota; ?></p>
                            <p><?php echo 'Sexo: '.$sexomascota; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php
            }       
            ?> 
            <?php
        else : ?>
        <img src="./img/noMatches.png" width="100%" style="padding-top: 10px">

    <?php endif;?>
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

    <script>
        function toggleLista() {
            var menuDesplegable = document.getElementById('menuDesplegable');
            menuDesplegable.classList.toggle('mostrar');
        }
    </script>

    <script src="./js/navigation.js"></script>
</body>
</html>