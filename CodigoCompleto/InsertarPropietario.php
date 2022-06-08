<!--INSERTAR REGISTROS EN NUESTRA BD-->
<?php
#Salir si alguno de los datos no están presentes
if (!isset($_POST["nombre"]) || !isset($_POST["dni"])) {
    exit();
}

/*Si todo va bien llamamos a la conexión de nuestra base de datos y 
creamos las variables necesarias para crear la consulta*/
include_once "base_de_datos.php";
$nombre = $_POST["nombre"];
$dni = $_POST["dni"];

/*
Creamos el insert y le pasamos las variables en el mismo orden
 */

 try{

    $sentencia = $base_de_datos->prepare("INSERT INTO propietario (nombre, dni) VALUES (?, ?);");
    $resultado = $sentencia->execute([$nombre, $dni]); # Pasar en el mismo orden de los ?
    
    #execute regresa un booleano. True en caso de que todo vaya bien, falso en caso contrario.
    #Con eso comprobamos
    
    if ($resultado === false) {
        echo "Algo salió mal. Por favor verifica que la tabla exista";
    }
//si la página nos devuelve un error de sql la modificamos para que nos aparezca El DNI ya existe
} catch (Exception $e) {

    echo "<div style='padding: 20px 0 20px 0; font-weight: bold;'>El DNI " . $dni ." ya existe</div>";
}
?>
