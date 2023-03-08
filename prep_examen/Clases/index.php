<?php
include "Jugadores.php";

$ju=new Jugadores();
if($ju->tieneDatos())
    echo "1";
$ju=null;