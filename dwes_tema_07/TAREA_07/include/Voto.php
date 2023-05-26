<?php

//require 'Conexion.php';
/**
 * Clase Voto que hace referencia a la tabla de Voto de la base de datos con sus setters y getters además del constructor
 * Hereda de Conexión al cual llamamos a su constructor para establecer la conexión cuando creamos un objeto de la clase
 */
class Voto extends Conexion {
    public $id;
    public $cantidad;
    public $idPr;
    public $idUs;

    public function __construc() {
        parent::__construct();
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad): void  {
        $this->cantidad = $cantidad;
    }

    /**
     * @param mixed $idPr
     */
    public function setIdPr($idPr): void {
        $this->idPr = $idPr;
    }

    /**
     * @param mixed $idUs
     */
    public function setIdUs($idUs): void {
        $this->idUs = $idUs;
    }

    /**
     * Función que inserta un voto en la base de datos
     */
    public function create() {
        $i = "insert into votos(cantidad, idPr, idUs) values(:c, :ip, :iu)";
        $stmt = self::$conexion->prepare($i);

        try {
            $stmt->execute([
                ':c'  => $this->cantidad,
                ':ip' => $this->idPr,
                ':iu' => $this->idUs
            ]);
        } catch (PDOException $ex) {
            die("Error al guardar voto: " . $ex->getMessage());
        }
    }

    /**
     * Función que devuelve la cantidad total de un producto
     */
    public function getTotalPuntos($p) {
        $c    = "select sum(cantidad) as total from votos where idPr=:p";
        $stmt = Conexion::$conexion->prepare($c);

        $stmt->execute([':p' => $p]);
        return ($stmt->fetch(PDO::FETCH_OBJ))->total;
    }

    /**
     * Función que devuelve el número de votos de un producto
     */
    public function getTotalVotos($p) {
        $c    = "select count(*) as total from votos where idPr=:p";
        $stmt = Conexion::$conexion->prepare($c);

        $stmt->execute([':p'=>$p]);
        return ($stmt->fetch(PDO::FETCH_OBJ))->total;
    }

    /**
     * Función que devuelve la media de votos de un producto
     */
    public function getMedia($p) {
        $c    = "select avg(cantidad) as media from votos where idPr=:p";
        $stmt = Conexion::$conexion->prepare($c);

        $stmt->execute([':p' => $p]);
        return ($stmt->fetch(PDO::FETCH_OBJ))->media;
    }

    /**
     * Función que nos indica si se puede o no votar
     */
    public function puedeVotar($u, $p)  {
        $c    = "select * from votos where idPr=:p AND idUs=:u";
        $stmt = Conexion::$conexion->prepare($c);

        $stmt->execute([':p' => $p, ':u' => $u]);
        
        $filas = $stmt->rowCount();
        if ($filas == 0) return true;
        return false;
    }

    /**
     * Función para eliminar votos dado un usuario y un producto
     * Devuelve true o false si se ha eliminado correctamente
     */
    public function eliminarVoto($u, $p){
        if(!$this->puedeVotar($u, $p)){
            $c    = "DELETE FROM votos WHERE idPr=:p AND idUs=:u";
            $stmt = Conexion::$conexion->prepare($c);

            $stmt->execute([':p' => $p, ':u' => $u]);
        
            $filas = $stmt->rowCount();
            if ($filas > 0 )
                return true;
        }
        return false;
    }
}
