# Código para hacer el update en la tabla de propietarios  
## Este archivo se llamará GuardarDatosEditadosPropietarios.php
```php
<?php

#Salir si alguno de los datos no está presente
if (
    !isset($_POST["nombre"]) ||
    !isset($_POST["dni"]) ||
    !isset($_POST["id"]) 
) {
    exit();
}

#Si todo va bien llamamos a nuestra conexión y mandamos el id, nombre y dni a nuestra base de datos
include_once "base_de_datos.php";
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$dni = $_POST["dni"];

#Creamos la consulta para hacer un update del registro
try{

    $sentencia = $base_de_datos->prepare("UPDATE propietario SET nombre = ?, dni = ? WHERE id = ?;"); #las interrogaciones corresponden a las variables nombre, id y dni
    $resultado = $sentencia->execute([$nombre, $dni, $id]); # Pasar en el mismo orden de los ?
    //Si todo sale bien redirigimos la página principal para mostrar la tabla con el registro actualizado.
    if ($resultado === true) {
        header("Location: index.php?vista=propietarios");
    } else {
        echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del propietario";
    }
//si la página nos devuelve un error de sql la modificamos para que nos aparezca El DNI ya existe 
} catch (Exception $e){

    header("Location: editarPropietario.php?id=$id&error='El DNI ya exisite'");
 
}
?>
```
