<?php
// este archivo se usa para cerrar la sesion desde ajax
header('Content-Type: application/json; charset=utf-8');

// arranco sesion (x las dudas)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// arranco con una respuesta por defecto
$respuesta = ['success' => false, 'message' => 'No se pudo cerrar la sesion'];

// si hay una sesion abierta, la cierro 
if (isset($_SESSION['user_id']) || isset($_SESSION['user_name'])) {
    // borro todas las variables de la sesion
    $_SESSION = [];

    // si existe cookie de sesion, la elimino tb
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
        );
    }

    // destruyo la sesion
    session_destroy();

    // mando la respuesta al js
    $respuesta = ['success' => true, 'message' => 'Sesion cerrada ok'];
}

// devuelvo el resultado
echo json_encode($respuesta);
exit;
