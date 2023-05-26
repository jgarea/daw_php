<?php
/**
 * Para cerrar la sesión de usuario
 */
session_start();

if (isset($_SESSION['usu'])) unset($_SESSION['usu']);

header('Location:login.php');
