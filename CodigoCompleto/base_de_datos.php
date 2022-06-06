<!--Conexión a la base de datos -->
<?php
//creamos las variables necesarias acceder a la base de datos
$contraseña = "ana";
$usuario = "ana";
$nombreBaseDeDatos = "Mascotas";
$rutaServidor = "formulariomascotas.ddns.net"; 
//Realizamos la conexión a la base de datos y comprobamos que podemos conectarnos.
try {
    $base_de_datos = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (Exception $e) {
    echo "Ocurrió un error con la base de datos: " . $e->getMessage();
}
?>