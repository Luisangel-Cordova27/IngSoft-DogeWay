<?php
    session_start(); //reanudas la sesion activa :)
    if(!isset($_SESSION['Admin'])){
        header("Location: login.php");
        exit();
    }

require "funciones/conecta.php";
$con = conecta();
$id = $_GET['id'];
$sql = "SELECT * FROM mascota WHERE id_mascota=$id";
$res = $con->query($sql);

while ($row = $res->fetch_array()) {
    $nombre = $row['nombre'];
    $opciones = $row['raza'];
    $descripcion = $row['caracteristicas'];
    $sexo = $row['sexo'];
    $fecha = $row['Edad'];
    $color = $row['color'];
    $condicion = $row['marcas_especiales'];
    $tipo = $row['adopcion'];
    $foto = $row['foto'];
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
  <script>
    function redirectToPage(url){
                window.location.href = url;
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

    <div class="titulo-RM">
        <h1><span style="color: #0DCEDA;">Editar&nbsp;</span>Mascota</h1>
    </div>
<form name="edicionperfilmascota" id="edicionperfilmascota" method="post" action="./funciones/mascotas_altaeditar.php" enctype="multipart/form-data">
    <input type="hidden" id="id" name="id" value = "<?php echo $id?>" readonly>
    <div class="cuadro-RM">
        <div class="columna">
            <div class="cuadro-fotoEPM">
                <label for="imagen" class="boton-imagenEPM">
                    <img src="../img_mascotas/<?php echo $foto?>" alt="Subir foto">
                </label>
            </div>
          <input type="file" id="archivo" name="archivo">
            <h4>Cartilla de vacunación</h4>
            <input type="file" id="cartilla" name="cartilla">
        </div>
    
        <div class="columna">
        <h4>Nombre</h4>
        <input type="text" id="nombre" name="nombre" value = "<?php echo $nombre?>">
        <h4>Especie</h4>
        <select class="select-RM" id="opciones" name="opciones">
            <option value="opcion0">Selecciona la especie</option>
            <option value="Perro"<?php if ($opciones == "Perro") echo "selected"; ?>>Perro</option>
            <option value="Gato"<?php if ($opciones == "Gato") echo "selected"; ?>>Gato</option>
            <option value="Conejo"<?php if ($opciones == "Conejo") echo "selected"; ?>>Conejo</option>
            <option value="Otro"<?php if ($opciones == "Otro") echo "selected"; ?>>Otro</option>
        </select>
        <h4>Descripción</h4>
        <textarea class="columna-input-3" type="text" id="desc" name="desc"><?php echo $descripcion; ?></textarea>
        <button class="boton-Registrar" type="submit">Actualizar</button>
    </div>
        <div class="columna">
        <h4>Edad (años)</h4>
        <input type="number" id="fecha" name="fecha" min="0", value = "<?php echo $fecha?>">
        <h4>Raza</h4>
        <input type="text" value = "<?php echo $color?>" id="raza" name="raza">
        <h4>Especificaciones de salud</h4>
        <textarea class="columna-input-2" type="text" id="condicion" name="condicion" ><?php echo $condicion; ?></textarea>
        <h4>Publicar para</h4>
        <label class="container">Adopción
            <input type="radio" id="adopcion" name="tipo" value="1" <?php if ($tipo == "1") echo "checked"; ?>>
            <span class="checkmark"></span> 
        <label class="container">Cruza
            <input type="radio" id="cruza" name="tipo" value="0" <?php if ($tipo == "0") echo "checked"; ?>>
            <span class="checkmark"></span>
        </label>
    <h4>Genero</h4>
        <label class="container">Macho
            <input type="radio" id="sexo" name="sexo" value="M" <?php if ($sexo == "M") echo "checked"; ?>>
            <span class="checkmark"></span> 
        <label class="container">Hembra
            <input type="radio" id="sexo" name="sexo" value="H" <?php if ($sexo == "H") echo "checked"; ?>>
            <span class="checkmark"></span>
        </label>


    </div>
   
    </div>
</form>

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