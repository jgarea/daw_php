<?php
/**
 * Clase que hace relación a tabla stock de la base de datos
 * Hereda de Conexión para poder realizar consultas con la base de datos
 * Tiene atributos conforme los campos que tenga y getters y setters
 * 
 * Además la clase Stock tiene la siguiente función:
 * getUnidadesTienda() devuelve las unidades donde el producto y la tienda son iguales a los atributos de la clase Stock
 */

namespace Clases;

use \PDO;

require '../vendor/autoload.php';

class Stock extends Conexion
{
    private $producto;
    private $tienda;
    private $unidades;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * @param mixed $producto
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;
    }

    /**
     * @return mixed
     */
    public function getTienda()
    {
        return $this->tienda;
    }

    /**
     * @param mixed $tienda
     */
    public function setTienda($tienda)
    {
        $this->tienda = $tienda;
    }

    /**
     * @return mixed
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * @param mixed $unidades
     */
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    }
    /*
     * @param
     * @return int|null
     */
    public function getUnidadesTienda()
    {
        $consulta = "select unidades from stocks where producto=:p AND tienda=:t";
        $stmt = self::$conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':p' => $this->producto,
                ':t' => $this->tienda
            ]);
        } catch (\PDOException $ex) {
            die("Error al recuperar los unidades: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) return 0;
        return ($stmt->fetch(PDO::FETCH_OBJ))->unidades;
    }
}
