<?php
//namespace Clases;
require '../vendor/autoload.php';


//require_once('../src/Operaciones.php');

use Clases\Operaciones;

$operaciones = new Operaciones();

$uri='http://localhost/tarea06_SOAP/servidorSoap';
$parametros=['uri'=>$uri];
try {
    $server = new SoapServer(NULL, $parametros);
    $server->setClass('Clases\Operaciones');
    $server->handle();
} catch (SoapFault $f) {
    die("error en server: " . $f->getMessage());
}