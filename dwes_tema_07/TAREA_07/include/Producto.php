<?php
//require 'Conexion.php';
/**
 * Clase Producto que hace referencia a la tabla de Producto de la base de datos con sus setters y getters además del constructor
 * Hereda de Conexión al cual llamamos a su constructor para establecer la conexión cuando creamos un objeto de la clase
 */
class Producto extends Conexion  {
    private $id;
    private $nombre;
    private $nombre_corto;
    private $pvp;
    private $famila;
    private $descripcion;

    /**
     * Producto constructor.
     */
    public function __construct()  {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getId()  {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)  {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getNombreCorto() {
        return $this->nombre_corto;
    }

    /**
     * @param mixed $nombre_corto
     */
    public function setNombreCorto($nombre_corto) {
        $this->nombre_corto = $nombre_corto;
    }

    /**
     * @return mixed
     */
    public function getPvp() {
        return $this->pvp;
    }

    /**
     * @param mixed $pvp
     */
    public function setPvp($pvp) {
        $this->pvp = $pvp;
    }

    /**
     * @return mixed
     */
    public function getFamila() {
        return $this->famila;
    }

    /**
     * @param mixed $famila
     */
    public function setFamila($famila)  {
        $this->famila = $famila;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()  {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    /**
     * Método que devuelve todos los productos ordenados por ID
     * @param
     * @return float|null
     */
    public function listadoProductos()  {
        $consulta = "select * from productos order by id";
        $stmt = self::$conexion->prepare($consulta);
        
        try {
            $stmt->execute();
        } catch (\PDOException $ex) {
            die("Error al recuperar los productos" . $ex->getMessage());
        }

        return $stmt;
    }
}
