const submitButton = document.getElementById('buttonSubmit');
const form = document.getElementById('user');

// Escuchamos el evento submit del formulario directamente
form.addEventListener("submit", (event) => {
  // Evitamos que el formulario se envíe hasta que se valide
  if (!validarFormulario()) {
    event.preventDefault();  // Prevenir el envío si la validación falla
  }
});

function validarFormulario() {
  const nombre = document.getElementById('name');
  const apellido = document.getElementById('lastName');

  if (nombre.value.trim() === "") {
    alert("Please, complete all fields!");
    nombre.focus();
    return false;
  }

  if (apellido.value.trim() === "") {
    alert("Please, complete all fields!");
    apellido.focus();
    return false;
  }

  // Si todo está bien, el formulario se enviará
  return true;
}
