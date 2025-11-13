<?php
// este archivo se encarga de registrar un nuevo usuario

require_once __DIR__ . '/../db.php';
$pdo = (new Database())->connect();

// si llega un formulario por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // tomo los datos del form (con trim x si hay espacios)
    $nombre   = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $mail     = trim($_POST['mail'] ?? '');
    $pass     = $_POST['pass'] ?? '';

    // verifico que no falte nada
    if ($nombre === '' || $apellido === '' || $mail === '' || $pass === '') {
        echo 'Faltan datos en el formulario.';
        exit;
    }

    // reviso que el mail sea valido
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo 'Email inválido.';
        exit;
    }

    // la pass tiene que tener minimo 8 caracteres
    if (strlen($pass) < 8) {
        echo 'La contraseña debe tener al menos 8 caracteres.';
        exit;
    }

    try {
        // me fijo si el mail ya existe
        $q = $pdo->prepare('SELECT id FROM users WHERE mail = ?');
        $q->execute([$mail]);
        if ($q->fetch()) {
            echo 'Ese email ya está registrado.';
            exit;
        }

        // hasheo la pass antes de guardar (x seguridad)
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        // inserto el usuario en la base
        $ins = $pdo->prepare('INSERT INTO users (nombre, apellido, mail, pass) VALUES (?, ?, ?, ?)');
        $ins->execute([$nombre, $apellido, $mail, $hash]);

        echo 'Usuario creado. Ahora podés iniciar sesión.';

    } catch (PDOException $e) {
        echo 'Error al registrar.';
        // si algo sale mal, lo mando al log
        error_log('[register.php] ' . $e->getMessage());
    }

} else {
    echo 'Método no permitido.';
}


