<?php
// Verificar si la cookie "token" no está presente
if (!isset($_COOKIE['token'])) {
    // La cookie "token" no está presente, redirigir al usuario al inicio de sesión
    header('Location: login.php'); // Reemplaza 'login.php' con la URL correcta
    exit; // Asegúrate de salir para evitar que el código siguiente se ejecute
}

// Obtener el valor de la cookie "token"
$authToken = $_COOKIE['token'];

// Continuar con el contenido de la página si la cookie está presente
?>
<!DOCTYPE html>
<html>
<head>
    <title>Todo</title>
    <!-- Agregar enlaces a los archivos CSS y JavaScript de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos para posicionar el botón en la esquina superior derecha */
        #logoutButton {
            position: fixed;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    
    <!-- Contenido de la página -->

    <!-- Agregar una llamada AJAX a la API -->
    <div id="todoContainer" class="container">
    <button id="logoutButton" class="btn btn-danger">Cerrar Sesión</button>

        <br>
    <h1>Bienvenido a Otra Página</h1>
        <!-- Contenedor para las tarjetas de tareas -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {

            $("#logoutButton").click(function () {
                // Eliminar la cookie
                document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                // Redirigir al usuario al inicio de sesión
                window.location.href = 'login.php'; // Reemplaza con la URL correcta
            });
            // Realizar una solicitud AJAX a la API con el token en el encabezado
            $.ajax({
                url: 'http://localhost:3000/api/v1/toDo',
                type: 'GET',
                headers: {
                    'auth-token': '<?php echo $authToken; ?>'
                },
                success: function (response) {
                    // Lógica para mostrar las tarjetas de tareas
                    var todoContainer = $("#todoContainer");

                    response.forEach(function (task) {
                        // Crear una tarjeta (card) de Bootstrap para cada tarea
                        var card = $("<div class='card mt-3'></div>");
                        var cardBody = $("<div class='card-body'></div>");

                        // Agregar el ID, el título, la descripción y la fecha de actualización
                        var title = $("<h5 class='card-title'>" + task.title + "</h5>");
                        var description = $("<p class='card-text small'>" + task.description + "</p>");
                        var updatedAt = new Date(task.updatedAt).toLocaleString();

                        // Agregar botones para eliminar y editar
                        var deleteButton = $("<button class='btn btn-danger mr-2'>Eliminar</button>");
                        var editButton = $("<button class='btn btn-primary'>Editar</button>");

                        // Agregar eventos para los botones
                        deleteButton.click(function () {
                            // Lógica para eliminar la tarea
                            // Puedes realizar una solicitud AJAX para eliminar la tarea
                            // y luego actualizar la vista
                        });

                        editButton.click(function () {
                            // Lógica para editar la tarea
                            // Puedes redirigir al usuario a una página de edición
                            // pasando el ID de la tarea como parámetro
                        });

                        // Agregar elementos al card
                        cardBody.append(title, description, "<p>Actualizado: " + updatedAt + "</p>", deleteButton, editButton);
                        card.append(cardBody);

                        // Agregar la tarjeta al contenedor
                        todoContainer.append(card);
                    });
                },
                error: function (xhr, status, error) {
                    console.log("Error de la API: " + error);
                }
            });
        });
    </script>
</body>
</html>
