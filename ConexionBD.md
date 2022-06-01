## Código para conectarse a la BD
### Este archivo se llamará base_de_datos.php
#### Le iremos haciendo referencias en los demás archivos php para comprobar la conexión.
``` php
<?php
/*
================================
Le indicamos el usuario, contraseña, 
nombre de la BD y 
la ip de nuestro servidor
================================
*/
$contraseña = "contraseña";
$usuario = "usuario";
$nombreBaseDeDatos = "NombreBD";
$rutaServidor = "localhost";
try {
/*
================================
Si todo sale bien establecemos 
la conexión con los 
datos indicados y si algo falla
salta un error
================================
*/
    $base_de_datos = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (Exception $e) {
    echo "Ocurrió un error con la base de datos: " . $e->getMessage();
}
?>
```
