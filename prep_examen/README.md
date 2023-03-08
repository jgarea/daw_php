# Prueba examen
1. Cargar el script de la base de datos y selecciona la base de datos por defecto en el mysqlworkbench
2. Crea el archivo **conexion.php** y prueba que se conecta la base datos 
```php
<?php
$host = "localhost";
$db   = "proyecto";
$user = "gestor";
$pass = "secreto";
$dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
    $conProyecto = new PDO($dsn, $user, $pass);
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//   echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
```
`require_once()` para llamar al archivo 
Descomenta el //echo para comprobar la conexión, sustituye las variables de $db, $user, $pass por las de tu base de datos. 


3. Crea un **index.php** donde tienes un boton que va a llamar a **listar.php**

4. En **listar.php** muestra todos los datos(los id y los nombres de jugadores) en forma de tabla
## Consulta select y recorrer los datos
```php
$consulta="select * from TABLA";
$stmt    = $conProyecto->prepare($consulta)
try {
    $stmt->execute();
} catch (PDOException $ex) {
    die("Error al ...........: ".$ex->getMessage());
}
//Guarda los datos en una variable para recorrer con foreach
//$datos = $stmt->fetchAll(PDO::FETCH_OBJ);
// o con un bucle while() vas fila a fila
while($filas = $stmt->fetch(PDO::FETCH_OBJ)){
    echo "1";// Sustituir por $filas->nombre_campo_tabla
}
```

## Recorrer los datos
```php
echo <<<MARCA
    <tr>
        <td>{$filas->nombre_campo}</td>
        <td>{$filas->nombre_campo}</td>
    </tr>
MARCA;
```

## Insertar datos
```php
$insert="insert into jugadores(nombre, apellidos, dorsal, posicion, barcode) values(:n, :a, :d, :p, :b)";
$stmt    = $conProyecto->prepare($insert);
try {
    $stmt->execute([':n' => $nombre,
                    ':a' => $apellidos,
                    ':d' => $dorsal,
                    ':p' => $posicion,
                    ':b' => $barcode]);
} catch (PDOException $ex) {
    die("Error al insertar jugadores: ".$ex->getMessage());
}
```
## Seleccionar dato
```php
$insert="select * from TABLA where id=:i";
$stmt    = $conProyecto->prepare($insert);
try {
    $stmt->execute([':i' => $id]);
} catch (PDOException $ex) {
    die("Error seleccionar : ".$ex->getMessage());
}
```
## Comprobar si hay dato
```php
if ($stmt->rowCount()==0) {
    //return false; hacer algo
}
else {
    //return true; hacer otra cosa
}
```
## Recorrer el dato
```php
$fila = $stmt->fetch(PDO::FETCH_OBJ);
echo "{$fila->nombre_campo}";
```

## Modificar dato
```php
$update="UPDATE TABLA set nombre=:n,apellido=:a where id=:i";
$stmt    = $conProyecto->prepare($update);
try {
    $stmt->execute([':n' => $nombre, //$nombre es el nuevo valor 
                    ':a' => $apellido,
                    ':i' => $id]);
} catch (PDOException $ex) {
    die("Error modificar..... : ".$ex->getMessage());
}
```

## Borrar dato
```php
$delete="delete from TABLA where id=:i";
$stmt    = $conProyecto->prepare($delete);
try {
    $stmt->execute([':i' => $id]);
} catch (PDOException $ex) {
    die("Error eliminar..... : ".$ex->getMessage());
}
```

Despues de usar $conProyecto y $stmt en cada fichero cerrar la conexión.
```php
$stmt=null;
$conProyecto=null;
```

5. Añade una columna a la tabla con un botton que lleve a informacion.php donde está el dorsal del jugador al cual se le pasa la ID

6. Crea informacion.php donde muestra la posicion. y un boton volver a **listado.php**

7. Añade otra columna a la tabla con un boton modificar que va llevar a **update.php**

8. Crear **update.php** la primera vez que entra en la página mostrar un formulario con input para modificar el nombre, cuando se le da enviar al formulario mostrar un mensaje que se ha añadido con éxito.

9. Tener un contador en index.php que cada vez que se modifica un jugador aumente en 1 (sesiones).