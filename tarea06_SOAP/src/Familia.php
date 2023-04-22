<?php

namespace Clases;

use PDO;
use PDOException;

class Familia extends Conexion{
    private $cod;
    private $nombre;

    public function __construct(){
        parent::__construct();
    }

    public function getFamilias(){
        $consulta="select cod from tarea6";
        $stmt    = $this->conexion->prepare($consulta);

        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al recuperar las familias: ".$ex->getMessage());
        }
        $this->conexion=null;
        //return $stmt->fetchAll(PDO::FETCH_OBJ);
        $familias = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $familias[] = $row->cod;
        }
        return $familias;
    }
}