<?php

// Definir el tamaño del rombo
$tamano = 5;

// Crear la tabla HTML con forma de rombo
echo '<table>';

// Dibujar la parte superior del rombo
for ($i = 1; $i <= $tamano; $i++) {
  echo '<tr>';
  // Imprimir celdas vacías para centrar la línea de celdas
  for ($j = $tamano - $i; $j > 0; $j--) {
    echo '<td></td>';
  }
  // Imprimir celdas de la línea del rombo
  for ($j = 1; $j <= $i * 2 - 1; $j++) {
    echo '<td>*</td>';
  }
  echo '</tr>';
}

// Dibujar la parte inferior del rombo
for ($i = $tamano - 1; $i >= 1; $i--) {
  echo '<tr>';
  // Imprimir celdas vacías para centrar la línea de celdas
  for ($j = $tamano - $i; $j > 0; $j--) {
    echo '<td></td>';
  }
  // Imprimir celdas de la línea del rombo
  for ($j = 1; $j <= $i * 2 - 1; $j++) {
    echo '<td>*</td>';
  }
  echo '</tr>';
}

echo '</table>';

?>
