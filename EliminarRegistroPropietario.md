# Código para elimiar un registro de la tabla de los propietarios
```php
<?php
/*
Comprobamos que el id señalado de nuestra tabla existe
*/
if (!isset($_GET["id"])) {
    exit();
}
//Mandamos el id a nuestra base de datos y llamamos a nuestra conexión
$id = $_GET["id"];
include_once "base_de_datos.php";
//Creamos la consulta pasandole el id que hemos seleccionado para eliminar el registro del id seleccionado
$sentencia = $base_de_datos->prepare("DELETE FROM propietario WHERE id = ?;");
$resultado = $sentencia->execute([$id]);
//Si todo sale bien actualizamos la página para mostrar la tabla con el registro eliminado.
if ($resultado === true) {
    header("Location: index.php?vista=propietarios");
} else {
    echo "Algo salió mal";
}
```
