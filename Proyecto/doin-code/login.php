<?php
// traigo la base de datos
require_once __DIR__ . '/db.php';

// solo proceso si se envio el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // reviso que no esten vacios
    if ($email === '' || $password === '') {
        echo 'por favor completa todos los campos'; // olvide mayusculas je
        exit;
    }

    $pdo = (new Database())->connect();

    // busco al usuario por mail
    $stmt = $pdo->prepare('SELECT id, nombre, apellido, mail, pass FROM users WHERE mail = :mail LIMIT 1');
    $stmt->execute(['mail' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // si existe y la contraseña coincide
    if ($user && password_verify($password, $user['pass'])) {
        session_start();

        // guardo datos en session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_mail'] = $user['mail'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['user_lastname'] = isset($user['apellido']) ? $user['apellido'] : ''; // apellido opcional

        // redirijo al home
        header("Location: home.php");
        exit;
    } else {
        echo 'email o contraseña incorrectos'; // mensaje simple
    }
} else {
    echo 'solo se puede usar el formulario'; // mas simple que un codigo 405
}