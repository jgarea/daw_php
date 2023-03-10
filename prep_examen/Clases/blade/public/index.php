<?php
session_start();
require '../vendor/autoload.php';

use Clases\Jugadores;
use Philo\Blade\Blade;

$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);

$titulo     = 'Jugadores';
$encabezado = 'Listado de Jugadores';
$jugadores  = (new Jugadores())->recuperarJugadores();



echo $blade
->view()
->make('vjugadores', compact('titulo', 'encabezado','jugadores'))
->render();


