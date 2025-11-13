<?php
// devuelvo las tareas del usuario logueado
header('Content-Type: application/json; charset=utf-8');

// arranco la sesion (si no estaba iniciada)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// si no hay usuario logueado, corto aca nomas
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'No estas logueado']);
    exit;
}

// saco el id del usuario actual
$user_id = (int) $_SESSION['user_id'];

// incluyo los archivos q necesito
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../Clases/tarea.php';

// creo un objeto tarea y traigo las tareas de ese user
$tarea = new Tarea();
$tareas = $tarea->getByUserId($user_id);

// devuelvo las tareas como json para el js
echo json_encode([
    'success' => true,
    'data' => $tareas,
    'count' => count($tareas)
]);
