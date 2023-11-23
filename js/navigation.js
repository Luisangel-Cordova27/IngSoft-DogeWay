document.addEventListener('DOMContentLoaded', function() {
    var registerButton = document.querySelector('.button-Register');
    if (registerButton) {
        registerButton.addEventListener('click', function() {
            window.location.href = 'registrousuario.html';
        });
    }

    var registerButton = document.querySelector('#registerButton');
    if (registerButton) {
        registerButton.addEventListener('click', function() {
            window.location.href = 'registrousuario.html';
        });
    }

    var esloganButton = document.querySelector('#catalogButton');
    if (esloganButton) {
        esloganButton.addEventListener('click', function() {
            window.location.href = 'catalogo_adopcion.php';
        });
    }

    var misMascotasButton = document.querySelector('#misMascotas');
    if (misMascotasButton) {
        misMascotasButton.addEventListener('click', function() {
            window.location.href = 'misMascotas.php';
        });
    }
});