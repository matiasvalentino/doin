<?php
// arranco sesion por las dudas (x si no estaba)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// agarro el nombre y apellido del user si estan en la sesion
$firstName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : (isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario');
$lastName = isset($_SESSION['user_lastname']) ? $_SESSION['user_lastname'] : (isset($_SESSION['apellido']) ? $_SESSION['apellido'] : '');
?>

<!-- muestro el nombre + apellido y el boton de cerrar sesion -->
<div class="user-area">
  <!-- aca sale el nombre del usuario logueado -->
  <span class="user-name">
    <?php echo htmlspecialchars($firstName . ($lastName ? ' ' . $lastName : ''), ENT_QUOTES, 'UTF-8'); ?>
  </span>

  <!-- este boton llama al ajax q cierra la sesion -->
  <button class="logout-btn" id="logoutBtn">Cerrar sesión</button>
</div>
