// [JAXON-PHP]
/**
 * Función que envia el número del selector a la función miVoto
 * @param {*} usu 
 * @param {*} pro 
 */
function envVoto(usu, pro) {
    id = "spuntos_" + pro;
    var puntos = document.getElementById(id).value;
    
    jaxon_miVoto(usu, pro, puntos);
}

/**
 * Función que llama a la función pintarEstrellas
 * @param {*} datos 
 */
function votoValido(datos) {
    jaxon_pintarEstrellas(datos['media'], datos['pro']);
}

/**
 * Funcion que dado un usuario y producto llama a la función delVoto para eliminar el voto
 * @param {*} usu 
 * @param {*} pro 
 */
function bVoto(usu, pro) {    
    jaxon_delVoto(usu, pro);
}
/**
 * Función que dado un producto, llama a la función ponerDefecto que establece el producto en "Sin valorar"
 * @param {*} datos 
 */
function sinValorar(datos) {
    jaxon_ponerDefecto(datos['pro']);
}