//llamamos al boton
const submitButton = document.getElementById('buttonSubmit');
//llamamos al formulario
const form = document.getElementById('user');

//hacemos el evento con el boton
submitButton.addEventListener("click", (event) => {
  //no envia el formulario directamente, hasta que se haga la validacion
  event.preventDefault();
  //llamamos la funcion y si tiene todos los campos se enviara con form.submit
  if(validarFormulario()){
    form.submit();
  }
});

function validarFormulario() {
  // Obtener referencias a los elementos del formulario
  const nombre = document.getElementById('name');
  const apellido = document.getElementById('lastName');

  // Verificar si los campos están vacíos
  if (nombre.value.trim() === "") {
      alert("Please, complete allfields!");
      nombre.focus(); // Colocar el cursor en el campo de nombre
      return false; // Detener el envío del formulario
  }

  if (apellido.value.trim() === "") {
      alert("Please, complete allfields!");
      apellido.focus();
      return false;
  }
  // Si todos los campos están llenos, permitir el envío
  return true;
}