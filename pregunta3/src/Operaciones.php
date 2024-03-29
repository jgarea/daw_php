<?php
// EXAMEN 3º AVALIACION DWES


namespace Clases;

require '../vendor/autoload.php';


use Clases\{Producto, Stock, Familia, Tienda};//importamos las clases e incluimos Tienda

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

    /**
     * Devuelve la ciudad con el id dado o null
     * @soap
     * @param string $id
     * @return string
     */
    public function getCiudadTienda($id){
        $tienda = new Tienda();
        $datos = $tienda->getCiudadTienda($id);
        $tienda = null;
        return $datos;

    }
    /**
     * Devuelve un array con los codigos de todas las producto
     * @soap
     * @param
     * @return string[]
     */
    public function getIdsProducto()
    {
        $prod = new Producto();
        $valores = $prod->getIdsProducto();
        $prod = null;
        return $valores;
    }
    /**
     * Devuelve un array con los codigos de todas las Tiendas
     * @soap
     * @param
     * @return string[]
     */
    public function getIdsTienda()
    {
        $tien = new Tienda();
        $valores = $tien->getIdsTienda();
        $tien = null;
        return $valores;
    }

}
