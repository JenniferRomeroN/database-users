document.getElementById('user').addEventListener('submit', function(event) {
    event.preventDefault();  // Evitar que el formulario se envíe de manera tradicional

    // Capturar los datos del formulario
    const name = document.getElementById('name').value;
    const lastName = document.getElementById('lastName').value;
    const gender = document.getElementById('gender').value;
    const date = document.getElementById('date').value;

    // Crear un objeto con los datos del formulario
    const data = {
        name: name,
        lastName: lastName,
        gender: gender,
        date: date
    };

    // Hacer la solicitud fetch para enviar los datos al backend
    fetch('http://localhost/users/index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data) // Convertir el objeto a JSON
    })
    .then(response => response.text())  // Obtener respuesta como texto
    .then(data => {
        console.log('Success:', data); // Mostrar el éxito en la consola
        alert('Datos enviados correctamente');
    })
    .catch(error => {
        console.error('Error:', error); // Mostrar error en la consola
        alert('Error al enviar los datos');
    });
});
