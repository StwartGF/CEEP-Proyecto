<?php
include '../../Conexion/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $fecha_nacimiento = $_POST['fecha-nacimiento'];
    $direccion = $_POST['direccion'];

    try {
        $stmt = $pdo->prepare('INSERT INTO Estudiantes (nombre, apellido, email, fecha_nacimiento, direccion) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$nombre, $apellido, $correo, $fecha_nacimiento, $direccion]);
        header('Location: ../registrar-estudiante.html?success=1');  // Redirige a la página de registro con un indicador de éxito
        exit();
    } catch (PDOException $e) {
        header('Location: ../registrar-estudiante.html?error=1&message=' . urlencode($e->getMessage()));  // Redirige a la página de registro con un mensaje de error
        exit();
    }
}
?>