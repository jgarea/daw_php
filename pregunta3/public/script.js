function verClima(ciudad) {
    // let ciudad=document.querySelector('#zh');
    // console.log(ciudad);
    // Se cambia el botón de Enviar y se deshabilita
    //  hasta que llegue la respuesta

    // Aquí se hace la llamada a la función registrada de PHP
    //console.log(ciudad.options[ciudad.selectedIndex].innerHTML);
    if(ciudad!=null)
        jaxon_clima(ciudad);
    else
        alert("Establece una ciudad primero");

    return false;
}
