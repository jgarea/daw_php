<?php
// [JAXON-PHP]
spl_autoload_register(function ($clase) {
    include $clase . ".php";
});

require (__DIR__ . '/../vendor/autoload.php');


use Jaxon\Jaxon;
use function Jaxon\jaxon;

//crea el objeto jaxon, o devuelve el mismo si ya esta creado(SINGLETON)
$jaxon = jaxon();
/**
 * Funcion que crea los votos y llama a la función votoValido con el producto y la media
 * En caso de que no pueda votar mostrará el error correspondiente
 */
function miVoto($u, $p, $c) {
    $resp = jaxon()->newResponse();

    if (strlen($u) == 0 || strlen($p) == 0) {
        $resp->alert("Ni el usuario ni el producto pueden estar vacíos!!!");
    } else {
        $voto = new Voto();
        
        if ($voto->puedeVotar($u, $p)) {
            $voto->setIdPr($p);
            $voto->setIdUs($u);
            $voto->setCantidad($c);
            $voto->create();
            
            // Usando AJAX (a través de Jaxon), invocamos el método javascript votoValido
            $datosRespuesta = array( 'pro' => $p, 'media' => $voto->getMedia($p));
            $resp->call('votoValido', $datosRespuesta);
        } else {
            $resp->alert("Ya has votado ese producto !!!");
        }

        $voto = null;
    }

    return $resp;
}

/**
 * Función que elimina un voto y llama a la funcion sinValorar en caso de que haya sido eliminado
 */
function delVoto($u, $p) {
    $resp = jaxon()->newResponse();

    if (strlen($u) == 0 || strlen($p) == 0) {
        $resp->alert("Ni el usuario ni el producto pueden estar vacíos!!!");
    } else {
        $voto = new Voto();
        if ($voto->eliminarVoto($u, $p)) {
            $resp->alert("Voto eliminado");
            // Usando AJAX (a través de Jaxon), invocamos el método javascript votoValido
             $datosRespuesta = array( 'pro' => $p);
             $resp->call('sinValorar', $datosRespuesta);
        } else {
            $resp->alert("No se ha podido eliminar");
        }
        $voto = null;
    }
    return $resp;
}

/**
 * Función para mostrar el número de estrellas dentro de la tabla , muestra media estrella en caso de que sea necesario
 */
function pintarEstrellas($c, $p) {
    $voto      = new Voto();
    $total     = $voto->getTotalVotos($p);
    $voto      = null;

    $resp      = jaxon()->newResponse();
    $en        = intval($c);
    $dec       = $c - $en;
    $estrellas = "$total Valoraciones. ";

    if ($en > 0) {
        for ($i = 1; $i <= $en; $i++) {
            $estrellas .= "<i class='fas fa-star'></i>";
        }
        if ($dec >= 0.5)
            $estrellas .= "<i class='fas fa-star-half-alt'></i>";
    }

    $resp->assign("votos_$p", "innerHTML", $estrellas);
    
    return $resp;
}

/**
 * Función para añadir "Sin valorar" al producto correspondiente, indicando que no tiene voto ya que ha sido eliminado
 */
function ponerDefecto($p) {

    $resp      = jaxon()->newResponse();
    $estrellas = "Sin Valorar";

    $resp->assign("votos_$p", "innerHTML", $estrellas);
    
    return $resp;
}

//Registra las funciones anteriores
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'delVoto');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'miVoto');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'pintarEstrellas');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'ponerDefecto');

