// Manejador para el formulario de eliminación
document.getElementById('deleteUserForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío tradicional

    const userId = document.getElementById('userId').value;

    // Crear una instancia de XMLHttpRequest
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/users/delete.php', true); // Cambia la URL según tu ruta
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Manejar la respuesta
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message); // Mostrar mensaje de éxito o error
        } else {
            alert('Error al eliminar el usuario');
        }
    };

    // Enviar el ID del usuario como JSON
    const data = JSON.stringify({ userId: userId });
    xhr.send(data);
});
