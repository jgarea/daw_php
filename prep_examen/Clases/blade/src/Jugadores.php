<?php

namespace Clases;

use PDO;
use PDOException;

class Jugadores extends Conexion{
    private $id;
    private $nombre;
    private $apellidos;
    private $dorsal;
    private $posicion;
    private $barcode;

    public function __construct(){
        parent::__construct();
    }

    public function recuperarJugadores(){
        $consulta="select * from jugadores order by posicion, apellidos";
        $stmt    = $this->conexion->prepare($consulta);

        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al recuperar los jugadores: ".$ex->getMessage());
        }
        $this->conexion=null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function existeDorsal($d){
        $consulta="select * from jugadores where dorsal=:d";
        $stmt    = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([':d' => $d]);
        } catch (PDOException $ex) {
            die("Error al comprobar dorsal: ".$ex->getMessage());
        }
        if ($stmt->rowCount()==0) {
            return false;
        }
        else {
            return true;
        }
    }

    public function existeBarcode($b){
        $consulta="select * from jugadores where barcode=:b";
        $stmt    = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([':b' => $b]);
        } catch (PDOException $ex) {
            die("Error al comprobar código de barras: ".$ex->getMessage());
        }
        if ($stmt->rowCount()==0) {
            return false;
        }
        else {
            return true;
        }
    }

    public function create(){
        $insert="insert into jugadores(nombre, apellidos, dorsal, posicion, barcode) values(:n, :a, :d, :p, :b)";
        $stmt    = $this->conexion->prepare($insert);
        try {
            $stmt->execute([':n' => $this->nombre,
                            ':a' => $this->apellidos,
                            ':d' => $this->dorsal,
                            ':p' => $this->posicion,
                            ':b' => $this->barcode]);
        } catch (PDOException $ex) {
            die("Error al insertar jugadores: ".$ex->getMessage());
        }
    }

    public function borrarTodo(){
        $insert="delete from jugadores";
        $stmt    = $this->conexion->prepare($insert);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al borrar jugadores: ".$ex->getMessage());
        }
    }

    public function tieneDatos(){
        $consulta="select * from jugadores";
        $stmt    = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al comprobar si hay datos: ".$ex->getMessage());
        }
        if ($stmt->rowCount()==0) {
            return false;
        }
        else {
            return true;
        }
    }

     
    public function setId($id)
    {
        $this->id = $id;  
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;  
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;  
    }

    public function setDorsal($dorsal)
    {
        $this->dorsal = $dorsal;  
    }

    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;  
    }

    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;  
    }
}