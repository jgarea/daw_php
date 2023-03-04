<?php
session_start();
require '../vendor/autoload.php';

use Clases\Jugadores;

function error($text) {
    $_SESSION['error']=$text;
    header('Location:fcrear.php');
    die();
}

$nom    = trim($_POST['nombre']);
$ape    = trim($_POST['apellidos']);
$pos    = $_POST['posicion'];
$dorsal = (int)$_POST['dorsal'];
$cod    = $_POST['barcode'];

if (strlen($nom)==0 || strlen($ape)==0) {
    error("Nombre y Apellidos deben contener algún carácter válido!!!");
}

$jugador = new Jugadores();
if ($jugador->existeDorsal($dorsal)) {
    $jugador=null;
    error("El Dorsal ya está elegido");
}

//Si hemos llegado aquí todo ha ido bien vamos a hacer el insert
$jugador->setNombre(ucwords($nom));
$jugador->setApellidos(ucwords($ape));
$jugador->setPosicion($pos);

if ($dorsal != 0) $jugador->setDorsal($dorsal);
$jugador->setBarcode($cod);
$jugador->create();
$jugador = null;

$_SESSION['mensaje'] = "Jugador creado con éxito";
header('Location:jugadores.php');