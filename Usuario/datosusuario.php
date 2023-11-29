<?php
    session_start(); //reanudas la sesion activa :)
    if(!isset($_SESSION['Admin'])){
        header("Location: login.php");
        exit();
    }

    $userid = $_SESSION["Admin"];

require "funciones/conecta.php";
    $con = conecta();
    $sql = "SELECT * FROM usuario WHERE id=$userid";
    $res = $con->query($sql);

while ($row = $res->fetch_array()) {
    $nombre = $row['fullname'];
    $nickname = $row['nickname'];
    $edad = $row['edad'];
    $telefono = $row['telefono'];
    $CURP = $row['CURP'];
    $ubicacion = $row['UBICACION'];
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
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/validaciones.js"></script>
  <title>Informacion de perfil</title>
    <script>
        function cancelarCuenta(){
            if(confirm("¿Estás seguro de querer CANCELAR TU CUENTA???")){
                    window.location.replace("./funciones/cancelarCuenta.php");
            }
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
                    <li><a href="datosusuario.php"><button class="button-Register" id="misMascotasButton">MI PERFIL</button></a></li>
                    <li><a href="./funciones/cerrar_sesion.php">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div style="width: 80%; margin: 0 auto; padding-top: 15px;">
            <div class="titulo-R" style="padding-left: 18px;">
                <h1 style="justify-content: left;"><span style="color: #0DCEDA;">Informacion&nbsp;</span>de tu Perfil</h1>
                <h2 style="justify-content: left; padding: 15px 0;">Informacion de tu perfil</h2>
            </div>
        <form class="form-completaInfo">
            <input type="hidden" name="id" id = "id" value="<?php echo $userid?>" readonly/>
                <div class="contenedor-input" style="margin: 0;">
                    <div>
                        <label for="nombre">Nombre&#40;s&#41;</label>
                        <input type="text" name="nombre" id="nombre" class="input-registro" value = "<?php echo $nombre?>">
                    </div>

                    <div>
                        <label for="primer-apellido">Primer Apellido</label>
                        <input type="text" name="primer-apellido" id="primer-apellido" class="input-registro" >
                    </div>

                    <div>
                        <label for="segundo-apellido">Segundo Apellido &#40;Opcional&#41;</label>
                        <input type="text" name="segundo-apellido" id="segundo-apellido" class="input-registro">
                    </div>
                </div>

                <div class="contenedor-input">
                    <div>
                        <label for="fecha-nacimiento">Nombre de usuario</label>
                        <input type="text" name="nickname" id="nickname" class="input-registro" value = "<?php echo $nickname?>">
                    </div>

                    <div>
                        <label for="telefono">Teléfono</label>
                        <input type="tel" pattern="[0-9]{10}" name="telefono" id="telefono" class="input-registro" value = "<?php echo $telefono?>">
                    </div>
                    
                    <div>
                        <label for="ubicacion">Ubicación</label>
                        <select name="ubicacion" id="ubicacion" class="input-registro">
                            <option value="null">Selecciona una opción</option>
                            <option value="zapopan"<?php if ($ubicacion == "zapopan") echo "selected"; ?>>Zapopan</option>
                            <option value="guadalajara"<?php if ($ubicacion == "guadalajara") echo "selected"; ?>>Guadalajara</option>
                            <option value="tlajomulco"<?php if ($ubicacion == "tlajomulco") echo "selected"; ?>>Tlajomulco de Zúñiga</option>
                            <option value="tlaquepaque"<?php if ($ubicacion == "tlaquepaque") echo "selected"; ?>>San Pedro Tlaquepaque</option>
                            <option value="tonala"<?php if ($ubicacion == "tonala") echo "selected"; ?>>Tonalá</option>
                            <option value="salto"<?php if ($ubicacion == "salto") echo "selected"; ?>>El Salto</option>
                        </select>
                    </div>
                    
                </div>

                <div class="contenedor-input">
                    <div>
                        <label for="curp">CURP</label>
                        <input type="text" name="curp" id="curp" class="input-registro"value = "<?php echo $CURP?>">
                    </div>

                    <div>
                        <label for="identificacion">Edad</label>
                        <input type="text" name="edad" id="edad" class="input-registro"value = "<?php echo $edad?>">
                    </div>
                    <div class="button-register" style="display:flex;">
                    <a href="editarusuario.php" class = "button-Register" style="margin:10px;">EDITAR DATOS</a>
                    <br>
                    <a href="#" onclick="cancelarCuenta()" class = "button-Register" style="background-color: red; margin:10px;">CANCELAR CUENTA</a>
                    </div> 
                     
                    
                </div>

                <div class="div-error" id="div-error">
                    <div class="error-campos" >
                        <img src="img/error-icon.png" style="margin-right: 10px;">
                        <p id="error-info"></p>
                    </div>
                </div>

            </form>     
        </div>   
        <div style="float:right; padding-right:60px; padding-top: 30px;">
            </div>   
    </main>

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