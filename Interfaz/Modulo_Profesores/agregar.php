<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $especializacion = $_POST['especializacion'];

    try {
        $stmt = $conexion->prepare("INSERT INTO profesores (nombre, apellido, correo, especializacion) VALUES (:nombre, :apellido, :correo, :especializacion)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':especializacion', $especializacion);
        $stmt->execute();
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        die("Error al insertar los datos: " . $e->getMessage());
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Profesor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Registro de Profesor</h2>
    <form method="POST">
        <!-- Campo para Correo -->
        <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" name="correo" class="form-control" required>
        </div>

        <!-- Campo para Contraseña -->
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="contrasena" class="form-control" required>
        </div>

        <!-- Campo para Nombre -->
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <!-- Campo para Apellido -->
        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" required>
        </div>

        <!-- Campo para Especialización -->
        <div class="form-group">
            <label>Especialización</label>
            <input type="text" name="especializacion" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Registrar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>

