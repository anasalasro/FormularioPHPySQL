<!--INSERTAR REGISTROS EN NUESTRA BD-->
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

try{

    /*
    Creamos el insert y le pasamos las variables en el mismo orden
    */
    $sentencia = $base_de_datos->prepare("INSERT INTO mascotas(nombre, edad, id_propietario) VALUES (?, ?, ?);");
    $resultado = $sentencia->execute([$nombre, $edad, $propietario]); # Pasar en el mismo orden de los ?

    #execute regresa un booleano. True en caso de que todo vaya bien, falso en caso contrario.
    #Con eso comprobamos

    if ($resultado === false) {
        echo "Algo salió mal. Por favor verifica que la tabla exista";
}
//si la página nos devuelve un error de sql la modificamos para que nos aparezca 
//que el propietario ya tiene una mascota con ese nombre
} catch (Exception $e) {

    $sentencia = $base_de_datos->prepare("SELECT id, nombre, dni FROM propietario WHERE id = ?;");
    $sentencia->execute([$propietario]);
    $propietarioBD = $sentencia->fetchObject();

    echo "<div style='padding: 20px 0 20px 0; font-weight: bold;'>El propietario " . $propietarioBD->nombre ." ya tiene una mascota con ese nombre: ". $nombre ."</div>";
}
?>
