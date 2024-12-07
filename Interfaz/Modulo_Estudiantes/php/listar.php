<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../../Conexion/db_connection.php';

try {
    $stmt = $pdo->query('SELECT * FROM Estudiantes');
    $estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($estudiantes);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>