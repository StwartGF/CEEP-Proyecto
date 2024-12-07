<?php
include '../../Conexion/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $fecha_nacimiento = $_POST['fecha-nacimiento'];
    $direccion = $_POST['direccion'];

    try {
        $stmt = $pdo->prepare('INSERT INTO Profesores (nombre, apellido, email, fecha_nacimiento, direccion) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$nombre, $apellido, $correo, $fecha_nacimiento, $direccion]);
        header('Location: ../registrar-profesor.html?success=1'); 
        exit();
    } catch (PDOException $e) {
        header('Location: ../registrar-profesor.html?error=1&message=' . urlencode($e->getMessage())); 
        exit();
    }
}
?>