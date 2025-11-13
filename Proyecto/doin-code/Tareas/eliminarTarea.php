<?php
header('Content-Type: application/json; charset=utf-8');
session_start(); // Iniciar sesión directamente

// Verificar sesión y método
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'No autenticado.']);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../Clases/tarea.php';

// Leer datos enviados en formato JSON
$data = json_decode(file_get_contents('php://input'), true);
$id_tarea = $data['id_tarea'] ?? null;
$user_id = (int) $_SESSION['user_id'];

// Validar que el ID exista
if (!$id_tarea) {
    echo json_encode(['success' => false, 'message' => 'ID de tarea faltante.']);
    exit;
}

// Crear objeto tarea y eliminarla
$tarea = new Tarea();
$tarea->deleteByUser($id_tarea, $user_id);

// Responder
echo json_encode(['success' => true]);
