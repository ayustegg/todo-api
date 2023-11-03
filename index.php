<!DOCTYPE html>
<html>

<head>
    <title>Lista de Tareas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        
        .completed {
            background-color: #f2f2f2; /* Color de fondo gris para tareas completadas */
        }
        .button-group {
            margin-top: 10px;
            display: flex;
            justify-content: flex-start;
        }
        .button-group button {
        
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Lista de Tareas</h1>

        <div class="card mt-4">
            <div class="card-body">
                <h2 class="card-title">Crear Tarea</h2>
                <div class="input-group">
                    <input type="text" id="taskTitle" class="form-control" placeholder="Título de la tarea" required="">
                    <div class="input-group-append">
                        <button id="addTask" class="btn btn-primary">Agregar Tarea</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h2 class="card-title">Lista de Tareas</h2>
                <div id="taskList">
                    <!-- To-do items as Bootstrap cards will be added here -->
                </div>
            </div>
        </div>

    </div>

    <!-- Modal para la edición de tareas -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Editar Tarea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for "editTaskTitle">Título de la tarea</label>
                        <input type="text" class="form-control" id="editTaskTitle">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="saveEditedTask">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Cargar las tareas al cargar la página
            loadTasks();

            // Agregar una tarea al hacer clic en el botón
            $("#addTask").click(function () {
                var title = $("#taskTitle").val();
                addTask(title);
            });

            // Abrir el modal de edición al hacer clic en el botón "Editar"
            $("body").on("click", ".edit-btn", function () {
                var listItem = $(this).closest(".card");
                var taskTitle = listItem.find(".card-title").text();
                var taskId = listItem.data("task-id");

                $("#editTaskTitle").val(taskTitle);
                $("#saveEditedTask").data("task-id", taskId);

                $("#editTaskModal").modal("show");
            });

            // Marcar tarea como completada al hacer clic en el botón
            $("body").on("click", ".complete-btn", function () {
                var listItem = $(this).closest(".card");
                var taskId = listItem.data("task-id");
                var isCompleted = listItem.hasClass("completed");
                markTaskAsCompleted(taskId, !isCompleted, listItem);
            });

            // Guardar la tarea editada al hacer clic en el botón "Guardar Cambios" en el modal
            $("#saveEditedTask").click(function () {
                var taskId = $(this).data("task-id");
                var updatedTitle = $("#editTaskTitle").val();
                updateTask(taskId, updatedTitle);
            });

            // Recargar las tareas al hacer clic en el botón
            $("#reloadTasks").click(function () {
                loadTasks();
            });

            // Función para cargar las tareas
            function loadTasks() {
                $.ajax({
                    url: 'http://localhost:3000/api/v1/toDo',
                    method: 'GET',
                    success: function (data) {
                        // Mostrar tareas en la lista
                        var taskList = $('#taskList');
                        taskList.empty();

                        data.forEach(function (task) {
                            var card = $('<div class="card mb-3"></div>');
                            if (task.completed) {
                                card.addClass("completed"); // Aplicar estilo a tareas completadas
                            }
                            var cardBody = $('<div class="card-body"></div>');
                            var cardTitle = $('<h5 class="card-title">' + task.title + '</h5>');
                            var editBtn = $('<button class="btn btn-primary edit-btn">Editar</button>');
                            var deleteBtn = $('<button class="btn btn-danger delete-btn">Borrar</button>');
                            var completeBtn = $('<button class="btn btn-success complete-btn">Completar</button>');

                            editBtn.click(function () {
                                // El código para abrir el modal se maneja arriba
                            });

                            deleteBtn.click(function () {
                                deleteTask(task._id);
                                card.remove();
                            });

                            completeBtn.click(function () {
                                markTaskAsCompleted(task._id, true, card);
                            });

                            cardBody.append(cardTitle);
                            card.append(cardBody);
                            var buttonGroup = $('<div class="button-group"></div>');
                            buttonGroup.append(editBtn);
                            buttonGroup.append(deleteBtn);
                            buttonGroup.append(completeBtn);
                            cardBody.append(buttonGroup);
                            card.data("task-id", task._id);

                            taskList.append(card);
                        });
                    }
                });
            }

            // Función para agregar una tarea
            function addTask(title) {
                var taskData = {
                    title: title,
                    completed: false
                };

                $.ajax({
                    url: 'http://localhost:3000/api/v1/toDo',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(taskData),
                    success: function () {
                        // Recargar la lista para mantener los botones de edición actualizados
                        loadTasks();
                        // Limpiar el campo de entrada después de agregar la tarea
                        $('#taskTitle').val('');
                    }
                });
            }

            // Función para marcar una tarea como completada
            function markTaskAsCompleted(taskId, isCompleted, card) {
                var taskData = {
                    completed: isCompleted
                };

                $.ajax({
                    url: 'http://localhost:3000/api/v1/toDo/' + taskId,
                    method: 'PATCH',
                    contentType: 'application/json',
                    data: JSON.stringify(taskData),
                    success: function () {
                        if (isCompleted) {
                            card.addClass("completed");
                        } else {
                            card.removeClass("completed");
                        }
                    }
                });
            }

            // Función para borrar una tarea
            function deleteTask(taskId) {
                $.ajax({
                    url: 'http://localhost:3000/api/v1/toDo/' + taskId,
                    method: 'DELETE',
                    success: function () {
                        // Tarea eliminada
                    }
                });
            }

            // Función para actualizar una tarea
            function updateTask(taskId, updatedTitle) {
                var taskData = {
                    title: updatedTitle
                };

                $.ajax({
                    url: 'http://localhost:3000/api/v1/toDo/' + taskId,
                    method: 'PATCH',
                    contentType: 'application/json',
                    data: JSON.stringify(taskData),
                    success: function () {
                        // Tarea actualizada
                        // Cerrar el modal de edición
                        $("#editTaskModal").modal("hide");
                        // Recargar la lista para reflejar los cambios
                        loadTasks();
                    }
                });
            }
        });
    </script>
  <footer class="text-center text-white fixed-bottom" style="background-color: #f1f1f1;">
        <!-- Grid container -->
        <div class="container pt-4">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a
                    class="btn btn-link btn-floating btn-lg text-dark m-1"
                    href="#!"
                    role="button"
                    data-mdb-ripple-color="dark"
                ><i class="fab fa-facebook-f"></i
                ></a>

                <!-- Twitter -->
                <a
                    class="btn btn-link btn-floating btn-lg text-dark m-1"
                    href="#!"
                    role="button"
                    data-mdb-ripple-color="dark"
                ><i class="fab fa-twitter"></i
                ></a>

                <!-- Google -->
                <a
                    class="btn btn-link btn-floating btn-lg text-dark m-1"
                    href="#!"
                    role="button"
                    data-mdb-ripple-color="dark"
                ><i class="fab fa-google"></i
                </a>

                <!-- Instagram -->
                <a
                    class="btn btn-link btn-floating btn-lg text-dark m-1"
                    href="#!"
                    role="button"
                    data-mdb-ripple-color="dark"
                ><i class="fab fa-instagram"></i
                ></a>

                <!-- LinkedIn -->
                <a
                    class="btn btn-link btn-floating btn-lg text-dark m-1"
                    href="#!"
                    role="button"
                    data-mdb-ripple-color="dark"
                ><i class="fab fa-linkedin"></i
                ></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 Copyright:
            <a class="text-dark" href="https://www.github.com/ayustegg">AyusteGG</a>
        </div>
        <!-- Copyright -->
    </footer>

</body>
</html>
