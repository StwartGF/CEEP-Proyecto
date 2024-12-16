<?php
// Incluye la conexión
require 'config.php';

$mensaje = '';

// Procesa el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contrasena = md5($_POST['contrasena']);
    $tipo_usuario = $_POST['tipo_usuario'];

    // Verifica si el usuario o correo ya existe
    $consulta = $conexion->prepare("SELECT * FROM users WHERE username = :usuario OR email = :correo");
    $consulta->bindParam(':usuario', $usuario);
    $consulta->bindParam(':correo', $correo);
    $consulta->execute();

    if ($consulta->rowCount() > 0) {
        $mensaje = "El usuario o el correo ya están registrados.";
    } else {
        // Inserta el nuevo usuario
        $insertar = $conexion->prepare("INSERT INTO users (username, email, password, tipo_usuario) VALUES (:usuario, :correo, :contrasena, :tipo_usuario)");
        $insertar->bindParam(':usuario', $usuario);
        $insertar->bindParam(':correo', $correo);
        $insertar->bindParam(':contrasena', $contrasena);
        $insertar->bindParam(':tipo_usuario', $tipo_usuario);

        if ($insertar->execute()) {
            $mensaje = "¡Registro exitoso! Ahora puedes iniciar sesión.";
        } else {
            $mensaje = "Hubo un error al registrarte. Por favor, inténtalo nuevamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="text-center">Registro de Usuario</h3>
            <?php if ($mensaje): ?>
                <div class="alert alert-info"><?php echo $mensaje; ?></div>
            <?php endif; ?>
            <form action="registro.php" method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" name="correo" id="correo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tipo_usuario" class="form-label">Tipo de Usuario</label>
                    <select name="tipo_usuario" id="tipo_usuario" class="form-select" required>
                        <option value="profesor">Profesor</option>
                        <option value="estudiante" selected>Estudiante</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">Registrar</button>
            </form>
            <div class="text-center mt-3">
                <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>