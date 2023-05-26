// [JAXON-PHP]
/**
 * Función que recoge el usuario y la contraseña y llama a la función vUsuario
 * @returns 
 */
function envForm() {
    let usu = document.getElementById("usu").value;
    let pass = document.getElementById('pass').value;

    // llamamos por AJAX al php:
    jaxon_vUsuario(usu, pass);
    
    // anulamos la acción por defecto del formulario:
    return false;
}

/**
 * Función que abre el listado.php en la misma pesataña
 */
function validado() {
    window.open("listado.php", "_self");
}

/**
 * Funcion que muestra un alert por pantalla.
 */
function noValidado() {
    alert("¡¡Usuario o contraseña no válidos!!!");
}