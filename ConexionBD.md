## Código para conectarse a la BD
``php
<?php
$contraseña = "ana";
$usuario = "ana";
$nombreBaseDeDatos = "Mascotas";
$rutaServidor = "192.168.1.66";
try {
    $base_de_datos = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (Exception $e) {
    echo "Ocurrió un error con la base de datos: " . $e->getMessage();
}
?>
