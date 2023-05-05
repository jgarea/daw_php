<?php
/**
 * Script para generar las clases mediante el Wsdl2PhpGenerator que convierte el wsdl por clases.
 * La clase generador necesita un paramámetro que es un objeto Config el cual tiene tres parámetros
 * La dirección del wsdl
 * Donde las va a generar
 * Y el espacio de nombres correspondiente
 * 
 * SOLO SE GENERA UNA VEZ
 */
require '../vendor/autoload.php';

use Wsdl2PhpGenerator\Generator;
use Wsdl2PhpGenerator\Config;

$generator = new Generator();
$generator->generate(
    new Config([
        'inputFile' => 'http://127.0.0.1/dwes_tema_06_blanco/TAREA_06/servidorSoap/servicioW.php?wsdl',
        'outputDir' => '../src/Clases1',
        'namespaceName' => 'Clases\Clases1'
    ])
);
