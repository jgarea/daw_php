<?php

// require 'Conexion.php';
/**
 * Clase Usuario que hace referencia a la tabla de Usuario de la base de datos con sus setters y getters además del constructor
 * Hereda de Conexión al cual llamamos a su constructor para establecer la conexión cuando creamos un objeto de la clase
 */
class Usuario extends Conexion
{
    private $usuario;
    private $pass;

    public function __construct() {
        parent::__construct();
    }

    public function setUsuario($u) {
        $this->usuario = $u;
    }

    public function setPass($p)  {
        $this->pass = $p;
    }

    /**
     * Método que crea un registro en la tabla usuarios
     */
    public function create() {
        $i = "insert into usuarios(usuario, pass) select :u, sha2(:p, '256')";
        $stmt = Conexion::$conexion->prepare($i);

        try {
            $stmt->execute(['u' => $this->usuario, 'p' => $this->pass]);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    /**
     * Método que comprueba si datos que son pasados por parametros concuerdan con los de la base de datos
     */
    public function isValido($u, $p)  {
        $pass1 = hash('sha256', $p);
        $consulta = "select * from usuarios where usuario=:u AND pass=:p";
        $stmt = Conexion::$conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':u' => $u,
                ':p' => $pass1
            ]);
        } catch (PDOException $ex) {
            die("Error al consultar usuario: " . $ex->getMessage());
        }
        $filas = $stmt->rowCount();
        if ($filas == 0) return false;
        return true;
    }

    /**
     * Comprueba si existe un usuario
     * Devuelve true or false dependiendo si existe ese usuario
     */
    public function existe($u)  {
        $c = "select * from usuarios where usuario=:u";
        $stmt = Conexion::$conexion->prepare($c);
        $stmt->execute([':u' => $u]);
        $filas = $stmt->rowCount();
        if ($filas == 0) return false;
        return true;
    }
}
