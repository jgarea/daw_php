<?php
/**
 * Servidor SOAP que no necesita un wsdl para el servicio 
 * Crea un objeto SoapServer(NULL para indicar que no necesita un wsdl) le asigna la clase operaciones y lanza el servicio.
 */
require '../vendor/autoload.php';

$uri = "http://127.0.0.1/dwes_tema_06_blanco/TAREA_06/servidorSoap";
$parametros = ['uri' => $uri];

try {
    $server = new SoapServer(NULL, $parametros);
    $server->setClass('Clases\Operaciones');
    $server->handle();
} catch (SoapFault $f) {
    die("error en server: " . $f->getMessage());
}
