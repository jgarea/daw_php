<?php
// DWES-PHP-B06-03

$a1 = 1;
$r1 = true || ++$a1;

$a2 = 1;
$r2 = false || ++$a2;

$a3 = 1;
$r3 = ++$a3 || true;

$a4 = 1;
$r4 = false && ++$a4;

$a5 = 0;
$b5 = 1;
$r5 = $a5++ && $b5++;

$a6 = 1;
$b6 = 0;
$r6 = --$a6 || $b6++;

$a7 = 1;
$r7 = --$a7 || $a7++;

$a8 = 1;
$r8 = --$a8 && $a8++;

$a9 = 1;
$r9 = $a9-- && $a9++;


// Leyes de De Morgan:
$a10 = true;
$b10 = true;
$r10a = !($a10 && $b10) === (!$a10 || !$b10);
$r10aa = !($a10 && $b10) === !$a10 || !$b10;

$a10 = true;
$b10 = false;
$r10b = !($a10 && $b10) === (!$a10 || !$b10);
$r10bb = !($a10 && $b10) === !$a10 || !$b10;

$a10 = false;
$b10 = true;
$r10c = !($a10 && $b10) === (!$a10 || !$b10);
$r10cc = !($a10 && $b10) === !$a10 || !$b10;

$a10 = false;
$b10 = false;
$r10d = !($a10 && $b10) === (!$a10 || !$b10);
$r10dd = !($a10 && $b10) === !$a10 || !$b10;


$a11 = true;
$b11 = true;
$r11a = !($a11 || $b11) === (!$a11 && !$b11);
$r11aa = !($a11 || $b11) === !$a11 && !$b11;

$a11 = true;
$b11 = false;
$r11b = !($a11 || $b11) === (!$a11 && !$b11);
$r11bb = !($a11 || $b11) === !$a11 && !$b11;

$a11 = false;
$b11 = true;
$r11c = !($a11 || $b11) === (!$a11 && !$b11);
$r11cc = !($a11 || $b11) === !$a11 && !$b11;

$a11 = false;
$b11 = false;
$r11d = !($a11 || $b11) === (!$a11 && !$b11);
$r11dd = !($a11 || $b11) === !$a11 && !$b11;




echo PHP_EOL . "FIN";
?>