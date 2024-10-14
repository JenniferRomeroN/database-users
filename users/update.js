document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('user').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar el envío tradicional

        const userId = document.getElementById('userId').value;
        const name = document.getElementById('name').value;
        const lastName = document.getElementById('lastName').value;
        const gender = document.getElementById('gender').value;
        const date = document.getElementById('date').value;

        // Crear una instancia de XMLHttpRequest
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost/users/update.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        // Manejar la respuesta
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                alert(response.message);
            } else {
                alert('Error al actualizar el usuario');
            }
        };

        const data = JSON.stringify({
            userId: userId,
            name: name,
            lastName: lastName,
            gender: gender,
            date: date
        });
        xhr.send(data);
    });
});
