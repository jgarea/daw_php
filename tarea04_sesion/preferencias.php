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
// Iniciamos la sesión o recuperamos la anterior sesión existente
session_start();
if (!empty($_REQUEST)) {
  
  // Comprobamos si la variable ya existe
  $_SESSION['idioma']=$_REQUEST['idioma'];
  $_SESSION['publico']=$_REQUEST['publico'];
  $_SESSION['zona_h']=$_REQUEST['zona_h'];
  
}
?>  
<div class="container col-4 mt-3 bg-light">
  <div class="pt-2">
    <h2>Preferencias de usuario</h2>
  </div>
    <?php
      if (!empty($_POST))
      echo "<p>Preferencia de usuario guardadas</p>";
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <div class="mb-3">
        <label for="idioma" class="form-label">Idioma</label>
        <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-translate" viewBox="0 0 16 16">
            <path d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286H4.545zm1.634-.736L5.5 3.956h-.049l-.679 2.022H6.18z"/>
            <path d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2zm7.138 9.995c.193.301.402.583.63.846-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6.066 6.066 0 0 1-.415-.492 1.988 1.988 0 0 1-.94.31z"/>
          </svg>
        </span>
          <select class="form-select form-select-lg" name="idioma" id="idioma">
        </div>
        <?php
        //Establecemos el valor del select por defecto dependiendo de la variable de sesión
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
        <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
          <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
          </svg>
        </span>
        <select class="form-select form-select-lg" name="publico" id="publico">
          </div>
          <?php
          //Establecemos el valor del select por defecto dependiendo de la variable de sesión
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
        <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
            <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z"/>
            <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>
          </svg>
        </span>
        <select class="form-select form-select-lg" name="zona_h" id="zona_h">
          </div>
          <?php 
          //Establecemos el valor del select por defecto dependiendo de la variable de sesión
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
      <div class="py-3">
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
