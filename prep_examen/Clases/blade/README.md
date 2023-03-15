# Clases con plantilla blade
1. Crear carpeta vendor y cache
2. Abir la terminal en la carpeta e iniciar composer con 

`composer init`
```
Package name (<vendor>/<name>) [juan/blade]: 
Description []: descripcion
Author [Juan Eugenio Antón Area <jgntra@gmail.com>, n to skip]: 
Minimum Stability []: 
Package Type (e.g. library, project, metapackage, composer-plugin) []: project
License []: GPL

Define your dependencies.

Would you like to define your dependencies (require) interactively [yes]? n
Would you like to define your dev dependencies (require-dev) interactively [yes]? n
Add PSR-4 autoload mapping? Maps namespace "Juan\Blade" to the entered relative path. [src/, n to skip]:
```

3. Cambiar el **composer.json** que generó
```json
{
    "name": "juan/blade",
    "description": "descripcion",
    "type": "project",
    "license": "GPL",
    "autoload": {
        "psr-4": {
            "Juan\\Blade\\": "src/"
        }
    },
    "authors": [
        {
            "name": "Juan Eugenio Antón Area",
            "email": "jgntra@gmail.com"
        }
    ],
    "require": {}
}
```

POR

```json
{
    "name": "juan/blade",
    "description": "descripcion",
    "type": "project",
    "license": "GPL",
    "config": {
        "optimize-autoloader": true,
        "allow-plugins": {
            "kylekatarnls/update-helper": true
        }
    },
    "autoload": {
        "psr-4": {
            "Clases\\": "src/"
        }
    },
    "authors": [
        {
            "name": "Juan Eugenio Antón Area",
            "email": "jgntra@gmail.com"
        }
    ],
    "require": {}
}
```
4. Instalamos los paquetes que necesitemos en la terminal con: 

`composer require nombredelpaquete\nombredelaaplicacion`

Comenzamos instalando el blade que es el gestor de plantillas.

`composer require philo/laravel-blade`


5. Creamos la carpeta views y plantillas

6. En plantillas ponemos la plantilla general(**plantilla1.blade.php**):

```html
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- css para usar Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<title>@yield('titulo')</title>
</head>
<body style="background:#0277bd">
<div class="container mt-3">
    <h3 class="text-center mt-3 mb-3">@yield('encabezado')</h3>
    @yield('contenido')
</div>
</body>
</html>
```

@yield('titulo') @yield('encabezado') y @yield('contenido') se van a sustituir por las que le pasemos al blade

7. Creamos al carpeta **src** que es donde vamos a guardar las clases, clases que almacenaran los datos y los manipularan, y la conexión.

8. Creamos el fichero **Conexion.php** en **src**:

```php
<?php 

namespace Clases;

use PDO;
use PDOException;

class Conexion
{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $dsn;
    protected $conexion;

    public function __construct()
    {
        $this->host = "localhost";
        $this->db = "practicaunidad5";
        $this->user = "gestor";
        $this->pass = "secreto";
        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
        $this->crearConexion();
    }

    public function crearConexion()
    {
        try {
            $this->conexion = new PDO($this->dsn, $this->user, $this->pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die("Error en la conexión: mensaje: " . $ex->getMessage());
        }
        return $this->conexion;
    }
}
```

10. Y una clase con el nombre de los datos que queramos manipular
`Jugadores.php`
``` php
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
```
11. Creamos la carpeta **public** si no la tenemos creada ahi es donde creamos el código.

12. Creamos un **index.php** donde vamos a visualziar todos los jugadores en la carpeta public

```php
//Cargamos el Blade y la clase Jugadores que está en src
<?php
session_start();
require '../vendor/autoload.php';

use Clases\Jugadores;
use Philo\Blade\Blade;

$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);
```
```php
//Utilizamos las variables que queramos enviar a la vista(en la plantilla1 necesitamos un titulo y un encabezado)
$titulo     = 'Jugadores';
$encabezado = 'Listado de Jugadores';
//Recogemos los jugadores, recuperamos el SELECT * from jugadores que nos devuelve un fetchAll en forma de objetos 
$jugadores  = (new Jugadores())->recuperarJugadores();
```
Por último se visualiza la vista, vjugadores que crearemos a continuacion
```php
echo $blade
->view()
->make('vjugadores', compact('titulo', 'encabezado','jugadores'))
->render();
```
13. Creamos **vjugadores.blade.php** en views
```php
@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection
@section('encabezado')
    {{$encabezado}}
@endsection
@section('contenido')
    <table>
        <thead>
            <tr>
                <th>Nombre completo</th>
                <th>Posición</th>
                <th>Dorsal</th>
            </tr>
        </thead>
        <tbody>
        @foreach($jugadores as $item)
            <tr class="text-center">
                <th>{{$item->apellidos.", ".$item->nombre}}</th>
                <td>{{$item->posicion}}</td>
                @if(isset($item->dorsal))
                    <td>{{$item->dorsal}}</td>
                @else
                    <td>Sin Asignar</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
```