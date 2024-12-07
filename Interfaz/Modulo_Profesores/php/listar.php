<?php
include '../../Conexion/db_connection.php';

try {
    $stmt = $pdo->query('SELECT * FROM Profesores');
    $profesores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($profesores);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al listar profesores: ' . $e->getMessage()]);
}
?>