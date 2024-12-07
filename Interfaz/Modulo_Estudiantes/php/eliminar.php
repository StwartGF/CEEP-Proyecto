<?php
include '../../Conexion/db_connection.php';

// Añadir verificación de los datos recibidos
$data = json_decode(file_get_contents('php://input'), true);
$idEstudiante = $data['idEstudiante'] ?? null;

if ($idEstudiante) {
    try {
        $stmt = $pdo->prepare('DELETE FROM Estudiantes WHERE id_estudiante = ?');
        $stmt->execute([$idEstudiante]);
        echo json_encode(['message' => 'Estudiante eliminado exitosamente.']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al eliminar estudiante: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID del estudiante no recibido o inválido.']);
}
?>