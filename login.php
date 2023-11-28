<?php
    session_start(); //reanudas la sesion activa :)
    if(isset($_SESSION['Admin'])){
        header("Location: misMascotas.php");
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
 
  <script src="./js/jquery-3.3.1.min.js"></script>
    <script>
        function recibe(){
            var correo = $("#correo").val();
            var pass = $("#pasw").val();
                $.ajax({
                    url: './funciones/checkUser.php',
                    method: "POST", 
                    dataType: 'text',
                    data: {correo:correo, pass:pass},
                    success: function(res){
                            if(res==0){
                                $('#checkCampos').html('Usuario no valido');
                                return false;
                            }
                            else{
                               return true;
                            }  
                    
                    }
                });
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
            </nav>
        </div>
    </header>

    <div class="titulo-L">
        <h1><span style="color: #0DCEDA;">INICIA&nbsp;</span>SESIÓN</h1>
        <h2>Por favor llena el formulario para acceder a tu cuenta</h2>
    </div>
    <form onsubmit="return recibe();" name="login" id="login" method="POST" action="./funciones/Validacion.php">
        <div class="cuadro-L">
            <h4>Correo electrónico</h4>
            <input type="email" id="correo" name="correo" placeholder="Escribe tu correo..." required>
            <h4>Contraseña</h4>
            <input type="password" name="pasw" id="pasw" placeholder="Escribe tu contraseña..." required>
            <div class="checkCampos" id="checkCampos"></div>
            <a class="forgot-pass">¿Olvidaste tu contraseña?</a>
            <button type="submit" class="boton">Acceder</button>
    <form>
        <div class="signup">
            ¿No tienes una cuenta?  
            <a href="registrousuario.html">Crea una</a>
        </div>
        <a class="guest" href="catalogo_adopcion_visitante.php">Acceder como invitado</a>
    </div>

    <img class="img-L" src="img/2GATITOS.png">
</body>
</html>