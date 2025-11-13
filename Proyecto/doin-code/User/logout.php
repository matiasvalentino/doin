<?php
// este archivo cierra la sesion y te manda al login (cuando no es por ajax)

// arranco sesion (x las dudas)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// borro las variables q tenga la sesion
$_SESSION = [];

// si hay cookie de sesion, la elimino tmb
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
    );
}

// destruyo la sesion y mando al login
session_destroy();
header('Location: ../login.html');
exit;
