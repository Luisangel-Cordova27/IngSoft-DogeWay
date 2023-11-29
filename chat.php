<?php
require('./funciones/conecta.php');
$con = conecta();

// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if 'emisor' and 'receptor' keys are set in the $_POST array
    $id_emisor = isset($_POST['emisor']) ? $_POST['emisor'] : null;
    $id_receptor = isset($_POST['receptor']) ? $_POST['receptor'] : null;
    $id_mascota = isset($_POST['mascotainteres']) ? $_POST['mascotainteres'] : null;

    // Obtener el mensaje desde el formulario HTML si está establecido
    $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';

    // Imprimir los IDs de emisor y receptor en el HTML
    echo '<script>';
    echo "const id_emisor = $id_emisor;";
    echo "const id_receptor = $id_receptor;";
    echo '</script>';

    function enviarMensaje($id_emisor, $id_receptor, $mensaje) {
        global $con;

        $sql = "INSERT INTO mensajes (id_emisor, id_receptor, mensaje) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("iis", $id_emisor, $id_receptor, $mensaje);
        $result = $stmt->execute();

       
    }

    // Llamar a enviarMensaje con el mensaje obtenido
    enviarMensaje($id_emisor, $id_receptor, $mensaje);
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
  <title>Chat</title>
    <style>
        .cuadro-chat {
            border: 1px solid #C7C8CA;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            height: calc(100vh - 60px); /* Ajusta la altura al 100% de la ventana menos el encabezado */
            margin-top: 20px;
            margin-left: 60px;
            margin-right: 60px;
            overflow: auto; /* Agrega desplazamiento si el contenido es más grande que la altura */
        }

        .chat-container {
            max-width: auto;
            margin: 50px auto 60px; /* Agrega margen inferior para evitar superposición con el pie de página */
            padding: 20px;
            justify-content: center;
            border-radius: 35px;
        }

        .mensaje-input {
            width: 80%;
            height: auto;
            padding: 5px;
            border-radius: 35px;

        }

        .button-chat {
            padding: 10px 53px;
            border-radius: 68px;
            font-size: 16px;
            background-color: #0DCEDA;
            color: #FFFFFF;
            border: none;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .button-chat:hover{
            transform: scale(1.1);
        }

        .mensaje-emisor {
            text-align: right;
            color: white;
        }

        .mensaje-emisor p {
            display: inline-block;
            background-color: #e0b0ff;
            padding: 8px;
            border-radius: 10px;
        }

        .mensaje-receptor {
            text-align: left;
            color: white;
        }

        .mensaje-receptor p {
            display: inline-block;
            background-color: #7cdaf9;
            padding: 8px;
            border-radius: 10px;
        }
        </style>
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
    <div>
    <?php 
    $sql = "SELECT id_mascota,foto,nombre,raza, color, nickname, fullname FROM mascota as pet 
            JOIN usuario ON dueno = id AND dueno = $id_receptor;"; 
    $res = $con->query($sql);
    while ($row = $res->fetch_array()) {
        $id = $row["id_mascota"];
        $foto = $row["foto"];
        $nombre = $row["nombre"];
        $tipo = $row["raza"];
        $raza = $row["color"];
        $nickusuario = $row["nickname"];
        $nombreuser = $row["fullname"];
        }?>
        <div style="display:inline-block; float: left; padding-left: 80px;">
        <p><?php echo 'Mascota: '.$nombre; ?> </p>
        </div>
        <div style="display:inline-block; float: right; padding-right: 50px;">
        <p><?php echo 'Usuario: '.$nickusuario; ?> </p>
        </div>
    </div>
<div class = "cuadro-chat">
    <?php
    
        // Mostrar todos los mensajes, independientemente de la solicitud
        // Obtener todos los mensajes de la base de datos
        $sql = "SELECT * FROM mensajes WHERE (id_emisor = ? AND id_receptor = ?) OR (id_emisor = ? AND id_receptor = ?) ORDER BY fecha_envio";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("iiii", $id_emisor, $id_receptor, $id_receptor, $id_emisor);
        $stmt->execute();
        $result = $stmt->get_result();

        // Mostrar los mensajes
        while ($row = $result->fetch_assoc()) {
            $nombreClase = ($row['id_emisor'] == $id_emisor) ? 'mensaje-emisor' : 'mensaje-receptor';
            echo "<div class='$nombreClase'>";
            echo "<p>{$row['mensaje']}</p>";
            echo "</div>";
        }
    ?>

    <div class="chat-container">
       
        <!-- Agregar un formulario para la entrada de usuario -->
        <form id="message-form" method="post" action="chat.php">
            <input type="hidden" name="emisor" id="emisor" value="<?php echo $id_emisor; ?>" readonly>
            <input type="hidden" name="receptor" id="receptor" value="<?php echo $id_receptor; ?>" readonly>
            <input class = "mensaje-input" type="text" name="mensaje" id="message-input" placeholder="Escribe tu mensaje...">
            <!-- Cambiar el tipo de botón a "submit" para permitir el envío del formulario -->
            <button class = "button-chat" type="submit">Enviar</button>
        </form>
    </div>

    </div>
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