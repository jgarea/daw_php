<?php
/**
 * cliente.php
 * Cliente para probar el servidor soap, en este fichero creamos un SoapClient con el primer parámetro a null indicando que 
 * no necesita un fichero wsdl para poner en marcha el servidor. Mediante la función soapcall del objeto cliente
 * hacemos una llamada a las funciones que están en nuestra clase Operaciones(se indica en el servicio.php)
 * 
 * Probamos cada una de las funciones con un parámetro, en caso de que la función no necesite un parámetro se le pasa
 * un array vacio, en otro caso un array con los parametros necesarios.
 */
$url = 'http://127.0.0.1/dwes_tema_06_blanco/TAREA_06/servidorSoap/servicio.php';
$uri = 'http://127.0.0.1/dwes_tema_06_blanco/TAREA_06/servidorSoap';


try {
    $cliente = new SoapClient(null, ['location' => $url, 'uri' => $uri]);
} catch (SoapFault $f) {
    die("Error en cliente SOAP:" . $f->getMessage());
}
$codP = 2;
$codT = 14;
$codF = 'CONSOL';

//funcion getPvp ----------------------------------------------------------------------------
$pvp = $cliente->__soapCall('getPvp', ['id' => $codP]);
$precio = ($pvp == null) ? "No existe es Producto" : $pvp;
echo "Código de producto de Código $codP: $precio";


//funcion getFamilias -----------------------------------------------------------------------
echo "<br>Código de Familas";
$familias = $cliente->__soapCall('getFamilias', []);
echo "<ul>";
foreach ($familias as $k => $v) {
    echo "<code><li>$v</li></code>";
}
echo "</ul>";

//funcion getProductosFamila ----------------------------------------------------------------
$productos = $cliente->__soapCall('getProductosFamilia', ['codF' => $codF]);
echo "<br>Productos de la Famila $codF:";
echo "<ul>";
foreach ($productos as $k => $v) {
    echo "<code><li>$v</li></code>";
}
echo "</ul>";

// funcion getStock -------------------------------------------------------------------------
$unidades = $cliente->__soapCall('getStock', ['codP' => $codP, 'codT' => $codT]);
echo "<br>Unidades del producto de código; $codP en la tienda de código: $codT: $unidades";
