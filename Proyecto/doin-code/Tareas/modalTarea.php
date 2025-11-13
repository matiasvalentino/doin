<?php
    // arranco la sesion para saber q usuario esta logueado
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // si se mandó el formulario (cuando apretan guardar)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once __DIR__ . '/../db.php';
        require_once __DIR__ . '/../Clases/tarea.php';

        // agarro los datos que vienen del form
        $titulo = trim($_POST['titulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $fechaFinalizacion = $_POST['fecha'] ?? null;
        $estado = $_POST['estado'] ?? '';

        // verifico que no esten vacios (pq sino rompee)
        if ($titulo === '' || $descripcion === '' || $fechaFinalizacion === null || $estado === '') {
            echo 'Por favor, complete todos los campos.';
            exit;
        }

        // saco el id del usuario actual
        $user_id = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
        if (!$user_id) {
            echo 'No estas logueado. Iniciá sesion primero.';
            exit;
        }

        // creo la tarea nueva en la base
        $tarea = new Tarea();
        $tarea->add($titulo, $descripcion, $fechaFinalizacion, $estado, $user_id);

        // vuelvo al home dsp de crearla
        header("Location: ../home.php");
        exit;
    }
?>

<html>
<head>
    <!-- css del modal (para q se vea lindo je) -->
    <link rel="stylesheet" href="/doin/Proyecto/doin-code/css/modalTarea.css">
</head>
<body>
    <!-- el form manda los datos aca mismo -->
    <form method="POST" action="/doin/Proyecto/doin-code/Tareas/modalTarea.php">
        <div id="miModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Nueva tarea</h2>
                    <span class="close" id="cerrarModal" title="Cerrar">&times;</span>
                </div>

                <div class="modal-body">
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Título de la tarea" required>

                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción de la tarea" required></textarea>

                    <div class="modal-row">
                        <input type="date" id="fecha" name="fecha" required>
                        <select id="estado" name="estado" required>
                            <option selected disabled>Estado</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="enProgreso">En progreso</option>
                            <option value="terminado">Terminado</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" id="cerrarBtn">Cerrar</button>
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </form>

    <!-- js del modal (abrir y cerrar basicamente) -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const modal = document.getElementById('miModal');
            const abrir = document.getElementById('abrirModal') || document.getElementById('abrirModalHeader');
            const cerrar = document.getElementById('cerrarModal');
            const cerrarBtn = document.getElementById('cerrarBtn');

            // abrir el modal (si existe el boton)
            if (abrir) {
                abrir.addEventListener('click', () => {
                    modal.style.display = 'flex';
                });
            }

            // cerrar con la X
            if (cerrar) {
                cerrar.addEventListener('click', () => {
                    modal.style.display = 'none';
                });
            }

            // cerrar con el boton cerrar
            if (cerrarBtn) {
                cerrarBtn.addEventListener('click', (e) => {
                    e.preventDefault(); // para que no recargue
                    modal.style.display = 'none';
                });
            }

            // cerrar clickeando afuera
            if (modal) {
                window.addEventListener('click', e => {
                    if (e.target === modal) {
                        modal.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>