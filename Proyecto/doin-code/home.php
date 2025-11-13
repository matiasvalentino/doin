<?php
// inicio la sesion para saber si hay usuario logueado
session_start();
require_once "Tareas/modalTarea.php";

// si no hay user logueado, lo mando al login
if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit;
}

// guardo el nombre del user pa usarlo dsp si quiero mostrarlo
$userName = $_SESSION['user_name'];
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Doin' · Home</title>

  <!-- estilos principales -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/modalTarea.css">
  <link rel="stylesheet" href="css/user_nav.css">
</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand app-navbar py-2 px-3">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center gap-2" href="#">
        <img class="logo-img" src="../../Diseño/doin' logo.svg" alt="Doin'"/>
        <span class="d-none d-md-inline">Home</span>
      </a>

      <!-- boton nueva tarea + logout -->
      <div class="d-flex align-items-center gap-3 ms-auto">
        <button class="btn btn-primary-brand btn-sm btn-lg-round" id="btnNuevaTareaNavbar">
          <span class="icon" aria-hidden="true">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
              <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"/>
            </svg>
          </span>
          Tarea
        </button>
        <?php include 'User/nombreuser.php'; ?>
      </div>
    </div>
  </nav>

  <!-- contenido principal -->
  <main class="container-fluid py-4">
    <div class="row justify-content-center g-3 align-items-start">

      <!-- Columna: pendientes -->
      <div class="col-12 col-md-4">
        <div class="card bg-dark-secondary shadow-sm h-100">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tareas pendientes</h5>
            <!-- <button class="btn btn-sm btn-outline-light border-0" data-bs-toggle="modal" data-bs-target="#miModal" id="abrirModalHeader">+</button> -->
          </div>
          <div class="card-body"><!-- aca van las tareas pendientes --></div>
          <div class="card-footer text-end">
            <button class="btn btn-primary-brand btn-sm crear-tarea-col" data-estado="pendiente">
              <span class="icon" aria-hidden="true">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"/>
                </svg>
              </span>
              Crear tarea
            </button>
          </div>
        </div>
      </div>

      <!-- Columna: en curso -->
      <div class="col-12 col-md-4">
        <div class="card bg-dark-secondary shadow-sm h-100">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">En curso</h5>
            <!-- <button class="btn btn-sm btn-outline-light border-0">+</button> -->
          </div>
          <div class="card-body"><!-- aca van las tareas en curso --></div>
          <div class="card-footer text-end">
            <button class="btn btn-primary-brand btn-sm crear-tarea-col" data-estado="enProgreso">
              <span class="icon" aria-hidden="true">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"/>
                </svg>
              </span>
              Crear tarea
            </button>
          </div>
        </div>
      </div>

      <!-- Columna: terminado -->
      <div class="col-12 col-md-4">
        <div class="card bg-dark-secondary shadow-sm h-100">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Terminado</h5>
            <!-- <button class="btn btn-sm btn-outline-light border-0">+</button> -->
          </div>
          <div class="card-body"><!-- aca van las tareas terminadas --></div>
          <div class="card-footer text-end">
            <button class="btn btn-primary-brand btn-sm crear-tarea-col" data-estado="terminado">
              <span class="icon" aria-hidden="true">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"/>
                </svg>
              </span>
              Crear tarea
            </button>
          </div>
        </div>
      </div>

    </div>
  </main>

  <!-- scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/traerTareas.js"></script>
  <script src="User/logout.js"></script>
</body>
</html>