## Código para conectarse a la BD
### Este archivo se llamará base_de_datos.php
#### Le iremos haciendo referencias en los demás archivos php para comprobar la conexión.
``` php
<!--Conexión a la base de datos -->
<?php
//creamos las variables necesarias acceder a la base de datos, indicamos el usuario, contraseña, nombre de la BD y la ip (dns) de nuestro servidor
$contraseña = "ana";
$usuario = "ana";
$nombreBaseDeDatos = "Mascotas";
$rutaServidor = "formulariomascotas.ddns.net"; 
//Realizamos la conexión a la base de datos y comprobamos que podemos conectarnos, Si todo sale bien establecemos la conexión con los datos indicados y si algo fallasalta un error
try {
    $base_de_datos = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (Exception $e) {
    echo "Ocurrió un error con la base de datos: " . $e->getMessage();
}
?>
```
