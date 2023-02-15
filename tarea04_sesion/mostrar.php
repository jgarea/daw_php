<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea04</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
<?php
  
  session_start();
 
  $mensaje = "";
  $idioma = "";
  $publico = "";
  $zona_h = "";
  
  if (isset($_REQUEST['borrar'])) {
    if (isset($_SESSION['idioma'])) {
      $mensaje = "Información de la sesión eliminada";
      session_unset();
    }else{ 
      $mensaje = "No hay información para eliminar";
    }      
    $idioma = "";
    $publico = "";
    $zona_h = "";
  } else {
    // Comprobamos que existen los datos de SESSION
    if (isset($_SESSION['idioma'])) {
      $idioma = $_SESSION['idioma'];
      $publico = $_SESSION['publico'];
      $zona_h = $_SESSION['zona_h'];
    } else { // Se ha accedido a esta página sin datos de SESSION
      $idioma = "";
      $publico = "";
      $zona_h = "";
    }
  }
  

?>  
<div class="container col-4 mt-3 bg-success text-light">
    <div class="py-3">
        <h2>Preferencias</h2>
    </div>
    <span class="mensaje"><?php echo $mensaje ?></span>
    <form action="mostrar.php" method="post">
        <div>
            <p>Idioma: <?php echo $idioma ?></p>
            <p>Perfil público: <?php echo $publico ?></p>
            <p>Zona Horaria: <?php echo $zona_h ?></p>
            <div class="py-2">
                <a href="index.php"><button class="btn btn-primary" type="button">Establecer</button></a>
                <button class="btn btn-danger" type="submit" name="borrar">Borrar</button>
            </div>
        </div>
    </form>
</div>
<?php

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>