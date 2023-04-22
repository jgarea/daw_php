<?php
/*
getPVP. Esta función recibirá como parámetro el código de un producto, y devolverá el PVP correspondiente al mismo.
getStock. Esta función recibirá dos parámetros: el código de un producto y el código de una tienda. Devolverá el stock existente en dicha tienda del producto.
getFamilias. No recibe parámetros y devuelve un array con los códigos de todas las familias existentes.
getProductosFamilia. Recibe como parámetro el código de una familia y devuelve un array con los códigos de todos los productos de esa familia.
*/

namespace Clases;


class Operaciones{
    public function getFamilias() {
        $familia= new Familia();
        $familias = $familia->getFamilias();
        return $familias;
    }


    
}