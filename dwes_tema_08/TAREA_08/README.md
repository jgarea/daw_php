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
