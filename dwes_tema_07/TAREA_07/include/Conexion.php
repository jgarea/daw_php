<?php

/**
 * Clase conexión el cual establece la conexión con la base de datos y heredan todas las clases que encesiten 
 * una conexión, tiene un atributo protected que es el cual las clases heredadas utilzian.
 */
class Conexion
{
    protected static $conexion;

    public function __construct()  {
        if (self::$conexion == null) {
            self::crearConexion();
        }
    }

    public static function crearConexion()  {
        $user = "gestor";
        $pass = "secreto";
        $base = 'proyecto';
        $dsn  = "mysql:host=localhost;dbname=$base;charset=utf8mb4";

        try {
            self::$conexion = new PDO($dsn, $user, $pass);
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die("Error en la conexión: mensaje: " . $ex->getMessage());
        }
    }
}
