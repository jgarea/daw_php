<?php
require '../vendor/autoload.php';

//require '../servidorSoap/servidor.php';
$url = 'http://localhost/unidad06_SOAP/servidorSoap/servidor.php';
$uri = 'http://localhost/unidad06_SOAP/servidorSoap';
//$paramSaludo = ['texto' => "Manolo"];
//$param = ['a' => 51, 'b' => 29];
try {
    $cliente = new SoapClient(null, ['location' => $url, 'uri' => $uri, 'trace'=>true]);
} catch (SoapFault $ex) {
    echo "Error: ".$ex->getMessage();
}
$saludo = $cliente->__soapCall('getFamilias', array());
//$suma = $cliente->__soapCall('suma', $param);
//$resta=$cliente->__soapCall('resta', $param);
echo $saludo[0]. "Prueba";
//También podríamos hacer
//$saludo=$cliente->saludo("Manolo");