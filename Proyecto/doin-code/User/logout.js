// este script se encarga de cerrar la sesion cuando toco el boton "cerrar sesion"
document.addEventListener('DOMContentLoaded', () => {
  const logoutBtn = document.getElementById('logoutBtn');
  if (!logoutBtn) return; // si no hay boton no hago nada

  // cuando clickeo en el boton
  logoutBtn.addEventListener('click', async (e) => {
    e.preventDefault(); // evito q se recargue la pag

    try {
      // mando la peticion al php q destruye la sesion
      const resp = await fetch('/doin/Proyecto/doin-code/User/ajax_logout.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' }
      });

      // leo la respuesta del servidor
      const data = await resp.json();

      // si todo sale bien, lo mando al login
      if (data.success) {
        window.location.href = '/doin/Proyecto/doin-code/login.html';
      } else {
        // si algo sale mal, pruebo redirigir igual al logout normal
        window.location.href = '/doin/Proyecto/doin-code/User/logout.php';
      }
    } catch (err) {
      // si falla la peticion o algo raro pasa, lo mando al logout comun
      window.location.href = '/doin/Proyecto/doin-code/User/logout.php';
    }
  });
});

// nota:
// hay 2 archivos php pq uno (ajax_logout.php) cierra la sesion sin recargar la pag usando AJAX,
// y el otro (logout.php) la cierra de forma normal x si el js no anda o se rompe algo.
// el ajax basicamente manda una peticion al server para destruir la sesion sin actualizar toda la web.
