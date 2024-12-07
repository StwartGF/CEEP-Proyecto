<?php
include '../../Conexion/db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idEstudiante = $_POST['idEstudiante'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $fecha_nacimiento = $_POST['fecha-nacimiento'];
    $direccion = $_POST['direccion'];

    try {
        $stmt = $pdo->prepare('UPDATE Estudiantes SET nombre = ?, apellido = ?, email = ?, fecha_nacimiento = ?, direccion = ? WHERE id_estudiante = ?');
        $stmt->execute([$nombre, $apellido, $correo, $fecha_nacimiento, $direccion, $idEstudiante]);
        header('Location: ../editar-estudiante.html?id=' . $idEstudiante . '&success=1'); // Redirige a la página de edición con un indicador de éxito
        exit();
    } catch (PDOException $e) {
        header('Location: ../editar-estudiante.html?id=' . $idEstudiante . '&error=1&message=' . urlencode($e->getMessage())); // Redirige a la página de edición con un mensaje de error
        exit();
    }
}
?>