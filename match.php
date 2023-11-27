<?php
    session_start(); //reanudas la sesion activa :)
    if(!isset($_SESSION['Admin'])){
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&display=swap" rel="stylesheet">
    <title>DogeWay - Match</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Inicializar el índice actual
            var currentIndex = 0;

            // Obtener todos los resultados en un array
            var mascotas = <?php echo json_encode($resultados); ?>;

            // Ocultar todas las mascotas excepto la primera
            $(".mascota-container").hide();
            $(".mascota-container").eq(currentIndex).show();

            // Manejar clic en el botón para mostrar el siguiente resultado
            $("a.nextButton").click(function () {
                // Ocultar el resultado actual
                $(".mascota-container").eq(currentIndex).hide();

                // Incrementar el índice
                currentIndex++;

                // Verificar si hemos alcanzado el final de los resultados
                if (currentIndex >= mascotas.length) {
                    currentIndex = 0; // Volver al primer resultado si estamos al final
                }

                // Mostrar el siguiente resultado
                $(".mascota-container").eq(currentIndex).show();
            });
        });
    </script>


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

    <div style="height: 700px; width: 90%; margin: 0 auto; display: flex; gap: 2%;">
    <div id="left-match" class="mascota-container">
       <?php
            require('./funciones/conecta.php');
            $con = conecta();
            $userid = $_SESSION["Admin"];
            $sql = "SELECT mascota.*, usuario.id, usuario.fullname, usuario.telefono, usuario.nickname 
            FROM mascota INNER JOIN usuario ON usuario.id = mascota.dueno WHERE dueno != $userid AND adopcion != 1 ";

            $res = $con->query($sql);
            $number = 0;
            ///Muestra los elementos dentro de la tabla

            while($row = $res->fetch_array()){
                $resultados[] = $row;
            }
            foreach($resultados as $row){

                $id = $row["id_mascota"];
                $dueno = $row["dueno"];
                $foto = $row["foto"];
                $nombre = $row["nombre"];
                $raza = $row["raza"];        
                $color = $row["color"];            
                $edad = $row["Edad"];
                $sexo = $row["sexo"];
                $descripcion = $row["caracteristicas"];
                $duenoname = $row["nickname"]
                ?>
            <form id="next" name="next" method="POST" action="actualizaMatch.php" >
            <div class="user">
                <img src="img/user-icon.png" alt="" srcset="">
                <p><?php echo $duenoname ?><p>
                
            </div>
            
            <img src="./img_mascotas/<?php echo $foto ?>" class="img-match">
        
            <div class="contenedor-likeDismiss"> 
                <a href="#" id="nextButton"><img src="img/Love.png" alt="" srcset=""></a>
                <a href="#" id="nextButton"><img src="img/Dismiss.png" alt="" srcset=""></a>
           </div>
        </form> 
        </div>

        <div id="right-match" class="mascota-container">
            <div class="info-match">
                <h1 style="font-size: 24px; font-weight: bold;"><?php echo $nombre ?></h1>
                <div class="caracteristicas-mascota">
                    <p>Especie: <span><?php echo $raza ?></span></p> <p style="margin-left: 45px;">Edad: <span><?php echo $edad ?></span></p> <p style="margin-left: 45px;">Raza: <span><?php echo $color ?></span></p>
                </div>
                
                <p><?php echo $descripcion ?></p>
            </div>
        </div>
    </div>
        <?php
        }
        ?>
        
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
</body>
</html>