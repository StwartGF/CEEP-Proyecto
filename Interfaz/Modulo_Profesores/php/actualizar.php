<?php
include '../../Conexion/db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProfesor = $_POST['idProfesor'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $fecha_nacimiento = $_POST['fecha-nacimiento'];
    $direccion = $_POST['direccion'];

    try {
        $stmt = $pdo->prepare('UPDATE Profesores SET nombre = ?, apellido = ?, email = ?, fecha_nacimiento = ?, direccion = ? WHERE id_profesor = ?');
        $stmt->execute([$nombre, $apellido, $correo, $fecha_nacimiento, $direccion, $idProfesor]);
        header('Location: ../editar-profesor.html?id=' . $idProfesor . '&success=1'); 
        exit();
    } catch (PDOException $e) {
        header('Location: ../editar-profesor.html?id=' . $idProfesor . '&error=1&message=' . urlencode($e->getMessage())); 
        exit();
    }
}
?>