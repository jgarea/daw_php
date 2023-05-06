Esta carpeta contiene una versión a "cero" de diversos ejercicios:
1. en varios hay que hacer "composer update"
2. corregir el bug de wsdl2phpgenerator  (ver ASISO.txt)
3. Generdar las clases (wsdl2phpgenerator) o/y el wsdl (php2wsdl)
4. Cambiar el nombre de la carpeta raiz por dwes_tema_06_blanco y lanzarlo desde la raiz del servidor web.

# Pasos a seguir
* En ``php.ini`` la extensión soap tiene que estar descomentada ``extension=soap`` y la cache tiene que estar en Off ``soap.wsdl_cache_enabled=0`` se comprueba con el siguiente comando en la terminal.
```bash
php -i | findstr /I "soap"
```
Dando el resultado siguiente
```
Soap Client => enabled
Soap Server => enabled
soap.wsdl_cache => 1 => 1
soap.wsdl_cache_dir => /tmp => /tmp
soap.wsdl_cache_enabled => Off => Off
soap.wsdl_cache_limit => 5 => 5
soap.wsdl_cache_ttl => 86400 => 86400
```

* Si el proyecto tiene un ```composer.json``` puedes cambiar el name como los author y hacer un ```composer update``` en caso de que no tenga un ``composer.json`` hacer un ```composer init```

* Para el ``composer init`` debes crear la carpeta vendor primero (la cache a priori no hace falta si da error creala)
```
Package name (<vendor>/<name>) [juan/blade]: 
Description []: descripcion
Author [Juan Eugenio Antón Area <jgntra@gmail.com>, n to skip]: 
Minimum Stability []: 
Package Type (e.g. library, project, metapackage, composer-plugin) []: project
License []: GPL

Define your dependencies.

Would you like to define your dependencies (require) interactively [yes]? n
Would you like to define your dev dependencies (require-dev) interactively [yes]? n
Add PSR-4 autoload mapping? Maps namespace "Juan\Blade" to the entered relative path. [src/, n to skip]:
```

* Cambiar el **composer.json** que generó
```json
{
    "name": "juan/blade",
    "description": "descripcion",
    "type": "project",
    "license": "GPL",
    "autoload": {
        "psr-4": {
            "Juan\\Blade\\": "src/"
        }
    },
    "authors": [
        {
            "name": "Juan Eugenio Antón Area",
            "email": "jgntra@gmail.com"
        }
    ],
    "require": {}
}
```

POR

```json
{
    "name": "juan/blade",
    "description": "descripcion",
    "type": "project",
    "license": "GPL",
    "config": {
        "optimize-autoloader": true
    },
    "autoload": {
        "psr-4": {
            "Clases\\": "src/"
        }
    },
    "authors": [
        {
            "name": "Juan Eugenio Antón Area",
            "email": "jgntra@gmail.com"
        }
    ],
    "require": {}
}
```
* Con **composer require** instalar las dependencias que hagan falta en este caso si hicimos el **composer init** 
```bash
#Para instalar la dependecia que pasa de la clase Principal a un wsdl
composer require php2wsdl/php2wsdl
```
```bash
#Para instalar la dependecia que de un wsdl a unas clases para manejar el codigo
composer require wsdl2phpgenerator/wsdl2phpgenerator
```

---
* Cuando instales la dependencia del wsdl2phpgenerator **COMENTA**
 las líneas **156-158** del fichero
**vendor\wsdl2phpgenerator\lib\PhpClass.php**
 y realizarlo cada vez que hagas un composer update

 * Crea la estructura de carpetas del proyecto

* Importa la estructura de base de datos y los datos

 * En src tendrás una clase por cada tabla de la base de datos aunque puedes simplificarlo todo en una clase

* Tendrás una clase ``Conexion.php`` que heredan el resto de clases que vayas a usar y **CAMBIAR los parametros de la conexión si fuera necesrio**

* Una clase ``Operaciones.php`` donde tendrás la funcionalidad del servicio web, el conjunto de **métodos disponible** **recuerda que los comentarios en esta clase deben seguir una estructura específica** para poder generar el wsdl

* Dentro de la clase ``Operaciones.php`` en cada método creas objetos de otras clases y llamas a us métodos para recoger datos.

* En la carpeta servidorSoap tendras el ``servidor.php``

* Generar el wsdl con ``generarWsdl.php`` **solo una vez**

* Generar las clases con ``generarClases.php`` **solo una vez**

* En caso de que quieras volver a generarlos eliminar el wsdl y las clases generadas

* Comprobar los clientes
