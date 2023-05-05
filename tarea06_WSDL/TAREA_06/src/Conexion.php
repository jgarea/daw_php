<?php

/**
 * Clase para crear una conexión con la base de datos, tiene una variable protected para que la hereden las clases hijas y puedan utilizar la conexión
 * 
 * Si no hay conexión la crea, en caso de que yas exista la conexión no la vuelve a crear
 * 
 * Modificamos los parametros de usuario, contraseña, nombre de base de datos, y tipo de base de datos por los nuestros.
 */
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
        $user = "gestor";
        $pass = "secreto";
        $base='tarea6';
        $dsn = "mysql:host=localhost;dbname=$base;charset=utf8mb4";
        
        try {
            self::$conexion = new PDO($dsn, $user, $pass);
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die("Error en la conexión: mensaje: " . $ex->getMessage());
        }
    }
}

