<?php
// Configuración de la base de datos
$servidor = 'localhost';
$base_datos = 'bd_ceep';
$usuario = 'root';
$contrasena = '';

try {
    // Crear la conexión usando PDO
    $conexion = new PDO("mysql:host=$servidor;dbname=$base_datos", $usuario, $contrasena);
    // Establecer el modo de error a excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
    exit;
}
?>
