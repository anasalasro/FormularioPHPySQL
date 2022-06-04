# Código para poder insertar datos desde el formulario a nuestra BD
## Este archivo se llamará insertar.php
``` php
<?php
#Salir si alguno de los datos no están presentes
if (!isset($_POST["nombre"]) || !isset($_POST["edad"])) {
    exit();
}

/*Si todo va bien llamamos a la conexión de nuestra base de datos y 
creamos las variables necesarias para crear la consulta*/
include_once "base_de_datos.php";
$nombre = $_POST["nombre"];
$edad = $_POST["edad"];
$propietario = $_POST["propietario"];

/*
Creamos el insert y le pasamos las variables en el mismo orden
 */
$sentencia = $base_de_datos->prepare("INSERT INTO mascotas(nombre, edad, id_propietario) VALUES (?, ?, ?);");
$resultado = $sentencia->execute([$nombre, $edad, $propietario]); # Pasar en el mismo orden de los ?

#execute regresa un booleano. True en caso de que todo vaya bien, falso en caso contrario.
#Con eso comprobamos

if ($resultado === true) {
        header("Location: index.php");
?>
<?php
} else {
    echo "Algo salió mal. Por favor verifica que la tabla exista";
}
?>
```
