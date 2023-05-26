/**
 * Funcion que devuelve si una fecha es menor que otra
 * @returns 
 */
function validarFecha() {
    let fecha = document.getElementById('title').value;

    if (fecha.length == 0) {
        alert("Elija una fecha.");
        return false
    }

    let miFecha = new Date(fecha);
    let hoy     = new Date();

    hoy.setHours(0, 0, 0, 0);
    miFecha.setHours(0, 0, 0, 0);

    if (miFecha < hoy) {
        alert("La fecha no puede se inferior a la actual");
        return false;
    }

    return true;
}

/**
 * LLama a la función getCoordenadas de jaxon
 * @returns 
 */
function getCoordenadas() {
    let dir = document.getElementById('dir').value;

    jaxon_getCoordenadas(dir);
    return true;
}

/**
 * LLama a la funcion ordenar envios de jaxon
 * @param {*} id 
 */
function ordenarEnvios(id) {
    var puntos = $("#t_" + id + " input:hidden").map(function () {
        return this.value;
    }).get().join("|");

    jaxon_ordenarEnvios(puntos, id);
}

/**
 * Recoge los datos y redirige a la url que contruimos en la funcion
 * @param {*} datosRespuesta 
 * @returns 
 */
function obtuvimosDatos(datosRespuesta) {
    if (datosRespuesta['respuesta'] == "404" ) {
        alert("Servicio para ordenar Rutas de Bing Maps no disponible temporalmente");
        return datosRespuesta['respuesta'];
    }

    // Si obtuvimos una respuesta, reordenamos los envíos del reparto
    // Cogemos la URL base del documento, quitando los parámetros GET si los hay
    let url = "http://localhost/dwes_tema_08/TAREA_08/public/repartos.php";

    // Añadimos el código de la lista de reparto
    url += '?action=oEnvios&idLt=' + datosRespuesta['id'];
    const respuesta =  datosRespuesta['respuesta'];
  
    // Y un array con las nuevas posiciones que deben ocupar los envíos
    //for (var r of datosRespuesta['respuesta']) url += '&pos[]=' + respuesta[r];
    for (let i=0; i < respuesta.length; i++) url += '&pos[]=' + respuesta[i];
    
    window.location = url;
}

/**
 * Comprueba que se seleccione un proudcto y que la latitud tiene algún dato
 * @returns 
 */
function semaforo() {
    var latitud = document.getElementById('lat').value
    var pro     = document.getElementById("pro").value

    if (latitud.length == 0 || pro == -1) {
        //alert("Elija un producto.");
        return false;
    }

    return true;
}

/**
 * Función que llama a la función jaxon para ocultar la lista de los envios.
 * @param {*} id 
 */
function ocultar(id){
    jaxon_vocultar(id.id);
}
