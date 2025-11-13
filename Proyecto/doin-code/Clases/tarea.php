<?php
class Tarea {

    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function add($titulo, $descripcion, $fechaFinalizacion, $estado, $user_id) {
        $sql = "INSERT INTO tareas (titulo, descripcion, fechaFinalizacion, estado, user_id) 
                VALUES (:titulo, :descripcion, :fechaFinalizacion, :estado, :user_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':titulo' => $titulo,
            ':descripcion' => $descripcion,
            ':fechaFinalizacion' => $fechaFinalizacion,
            ':estado' => $estado,
            ':user_id' => $user_id
        ]);
    }

    public function getAll() {
        $sql = "SELECT * FROM tareas";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUserId($user_id) {
        $sql = "SELECT * FROM tareas WHERE user_id = :user_id ORDER BY fecha_creacion DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id_tarea, $titulo, $descripcion, $fechaFinalizacion, $estado, $user_id) {
        $sql = "UPDATE tareas 
                SET titulo = :titulo, descripcion = :descripcion, fechaFinalizacion = :fechaFinalizacion, estado = :estado 
                WHERE id_tarea = :id_tarea AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':titulo' => $titulo,
            ':descripcion' => $descripcion,
            ':fechaFinalizacion' => $fechaFinalizacion,
            ':estado' => $estado,
            ':id_tarea' => $id_tarea,
            ':user_id' => $user_id
        ]);
    }

    public function deleteByUser($id_tarea, $user_id) {
        $sql = "DELETE FROM tareas WHERE id_tarea = :id_tarea AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_tarea' => $id_tarea,
            ':user_id' => $user_id
        ]);
    }

    public function delete($id_tarea) {
        $sql = "DELETE FROM tareas WHERE id_tarea = :id_tarea";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_tarea' => $id_tarea]);
    }
}
?>