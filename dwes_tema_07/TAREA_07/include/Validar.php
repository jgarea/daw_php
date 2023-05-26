<?php
// [JAXON-PHP]
require 'Conexion.php';
require 'Usuario.php';
require (__DIR__ . '/../vendor/autoload.php');

use Jaxon\Jaxon;
use function Jaxon\jaxon;

//crea el objeto jaxon, o devuelve el mismo si ya esta creado(SINGLETON)
$jaxon = jaxon();

// Opciones de configuración Jaxon: 
$jaxon->setOption('js.app.minify', false);
$jaxon->setOption('core.decode_utf8', true);
$jaxon->setOption('core.debug.on', false);
$jaxon->setOption('core.debug.verbose', false);

/**
 * Comrpueba el login del usuario, y crea una sesion de usuario en caso de que sea correcto, llama a las funciones validado o noValidado
 * dependiendo de si es correcto el usuario con su contraseña
 */
function vUsuario($u, $p)  {
    $resp = jaxon()->newResponse();
    if (strlen($u) == 0 || strlen($p) == 0) {
        $resp->call('noValidado');
    } else {
        $usuario = new Usuario();
        if (!$usuario->isValido($u, $p)) {
            $resp->call('noValidado');
        } else {
            session_start();
            $_SESSION['usu'] = $u;
            $resp->call('validado');
        }
        $usuario = null; //cierra la conexión
    }

    return $resp;
}

$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'vUsuario'); //Registra la función vUsuario
