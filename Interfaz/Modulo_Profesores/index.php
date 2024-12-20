<?php
include 'db.php';  // Asegúrate de que la conexión a la base de datos sea correcta

// Ejecuta la consulta con el JOIN
$query = $conexion->query("SELECT p.id_profesor, p.nombre, p.apellido, u.email, p.especializacion FROM profesores p JOIN users u ON p.id_usuario = u.id");

// Verifica que la consulta se haya ejecutado correctamente
if ($query) {
    // Fetch de los resultados
    $profesores = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Si hay un error en la consulta, muestra el mensaje de error
    echo "Error en la consulta: " . $conexion->errorInfo()[2];
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Profesores</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center text-primary">Gestión de Profesores</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Especialización</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($profesores as $fila): ?>
                    <tr>
                        <td><?php echo $fila['id_profesor']; ?></td>
                        <td><?php echo $fila['nombre']; ?></td>
                        <td><?php echo $fila['apellido']; ?></td>
                        <td><?php echo $fila['email']; ?></td>
                        <td><?php echo $fila['especializacion']; ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $fila['id_profesor']; ?>" class="btn btn-warning">Editar</a>
                            <a href="eliminar.php?id=<?php echo $fila['id_profesor']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

                            

