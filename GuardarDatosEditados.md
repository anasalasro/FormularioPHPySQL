# Código para guardar los datos editados
## Este archivo se llamará guardarDatosEditados.php
```php
/*UPDATE PARA LOS REGISTROS DE NUESTRA BASE DE DATOS*/
<?php

#Salir si alguno de los datos no está presente
if (
    !isset($_POST["nombre"]) ||
    !isset($_POST["edad"]) ||
    !isset($_POST["id"]) 
) {
    exit();
}

#Si todo va bien llamamos a nuestra conexión y mandamos el id, nombre y edad a nuestra base de datos
include_once "base_de_datos.php";
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$edad = $_POST["edad"];

#Creamos la consulta para hacer un update del registro
$sentencia = $base_de_datos->prepare("UPDATE mascotas SET nombre = ?, edad = ? WHERE id = ?;"); #las interrogaciones corresponden a las variables nombre, id y edad
$resultado = $sentencia->execute([$nombre, $edad, $id]); # Pasar en el mismo orden de los ?
//Si todo sale bien redirigimos la página principal para mostrar la tabla con el registro actualizado.
if ($resultado === true) {
    header("Location: index.php");
} else {
    echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID de la mascota";
}
?>
```
