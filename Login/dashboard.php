<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Incluye la conexión
require 'config.php';

// Recupera los detalles del usuario
$consulta = $conexion->prepare("SELECT tipo_usuario FROM users WHERE username = :usuario");
$consulta->bindParam(':usuario', $_SESSION['usuario']);
$consulta->execute();
$usuario = $consulta->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?>!</h1>
    <p>Tu tipo de usuario es: <strong><?php echo ucfirst($usuario['tipo_usuario']); ?></strong></p>
    <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
</div>
</body>
</html>

