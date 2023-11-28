<?php
    if(isset($_GET['id'])){
        $id_usuario = $_GET['id'];
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
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/validaciones.js"></script>
    <title>Registro - Verificacion Correo</title>
</head>
<body>
    <header >
        <div class="container-header">
            <h1><img src="img/Logo.png" alt="logo"></h1>

            <nav class="landing-nav">
            </nav>
        </div>
    </header>

    <div class="titulo-R">
        <h1><span style="color: #0DCEDA;">Validación&nbsp;</span>De Correo</h1>
        <h2>Por favor ingresa el código que recibiste a tu correo electrónico</h2>
    </div>

    <div class="cuadro-R">
        <form id="emailVerif" action="funciones/validacion_codigo.php" method="post">
            <input type="hidden" name="id" id = "id" value="<?php echo $id_usuario?>" readonly/>
            <h4>Código</h4>
            <input type="text" id="codigo" name="codigo" placeholder="codigo">
            <button type="button" onclick="validacionConfirmacionCorreo()">Continuar</button>
            <div class="div-error" id="div-error" style="width: auto;">
                <div class="error-campos" >
                    <img src="img/error-icon.png" style="margin-right: 10px;">
                    <p id="error-info"></p>
                </div>
                <?php if (isset($_GET['error']) && $_GET['error'] == 'codigo') : ?>
                    <div class="error-campos" style="display:block;">
                        <img src="img/error-icon.png" style="margin-right: 10px;">
                        <p id="error-info">Código Incorrecto</p>
                    </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
    
</body>
</html>