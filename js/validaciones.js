function validacionRegistro1(){
    let form = $("#registrousuario");
    let userName = $("#usuarioname").val();
    let email = $("#correo").val();
    let pass = $("#pasw").val();

    if(!userName || !email || !pass){
        console.log("Campos no llenos");
        $("#div-error").show();
        $("#error-info").text('Faltan campos por llenar');
        setTimeout(function () {
            $("#div-error").hide();
        }, 5000);
    }
    else{
        //form.submit();
        console.log("Correo no repetido");
            
    }
}

function validacionCorreo(){
    let email = $("#correo").val();   
    $.ajax({
        url :   'funciones/verificacion_correo.php',
                type:   'post',
                dataType:   'text',
                data:     'email='+ email,
                success: function(res){
                    console.log(res);
                    if(res > 0){
                        console.log("Correo no valido");
                        $('#boton-registro').prop('disabled', true);
                        $("#div-error").show();
                        $("#error-info").text('El correo está en uso');

                    }
                    else{
                        $('#boton-registro').prop('disabled', false);
                        $("#div-error").hide();
                        
                    }
                }
    });
}