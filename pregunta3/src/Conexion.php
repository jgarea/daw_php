<?php
// EXAMEN 3º AVALIACION DWES

namespace Clases;

use PDO;
use PDOException;

class Conexion
{
    protected static $conexion;


    public function __construct()
    {
        if (self::$conexion == null) {
            self::crearConexion();
        }
    }

    public static function crearConexion()
    {
        /*************************PREGUNTA 3a)******************************** */
        //cambiamos los parámetros para que funcione
        $user = "alumnado";
        $pass = "abc123.";
        $base='pregunta3';
        $dsn = "mysql:host=localhost;dbname=$base;charset=utf8mb4";
        
        try {
            self::$conexion = new PDO($dsn, $user, $pass);
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die("Error en la conexión: mensaje: " . $ex->getMessage());
        }
    }
}

