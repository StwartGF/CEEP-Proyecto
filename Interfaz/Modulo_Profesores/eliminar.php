<?php
include 'db.php';

$id = $_GET['id'];
$conexion->query("DELETE FROM profesores WHERE id_profesor=$id");

header("Location: index.php");
?>
