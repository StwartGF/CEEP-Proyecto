<?php
include 'db.php';  // Asegúrate de incluir correctamente la conexión a la base de datos

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "El ID no está definido.";
    exit;
}

$id = $_GET['id'];

// Prevenir inyección SQL usando declaraciones preparadas
$sql = "SELECT p.id_profesor, p.nombre, p.apellido, u.email, p.especializacion, u.id AS id_usuario 
        FROM profesores p 
        JOIN users u ON p.id_usuario = u.id 
        WHERE p.id_profesor = ?";
$stmt = $conexion->prepare($sql); // Usa la variable correcta para la conexión

// Enlaza el parámetro usando bindValue
$stmt->bindValue(1, $id, PDO::PARAM_INT); // Enlaza el parámetro en PDO
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
$profesor = $resultado;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitizar los datos antes de usarlos
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $apellido = htmlspecialchars(trim($_POST['apellido']));
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $especializacion = htmlspecialchars(trim($_POST['especializacion']));

    // Validar que el correo tiene un formato válido
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico no es válido.";
    } else {
        // Iniciar la transacción para asegurarse de que ambas actualizaciones se realicen correctamente
        $conexion->beginTransaction();
        // Inicializar variable de control de transacción
        $transaccionActiva = false;



        try {
            // Actualizar en la tabla 'profesores'
            $sql_profesor = "UPDATE profesores SET nombre=?, apellido=?, correo=?, especializacion=? WHERE id_profesor=?";
            $stmt_profesor = $conexion->prepare($sql_profesor);
            $stmt_profesor->bindValue(1, $nombre, PDO::PARAM_STR);
            $stmt_profesor->bindValue(2, $apellido, PDO::PARAM_STR);
            $stmt_profesor->bindValue(3, $correo, PDO::PARAM_STR);
            $stmt_profesor->bindValue(4, $especializacion, PDO::PARAM_STR);
            $stmt_profesor->bindValue(5, $id, PDO::PARAM_INT);

            if ($stmt_profesor->execute()) {
                echo "Actualización en profesores exitosa.<br>";
            } else {
                echo "Error en la actualización de profesores: " . $stmt_profesor->errorInfo()[2] . "<br>";
            }

            // Actualizar en la tabla 'users' el correo electrónico
            $sql_user = "UPDATE users SET email=? WHERE id=?";
            $stmt_user = $conexion->prepare($sql_user);
            $stmt_user->bindValue(1, $correo, PDO::PARAM_STR);
            $stmt_user->bindValue(2, $resultado['id_usuario'], PDO::PARAM_INT); // Usar el 'id_usuario' del profesor

            if ($stmt_user->execute()) {
                echo "Actualización en users exitosa.<br>";
            } else {
                echo "Error en la actualización de users: " . $stmt_user->errorInfo()[2] . "<br>";
            }

            // Commit si ambas actualizaciones son exitosas
            $conexion->commit();
            header("Location: index.php"); // Redirige después de actualizar
            exit();
        } catch (Exception $e) {
            // Rollback si hay error
            if ($transaccionActiva) {
                $conexion->rollBack();
            }
            echo "Error en transacción: " . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Profesor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center">Editar Profesor</h3>
        <form action="editar.php?id=<?php echo $id; ?>" method="POST">

            <!-- Campo de nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo htmlspecialchars($profesor['nombre']); ?>" required>
            </div>

            <!-- Campo de apellido -->
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo htmlspecialchars($profesor['apellido']); ?>" required>
            </div>

            <!-- Campo de correo -->
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" name="correo" id="correo" class="form-control" value="<?php echo htmlspecialchars($profesor['email']); ?>" required>
            </div>

            <!-- Campo de especialización -->
            <div class="mb-3">
                <label for="especializacion" class="form-label">Especialización</label>
                <input type="text" name="especializacion" id="especializacion" class="form-control" value="<?php echo htmlspecialchars($profesor['especializacion']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>

</html>