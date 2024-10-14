       // Envío con AJAX (JavaScript)
document.getElementById('user').addEventListener('submit', function(event) {
    event.preventDefault();  // Evitar envío tradicional

    // Capturar los datos del formulario
    const name = document.getElementById('name').value;
    const lastName = document.getElementById('lastName').value;
    const gender = document.getElementById('gender').value;
    const date = document.getElementById('date').value;

    // Crear una instancia de XMLHttpRequest
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/users/index.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Manejar la respuesta
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                alert(response.message); // Mostrar mensaje de éxito
            } else {
                alert(response.message); // Mostrar mensaje de error detallado
            }
        } else {
            alert('Error al enviar los datos');
        }
    };

    if (!name || !lastName || !gender || !date) {
        alert("Por favor, completa todos los campos.");
        return;
    }
    

// Enviar los datos como JSON
    const data = JSON.stringify({
        name: name,
        lastName: lastName,
        gender: gender,
        date: date
    });
    console.log('Datos enviados con js'+data);
    xhr.send(data);
});

// Envío tradicional con PHP
document.getElementById('buttonSubmitPhp').addEventListener('click', function() {
const form = document.getElementById('user');
form.action = 'http://localhost/users/index.php';
form.method = 'POST';
form.submit(); // Enviar formulario de manera tradicional
});