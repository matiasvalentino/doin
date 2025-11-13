<?php
header('Content-Type: application/json; charset=utf-8');
session_start(); 

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

// Leer JSON
$data = json_decode(file_get_contents('php://input'), true);

$id_tarea = $data['id_tarea'] ?? null;
$titulo = trim($data['titulo'] ?? '');
$descripcion = trim($data['descripcion'] ?? '');
$fechaFinalizacion = $data['fechaFinalizacion'] ?? null;
$estado = $data['estado'] ?? '';
$user_id = (int) $_SESSION['user_id'];

// Validar que los campos estén complet0s
if (!$id_tarea || $titulo === '' || $descripcion === '' || $fechaFinalizacion === null || $estado === '') {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    exit;
}

// Crear objeto de tarea y actualzar
$tarea = new Tarea();
$tarea->update($id_tarea, $titulo, $descripcion, $fechaFinalizacion, $estado, $user_id);

// Enviar respuesta
echo json_encode(['success' => true]);
