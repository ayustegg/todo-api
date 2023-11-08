<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <!-- Agregar enlaces a los archivos CSS y JavaScript de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container center-container">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Iniciar Sesión</h2>
                    <form id="loginForm">
                        <div class="form-group">
                            <label for="email">Correo electrónico:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button type="button" id="loginButton" class="btn btn-primary btn-block">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
$(document).ready(function () {


    // Agregar un controlador de eventos para la tecla "Enter" en los campos de entrada
    $("#email, #password").keydown(function (e) {
        if (e.keyCode === 13) {
            // La tecla "Enter" fue presionada, enviar el formulario
            e.preventDefault(); // Evita que la tecla "Enter" envíe el formulario
            $("#loginButton").click(); // Simular un clic en el botón de inicio de sesión
        }
    });

    var authToken = null;
    // Agregar un evento de clic al botón de inicio de sesión
    $("#loginButton").click(function () {
        var email = $("#email").val();
        var password = $("#password").val();

        // Crear un objeto con los datos del formulario
        var loginData = {
            email: email,
            password: password
        };
        // Realizar una solicitud AJAX para iniciar sesión
        $.ajax({
            url: 'login_process.php', // Reemplaza con la URL correcta de tu PHP
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(loginData),
            success: function (response) {
                // Manejar la respuesta del servidor que es un json
                var json = JSON.parse(response);
                console.log(json);
                
                if (json.error != null || json.error != undefined) {
                    alert(json.error);
                }
                if (json.data.token != null) {
                    var authToken = json.data.token.toString();
                    var date = new Date();
                    date.setTime(date.getTime() + (1 * 24 * 60 * 60 * 1000));
                    var expires = "expires=" + date.toUTCString();
                    document.cookie = "token=" + authToken + ";" + expires + ";path=/";
                
                    if (document.cookie.indexOf("token=") >= 0) {
                    // La cookie "token" está presente, lo que indica que el usuario ha iniciado sesión
    // Puedes redirigir al usuario a otra página PHP
                    window.location.href = 'index.php'; // Reemplaza 'otra_pagina.php' con la URL correcta
                    } else {
    // La cookie "token" no está presente, lo que indica que el usuario no ha iniciado sesión
                     alert("Debes iniciar sesión primero.");
                    }
                } 
              
            },
            error: function (xhr, status, error) {
                // Manejar errores de red, como problemas de conexión
                alert("Error de red: " + error);
            }
        });
    });
     // Verificar si la cookie "token" está presente
     if (document.cookie.indexOf("token=") >= 0) {
    // La cookie "token" está presente, lo que indica que el usuario ha iniciado sesión
    // Puedes redirigir al usuario a otra página PHP
    window.location.href = 'index.php'; // Reemplaza 'otra_pagina.php' con la URL correcta
    }

});
</script>


</body>
</html>
