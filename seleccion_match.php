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
  <title>Edicion de perfil de Mascota</title>
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
                    <li><a href="match.php"><button class="button-Register" id="matchButton">MATCH</button></a></li>
                    <li><a href="lista_match.php"><button class="button-Register" id="listaMatchesButton">LISTA DE MATCHES</button></a></li>
                    <li><a href="misMascotas.php"><button class="button-Register" id="misMascotasButton">MIS MASCOTAS</button></a></li>
                    <li><a href="./funciones/cerrar_sesion.php">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="titulo-RM">
        <h1>Seleccion<span style="color: #0DCEDA;">&nbsp;para Cruza de Mascota</span></h1>
        <h2>Haz click en los datos de tu mascota para empezar a hacer match :) </h2>
    </div>

    <?php
    require('./funciones/conecta.php');
    $con = conecta();
    $userid = $_SESSION["Admin"]; 
    $sql = "SELECT * FROM mascota WHERE dueno = $userid";
    $res = $con->query($sql);

    while ($row = $res->fetch_array()) {
        $mascotaid = $row['id_mascota'];
        $nombremascota = $row['nombre'];  
        $especiemascota = $row['raza'];
        $caracteristicasmascota = $row['caracteristicas'];
        $razamascota = $row['color'];
        $saludmascota = $row['marcas_especiales'];
        $edadmascota = $row['Edad'];
        $sexomascota = $row['sexo'];
        $fotomascota = $row['foto'];
    ?>
<form id="nose" name="nose" method = "post" action = "match.php">

<a onclick="this.parentNode.submit();">
<input type="hidden" id="seleccion" name="seleccion" value="<?php echo $mascotaid ?>" readonly/>
<input type="hidden" id="especie" name="especie" value="<?php echo $especiemascota ?>" readonly/>
<input type="hidden" id="raza" name="raza" value="<?php echo $razamascota ?>" readonly/>
<div class="elementlista">
            <div class="contentboxlista">
                <div class="box_user">
                    <div class="menu-desplegable">
                        <div class="button-lista">
                            <p><?php echo 'Nombre: '.$nombremascota; ?> </p>
                            <p><?php echo 'Edad: '.$edadmascota; ?></p>
                            <p><?php echo 'Raza: '.$razamascota; ?></p>
                            <img src="./img_mascotas/<?php echo $fotomascota ?>" style="height: 100px; width: 175px; align-items:right;"/>
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
    </a>
        </form>
            <?php
            }        
            ?>             

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