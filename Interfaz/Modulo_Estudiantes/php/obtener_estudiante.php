<?php
include '../../Conexion/db_connection.php';

$idEstudiante = $_GET['id'] ?? null;

if ($idEstudiante) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM Estudiantes WHERE id_estudiante = ?');
        $stmt->execute([$idEstudiante]);
        $estudiante = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($estudiante);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al obtener estudiante: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID del estudiante no recibido o inválido.']);
}
?>