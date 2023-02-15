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

if (!empty($_REQUEST)) {
  // Iniciamos la sesión o recuperamos la anterior sesión existente
  session_start();
  // Comprobamos si la variable ya existe
  $_SESSION['idioma']=$_REQUEST['idioma'];
  $_SESSION['publico']=$_REQUEST['publico'];
  $_SESSION['zona_h']=$_REQUEST['zona_h'];
  
}
?>  
<div class="container col-4 mt-3">
    <?php
      if (!empty($_POST))
      echo "<p>Preferencia de usuario guardadas</p>";
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <div class="mb-3">
        <label for="idioma" class="form-label">Idioma</label>
        <select class="form-select form-select-lg" name="idioma" id="idioma">
        <?php
          if (isset($_SESSION['idioma'])) { 
            if($_SESSION['idioma']=="ingles") { ?>
            <option value="español">Español</option>
            <option value="ingles" selected>Inglés</option>
          <?php } else if ($_SESSION['idioma']=="español") { ?>
            <option value="español" selected>Español</option>
            <option value="ingles">Inglés</option>
          <?php } } else {  ?>
            <option value="español">Español</option>
            <option value="ingles">Inglés</option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="publico" class="form-label">Perfil público</label>
        <select class="form-select form-select-lg" name="publico" id="publico">
          <?php
          if (isset($_SESSION['publico'])) { 
            if($_SESSION['publico']=="no") { ?>
            <option value="si">Si</option>
            <option value="no" selected>No</option>
          <?php } else if ($_SESSION['publico']=="si") { ?>
            <option value="si" selected>Si</option>
            <option value="no">No</option>
          <?php } } else {  ?>
            <option value="si">Si</option>
            <option value="no">No</option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="zona_h" class="form-label">Zona horaria</label>
        <select class="form-select form-select-lg" name="zona_h" id="zona_h">
          <?php 
          switch ($_SESSION['zona_h']) { 
            
            case 'GMT-2':
            ?>
              <option value="GMT-2" selected>GMT-2</option>
              <option value="GMT-1">GMT-1</option>
              <option value="GMT">GMT</option>
              <option value="GMT+1">GMT+1</option>
              <option value="GMT+2">GMT+2</option>
              <?php
              break; ?><?php
            case 'GMT-1':
            ?>
              <option value="GMT-2">GMT-2</option>
              <option value="GMT-1" selected>GMT-1</option>
              <option value="GMT">GMT</option>
              <option value="GMT+1">GMT+1</option>
              <option value="GMT+2">GMT+2</option>
              <?php
              break; ?><?php
            case 'GMT':
            ?>
              <option value="GMT-2">GMT-2</option>
              <option value="GMT-1">GMT-1</option>
              <option value="GMT" selected>GMT</option>
              <option value="GMT+1">GMT+1</option>
              <option value="GMT+2">GMT+2</option>
              <?php
              break; ?><?php
            case 'GMT+1':
            ?>
              <option value="GMT-2">GMT-2</option>
              <option value="GMT-1">GMT-1</option>
              <option value="GMT">GMT</option>
              <option value="GMT+1" selected>GMT+1</option>
              <option value="GMT+2">GMT+2</option>
              <?php
              break; ?><?php
            case 'GMT+2':
            ?>
              <option value="GMT-2">GMT-2</option>
              <option value="GMT-1">GMT-1</option>
              <option value="GMT">GMT</option>
              <option value="GMT+1">GMT+1</option>
              <option value="GMT+2" selected>GMT+2</option>
              <?php
              break; ?>
            
              <?php
            default:?>
              <option value="GMT-2">GMT-2</option>
              <option value="GMT-1">GMT-1</option>
              <option value="GMT">GMT</option>
              <option value="GMT+1">GMT+1</option>
              <option value="GMT+2">GMT+2</option>
              <?php break;
          }
          ?>
          
        </select>
      </div>
      <div>
          <button class="btn btn-primary" type="submit">Establecer preferencias</button>
          <a name="" id="" class="btn btn-success" href="mostrar.php" role="button">Mostrar preferencias</a>
      </div>
    </form>
</div>
<?php

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
