<?php
/* 
 *  Comprobar formato (no comprueba rangos) entero válido
 *  en entrada formulario
 *
*/
function formatoEnteroValido(string $cadena) {
    $cadena = trim($cadena);

    // Comprobar si tiene signo:
    $signo = mb_substr($cadena, 0, 1);

    if ($signo === "-" || $signo === "+") {
        $signo = ($signo === "-" ? -1 : 1);
        $cadena = mb_substr($cadena, 1, mb_strlen(($cadena) - 1) );
    } else {
        $signo = 1;
    }

    if ( ctype_digit($cadena) ) {
        return $signo * $cadena;
    } else {
        return "NOVALIDO";
    }
}

?>