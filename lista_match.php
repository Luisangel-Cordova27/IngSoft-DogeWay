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
                    <li><a href="seleccion_match.php"><button class="button-Register" id="matchButton">MATCH</button></a></li>
                    <li><a href="lista_match.php"><button class="button-Register" id="listaMatchesButton">LISTA DE MATCHES</button></a></li>
                    <li><a href="misMascotas.php"><button class="button-Register" id="misMascotasButton">MIS MASCOTAS</button></a></li>
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
    $sql = "SELECT mascota.*, usuario.id, usuario.fullname, 
    usuario.telefono, lista_match.mascota1, lista_match.mascota2, 
    lista_match.like1, lista_match.like2
    FROM mascota
    INNER JOIN usuario ON usuario.id = mascota.dueno
    inner JOIN lista_match ON (mascota.id_mascota = lista_match.mascota1 OR mascota.id_mascota = lista_match.mascota2)
    WHERE lista_match.like1 = 1 AND lista_match.like2 = 1 
    AND mascota.dueno != $userid";
    $res = $con->query($sql);

    while ($row = $res->fetch_array()) {
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
                <div class="box_user">
                    <div class="menu-desplegable">
                        <div class="button-lista">
                            <?php echo '<p class="nombreAnimal" style="font-size:15px;" align="left">'.$fullnameusuario.'</p>'; ?>
                            <p><?php echo 'Nombre Mascota: '.$nombremascota; ?> </p>
                            <p><?php echo 'Edad: '.$edadmascota; ?></p>
                            <p><?php echo 'Raza: '.$razamascota; ?></p>
                            <img src="./img_mascotas/<?php echo $fotomascota?>" style="height: 100px; width: 175px; align-items:right;"/>
                        <button type="submit"> CHAT</button>
                        </div>
                        <div class="contenedor-info">
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

    <script>
        document.querySelectorAll('.button-lista').forEach(function(boton) {
            boton.addEventListener('click', function() {
                var contenedorInfo = this.parentElement.querySelector('.contenedor-info');
                contenedorInfo.style.display = (contenedorInfo.style.display === 'block') ? 'none' : 'block';
            });
        });
    </script>

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

    <script src="./js/navigation.js"></script>
</body>
</html>