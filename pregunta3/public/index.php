<?php
    session_start();
    // ob_end_flush(); // Ojo: esto solo lo invoko para esta explicación: para ir viendo paso a paso lo que pasa

    // Establecemos los arrays siguientes lo que nos permitirá ahorrar código.
//1.- Incluimos las librerias Jaxon
//require(__DIR__ . '../vendor/autoload.php');
require '../vendor/autoload.php';
require '../include/Temperatura.php';
use Jaxon\Jaxon;
use function Jaxon\jaxon;
use Jaxon\Response\Response;

function clima($ciu){
    $respuesta = jaxon()->newResponse();
    
    
    $temp=new Temperatura($ciu);
    
    //var_dump($temp->getTiempo());
    
    $tiempo  = $temp->getTiempo();
    //var_dump($tiempo);
    if (($tiempo['cod'])==404) {
        //$resp->assign('temp', 'value', "ciudad no encontrada");
        $respuesta->alert("Ciudad no");
    }else{
        $temp    = $tiempo['main']['temp'];
        
        $tempGrados = $temp - 273.15;
        $respuesta->assign('climaID', 'innerHTML', $ciu." ".$tempGrados . "º");
        //$respuesta->alert("dsa");
    }
    //$temp=null;
    return $respuesta;
}
//3.- Creamos el objeto jaxon
$jaxon = jaxon();

// Podemos incluir las opciones que queramos
$jaxon->setOption('js.app.minify', false);
$jaxon->setOption('core.decode_utf8', true);
$jaxon->setOption('core.debug.on', false);
$jaxon->setOption('core.debug.verbose', false);


// 4.- Registramos la función que vamos a llamar desde JavaScript
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'clima', ['mode' => "'asynchronous'"]);


// 5.- El método processRequest procesa las peticiones que llegan a la página
// Debe ser llamado antes del código HTML
if($jaxon->canProcessRequest())  $jaxon->processRequest();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./script.js"></script>
</head>
<body>
    <?php
// // [JAXON-PHP]

// // Preparamos Jaxon:
// require (__DIR__ . '/include/VerTemperatura.php');

// use function Jaxon\jaxon;

// // Procesar la solicitud
// if($jaxon->canProcessRequest())  $jaxon->processRequest();

?><?php
// EXAMEN 3º AVALIACION DWES

require '../vendor/autoload.php';

use Clases\Clases1\ClasesOperacionesService;

$url = 'http://127.0.0.1/pregunta3/servidorSoap/servicio.wsdl';
try {
    $cliente = new SoapClient($url);
} catch (SoapFault $f) {
    die("Error en cliente SOAP:" . $f->getMessage());
}

$codP = 2;
$codT = 1;
$codF = 'MP3';

//---------------------------------------------------------------------------------------
$objeto = new ClasesOperacionesService();


//funcion getPvp ------------------------------------------------------------------------
$pvp = $objeto->getPvp($codP);
$precio = ($pvp == null) ? "No existe es Producto" : $pvp;
echo "Código de producto de Código $codP: $precio";


//funcion getFamilias -------------------------------------------------------------------
echo "<br>Códigos de Familas:";
$prueba = $objeto->getFamilias();
echo "<ul>";
foreach ($prueba as $k => $v) {
    echo "<code><li>$v</li></code>";
}
echo "</ul>";


//funcion getProductosFamila ------------------------------------------------------------
$productos = $objeto->getProductosFamilia($codF);
echo "<br>Productos de la Famila $codF:";
$prueba = $objeto->getProductosFamilia($codF);
echo "<ul>";
foreach ($prueba as $k => $v) {
    echo "<code><li>$v</li></code>";
}
echo "</ul>";


// funcion getStock ---------------------------------------------------------------------
$unidades = $objeto->getStock($codP, $codT);
echo "<br>Unidades del producto de código $codP en la tienda de código $codT: $unidades";


/**************************************PREGUNTA 3b)******************************************* */
// funcion getCiudadTienda ---------------------------------------------------------------------
$ciudad = $objeto->getCiudadTienda($codT);//usamos ya el código declarado
echo "<br>La ciudad de la tienda con id $codT es $ciudad";
// funcion getCiudadTienda ---------------------------------------------------------------------
$ciudad = $objeto->getCiudadTienda(2);//usamos ya el código declarado
echo "<br>La ciudad de la tienda con id 2 es $ciudad";
// funcion getCiudadTienda ---------------------------------------------------------------------
$ciudad = $objeto->getCiudadTienda(3);//usamos ya el código declarado
echo "<br>La ciudad de la tienda con id 3 es $ciudad";



/**************************************PREGUNTA 3c)******************************************** */
// echo "<script>
// // [JAXON-PHP]
// function envTemp(c) {
//     let ciudad = c;
    
//     // llamamos por AJAX al php:
//     jaxon_vCiudadTemperatura(ciudad);
    
//     // anulamos la acción por defecto del formulario:
//    return false;
// }
// </script>";
// echo "<button type='button' class='btn btn-warning' onclick='envTemp($ciudad);'>Ver datos</button>"; 

// $jaxon = jaxon();
// echo $jaxon->getCss(), "\n", $jaxon->getJs(), "\n", $jaxon->getScript(), "\n";
// echo "<!-- HTTP comment  -->\n";

$idiomas = $objeto->getFamilias();
$perfil  = $objeto->getIdsProducto();
$zonas   = $objeto->getIdsTienda();
   // Si hemos enviado las preferencias la guardamos en sesiones.
   if (isset($_POST['enviar'])) {
    $_SESSION['idioma']  = $_POST['idioma'];
    $_SESSION['perfil']  = $_POST['perfil'];
    $_SESSION['zona']    = $_POST['zona'];
    $_SESSION['ciudad']= $objeto->getCiudadTienda($_POST['zona']);
    
    $_SESSION['mensaje'] = "Preferencias de usuario guardadas.";
}
?>
<div class="container mt-5">
    <div class="d-flex justify-content-center h-100">
        <div class="card" style="width: 30rem">
            <div class="card-header">
                <h3>Preferencias Usuario </h3>
            </div>
            <div class="card-body">
<?php
                if (isset($_SESSION['mensaje'])) {
                    echo "<p class='card-text textprimary'>{$_SESSION['mensaje']}</p>";
                    unset($_SESSION['mensaje']);
                }
?>
                <form name='preferencias' method='POST' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
                    <label class="" for="id">Idioma </label>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas falanguage"> </i> </span>
                        </div>
                        <select class="form-control" name='idioma' id="id">
<?php
                    foreach ($idiomas as $k => $v) {
                        if (isset($_SESSION['idioma']) && $_SESSION['idioma'] == $k)
                            echo "<option value='$k' selected>$v</option>";
                        else
                            echo "<option value='$k'>$v</option>";
                    }
?>
                        </select>
                    </div>

                    <label class="" for="pe">Perfil Público </label>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fausers"> </i> </span>
                        </div>
                        <select class="form-control" name='perfil' id="pe">
<?php
                        foreach ($perfil as $k => $v) {
                            if (isset($_SESSION['perfil']) &&  $_SESSION['perfil'] == $k)
                                echo "<option value='$k' selected>$v</option>";
                            else
                                echo "<option value='$k'>$v</option>";
                            }
?>
                        </select>
                    </div>


                    <label class="" for="zh">Zona Horaria </label>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far faclock"> </i> </span>
                        </div>
                        <select class="form-control" name='zona' id="zh">
<?php
                        foreach ($zonas as $k => $v) {
                            if (isset($_SESSION['zona']) && $_SESSION['zona'] == $k)
                                echo "<option value='$k' selected>$v</option>";
                            else
                                echo "<option value='$k'>$v</option>";
                        }
?>
                        </select>
                    </div>
                    <?php
                    if (isset($_POST['enviar'])) {
                        $cds= $objeto->getCiudadTienda($_POST['zona']+1);
                    } else {
                        $cds=null;
                    }
                    ?>
                    
                    
                    <div class="form-group">
                        <!-- <a href="mostrar.php" class="btn btn-primary">Mostrar Preferencias </a> -->
                        <input type="submit" value="Establecer Preferencias"  class="btn float-right btn-success" name='enviar'>
                    </div>
                </form>

                <?php echo "<button onClick=\"verClima('{$cds}')\">Clima</button>";?>
                
                <span id='climaID' class="input-group form-group text-danger"></span>
            </div>
        </div>
    </div>
<?php

?>
</body>
<?php
// 6.- Injectamos los scripts javascript antes de enviar la página:
$jaxon = jaxon();
echo $jaxon->getCss(), "\n", $jaxon->getJs(), "\n", $jaxon->getScript(), "\n";
echo "<!-- HTTP comment  -->\n"
?>
</html>