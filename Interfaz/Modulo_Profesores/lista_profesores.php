<?php
include 'bd.php'; // Archivo de conexión a la base de datos

// Consulta antigua (sin JOIN, solo profesores)
// $query = $conexion->query("SELECT * FROM profesores");

// Nueva consulta con JOIN para traer el correo
$query = $conexion->query("
    SELECT p.id_profesor, p.nombre, p.apellido, u.correo, p.especializacion
    FROM profesores p
    JOIN users u ON p.id_usuario = u.id_usuario
");

// Fetch de los resultados
$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Tabla para mostrar los datos -->
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th> <!-- Mostrará el correo desde 'users' -->
            <th>Especialización</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultado as $fila): ?>
            <tr>
                <td><?php echo $fila['id_profesor']; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['apellido']; ?></td>
                <td><?php echo $fila['correo'] ?? 'N/A'; ?></td> <!-- Verificación del correo -->
                <td><?php echo $fila['especializacion']; ?></td>
                <td>
                    <button class="btn btn-warning">Editar</button>
                    <button class="btn btn-danger">Eliminar</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
