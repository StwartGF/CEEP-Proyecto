<?php
include '../../Conexion/db_connection.php';

$data = json_decode(file_get_contents('php://input'), true);
$idProfesor = $data['idProfesor'] ?? null;

if ($idProfesor) {
    try {
        $stmt = $pdo->prepare('DELETE FROM Profesores WHERE id_profesor = ?');
        $stmt->execute([$idProfesor]);
        echo json_encode(['message' => 'Profesor eliminado exitosamente.']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al eliminar profesor: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID del profesor no recibido o inválido.']);
}
?>