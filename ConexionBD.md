## Código para conectarse a la BD
``` php
<?php
$contraseña = "contraseña";
$usuario = "usuario";
$nombreBaseDeDatos = "NombreBD";
$rutaServidor = "localhost";
try {
    $base_de_datos = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (Exception $e) {
    echo "Ocurrió un error con la base de datos: " . $e->getMessage();
}
?>
```
