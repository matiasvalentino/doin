<?php
require_once __DIR__ . '/../db.php';
class User {
 private $db;
 public function __construct() {
     $this->db = (new Database())->connect();
 }
 public function add($nombre, $apellido, $mail, $pass) {
    $sql = "INSERT INTO users (nombre, apellido, mail, pass) VALUES (:nombre, :apellido, :mail, :pass)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':nombre' => $nombre, ':apellido' => $apellido, ':mail' => $mail, ':pass' => $pass]);
 }
 public function getAll() {
    $sql = "SELECT * FROM users";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
 }
 public function update($id, $nombre, $apellido, $mail, $pass) {
    $sql = "UPDATE users SET nombre = :nombre, apellido = :apellido, mail = :mail, pass = :pass WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':nombre' => $nombre, ':apellido' => $apellido, ':mail' => $mail, ':pass' => $pass, ':id' => $id]);
 }
 public function delete($id) {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':id' => $id]);
 }
}



 ?>