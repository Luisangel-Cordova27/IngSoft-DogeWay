<?php
    if(isset($_GET['id_usuario'])){
        $id_usuario = $_GET['id_usuario']; 
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
  <title>Registro - Completa tu informacion</title>
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
            </nav>
        </div>
    </header>

    <main>
        <div style="width: 80%; margin: 0 auto; padding-top: 50px;">
            <div class="titulo-R" style="padding-left: 18px;">
                <h1 style="justify-content: left;"><span style="color: #0DCEDA;">Completa&nbsp;</span>Tu Información</h1>
                <h2 style="justify-content: left; padding: 15px 0;">Por favor llena todos los campos para terminar tu perfil</h2>
            </div>

            <form name="registrousuario2" id="registrousuario2" method="post" action="usuario_alta2.php" class="form-completaInfo">
            <input type="hidden" name="id" id = "id" value="<?php echo $id_usuario?>" readonly/>
                <div class="contenedor-input" style="margin: 0;">
                    <div>
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="input-registro">
                    </div>

                    <div>
                        <label for="primer-apellido">Primer Apellido</label>
                        <input type="text" name="primer-apellido" id="primer-apellido" class="input-registro">
                    </div>

                    <div>
                        <label for="segundo-apellido">Segundo Apellido &#40;Opcional&#41;</label>
                        <input type="text" name="segundo-apellido" id="segundo-apellido" class="input-registro">
                    </div>
                </div>

                <div class="contenedor-input">
                    <div>
                        <label for="fecha-nacimiento">Edad</label>
                        <input type="text" name="fecha-nacimiento" id="fecha-nacimiento" class="input-registro">
                    </div>

                    <div>
                        <label for="telefono">Teléfono</label>
                        <input type="tel" pattern="[0-9]{10}" name="telefono" id="telefono" class="input-registro">
                    </div>
                    
                    <div>
                        <label for="ubicacion">Ubicación</label>
                        <select name="ubicacion" id="ubicacion" class="input-registro">
                            <option value="null">Selecciona una opción</option>
                            <option value="zapopan">Zapopan</option>
                            <option value="guadalajara">Guadalajara</option>
                            <option value="tlajomulco">Tlajomulco de Zúñiga</option>
                            <option value="tlaquepaque">San Pedro Tlaquepaque</option>
                            <option value="tonala">Tonalá</option>
                            <option value="salto">El Salto</option>
                        </select>
                    </div>
                </div>

                <div class="contenedor-input">
                    <div>
                        <label for="curp">CURP</label>
                        <input type="text" name="curp" id="curp" class="input-registro">
                    </div>

                    <div>
                        <label for="identificacion">Identificación</label>
                        <input type="file" name="identificacion" id="identificacion" class="input-file">
                    </div>

                    <div>
                        <label for="img-perfil">Foto de perfil &#40;Opcional&#41;</label>
                        <input type="file" name="img-perfil" id="img-perfil" class="input-file">
                    </div>
                </div>

                <div class="div-error" id="div-error">
                    <div class="error-campos" >
                        <img src="img/error-icon.png" style="margin-right: 10px;">
                        <p id="error-info"></p>
                    </div>
                </div>

                <div class="cuadro-R" style="border: none; padding: 0; margin: 15px auto;">
                    <button type="button" onclick="validacionRegistro2()">Registrarse</button>
                </div>
            </form>  
        </div>
        
    </main>

    <footer class="landingpage">
        <div class="footer_element">
            <h3>® 2023 DogeWay. All Rights reserved<h3><br>
        </div>
    </footer>

    <script src="./js/navigation.js"></script>
</body>
</html>