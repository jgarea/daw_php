<?php
/**
 * Script para generar el archivo wsdl a partir de las funciones de la clase Opeaciones en nuestro caso
 * Para ello necesita el servidorSoap y la clase correspondiente
 * 
 * SOLO SE PUEDE GENERAR UNA VEZ, en caso de modificación de Operaciones borrar y volver a generar
 */
require '../vendor/autoload.php';

use PHP2WSDL\PHPClass2WSDL;

$class = "Clases\\Operaciones";
$uri = 'http://127.0.0.1/dwes_tema_06_blanco/TAREA_06/servidorSoap/servicioW.php';
$wsdlGenerator = new PHPClass2WSDL($class, $uri);
$wsdlGenerator->generateWSDL(true);
$fichero = $wsdlGenerator->save('../servidorSoap/servicio.wsdl');
