// script.js
function filtrarEstudiantes() {
    const input = document.getElementById('buscar').value.toLowerCase();
    const filas = document.getElementById('tablaEstudiantes').getElementsByTagName('tr');

    for (let i = 1; i < filas.length; i++) {
        const celdas = filas[i].getElementsByTagName('td');
        const nombre = celdas[1].textContent.toLowerCase();
        const id = celdas[0].textContent.toLowerCase();

        if (nombre.includes(input) || id.includes(input)) {
            filas[i].style.display = "";
        } else {
            filas[i].style.display = "none";
        }
    }
}

function eliminarEstudiante(id) {
    if (confirm("¿Estás seguro de eliminar este estudiante?")) {
        // Llamar al script PHP para eliminar el estudiante (por ejemplo, AJAX o redirigir a un PHP)
        alert(`Estudiante con ID ${id} eliminado.`);
        // Aquí iría una petición AJAX para eliminar al estudiante.
    }
}
