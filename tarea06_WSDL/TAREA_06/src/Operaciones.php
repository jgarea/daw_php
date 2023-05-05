<?php
/**
 * Clase que nos define nuestro servicio WEB
 * En ella se encuentra cada unas de las funciones, parámetros, lo que devuelve esas funciones y sus tipos
 * 
 * Tiene que estar comentadas correctamente para que despues nuestro script generarWsdl genere el fichero correcto
 * En cada uno de los métodos crea un objeto que hace relación a la tabla(es la que lleva la conexión) y trabajamos con
 * ese objeto para llamar a la función, pasando los valores por parámetro o modificando los atributos del objeto uilizando 
 * un setter previamente.
 * 
 * Antes de devolver el valor o valores cerramos la conexión.
 */

namespace Clases;

require '../vendor/autoload.php';


use Clases\{Producto, Stock, Familia};

class Operaciones
{
    /**
     * Obtiene el PVP de un producto a partir de su codigo
     * @soap
     * @param int $codP
     * @return float
     */
    public function getPvp($codP)
    {
        $producto = new Producto();
        $producto->setId($codP);
        $precio = $producto->getPrecio();
        $producto = null;
        return $precio;
    }
    /**
     * Devuelve el numero de unidades que existen en una tienda de un producto
     * @soap
     * @param int $codP
     * @param int $codT
     * @return int
     */
    public function getStock($codP, $codT)
    {
        $stock = new Stock();
        $stock->setProducto($codP);
        $stock->setTienda($codT);
        $uni = $stock->getUnidadesTienda();
        $stock = null;
        return $uni;
    }
    /**
     * Devuelve un array con los codigos de todas las familias
     * @soap
     * @param
     * @return string[]
     */
    public function getFamilias()
    {
        $familas = new Familia();
        $valores = $familas->getFamilias();
        $familas = null;
        return $valores;
    }
    /**
     * Devuelve un array con los nombres de los productos de una familia
     * @soap
     * @param string $codF
     * @return string[]
     */
    public function getProductosFamilia($codF)
    {
        $productos = new Producto();
        $datos = $productos->productoFamila($codF);
        $productos = null;
        return $datos;
    }
}
