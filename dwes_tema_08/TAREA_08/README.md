# Funcionalidad añadida
* Realizar la función ocultar tarea por jaxon
* En ``repartos.php``

Cambiamos el boton para que llame a la función ocultar
```php
//Cambiamos la funcionalidad para que al darle click llame a la función ocultar pasandole la id, que lo realice con una petición asíncrona con jaxon
echo "<button class='btn btn-primary mr-2 btn-sm' onClick=\"ocultar({$lista->getId()})\"><i class='fas fa-eye-slash mr-1'></i></i>Ocultar orden</button>\n";
```

Añadir el id en el formulario

```php
//Añadimos un id con la lista para poder seleccionarlo
echo "<form name='1' action='rutas.php' method='POST' id=\"".$lista->getId()."\">";
```

* En ``funciones.js``
```javascript
/**
 * Función que llama a la función jaxon para ocultar la lista de los envios.
 * @param {*} id 
 */
function ocultar(id){
    jaxon_vocultar(id.id);
}
```

* En ``Tool.php``
```php
/**
 * Función que elimina la sesión con la id donde está almacenda las tareas 
 * y selecciona la etiqueta con la id indicada y pone en el campo innerHTML la cadena vacia
 * para ocultar las tareas hasta que se presione de nuevo ordenar.
 */
function vocultar($id) {
    $resp = jaxon()->newResponse();
    unset($_SESSION[$id]);
    $resp->assign($id, 'innerHTML', '');
    
    return $resp;
}
```


# funciones útiles

Validar un número con sin signo
```regexp
^[+-]?\d+(\.\d+)?$
```
``explode()``

 Esta función divide un string en partes utilizando un delimitador y devuelve un array con esas partes. 

``implode()``

Esta función une los elementos de un array en un solo string, utilizando un separador opcional. 

``preg_match()``
```php
$regex = '/^\d{3}-\d{3}-\d{4}$/'; // Expresión regular para validar un número de teléfono en el formato XXX-XXX-XXXX
$phone = '123-456-7890';

if (preg_match($regex, $phone)) {
    echo "El número de teléfono es válido.";
} else {
    echo "El número de teléfono no es válido.";
}
```
``preg_split()``

— Divide un string mediante una expresión regular


```php
preg_split(
    string $pattern,
    string $subject,
    int $limit = -1,
    int $flags = 0
): array
```