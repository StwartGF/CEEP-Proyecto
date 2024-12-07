<?php
include '../../Conexion/db_connection.php';

$idProfesor = $_GET['id'] ?? null;

if ($idProfesor) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM Profesores WHERE id_profesor = ?');
        $stmt->execute([$idProfesor]);
        $profesor = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($profesor);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al obtener profesor: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID del profesor no recibido o inválido.']);
}
?>