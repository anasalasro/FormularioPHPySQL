# Código para editar los registros de los propietarios
## Este archivo se llamará editarPropietario.php
```php
/* EDITAR UN REGISTRO DE NUESTRA BASE DE DATOS */
<?php
/*
Este archivo muestra un formulario 
a partir del ID del registro seleccionado para editar
*/

//Comprobamos que el id esté selecionado
if (!isset($_GET["id"])) {
    exit();
}
//Mandamos el id a nuestra base de datos y llamamos a nuestra conexión
$id = $_GET["id"];

$error = "";
if (isset($_GET["error"])) $error = $_GET["error"];

include_once "base_de_datos.php";
//Creamos la consulta pasandole el id que hemos seleccionado 
//para mostrarnos en nuestro formulario de la página editarPropietario.php los datos del propietario seleccionado
$sentencia = $base_de_datos->prepare("SELECT id, nombre, dni FROM propietario WHERE id = ?;");
$sentencia->execute([$id]);
$propietario = $sentencia->fetchObject();

//Comprobamos que existe si no, nos muestra que no existe 
if (!$propietario) {
    echo "¡No existe ningún Propietario!";
    exit();
}

#Si el propietario existe, se ejecuta esta parte del código que nos crea el formulario con los datos sacados de la base de datos a través del id seleccionado.
?>
<?php include_once "encabezado.php"?>
<div class="row">
    <div class="col-12">
        <h1>Editar</h1>
        <!-- Nos muestra el formulario si todos los datos están correctos y llamamos a guardarDatosEditados.php que es donde realizamos el update -->
        <form action="guardarDatosEditadosPropietario.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $propietario->id; ?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input value="<?php echo $propietario->nombre; ?>" required name="nombre" type="text" id="nombre"
                    placeholder="Nombre del Propietario" class="form-control">
            </div>
            <div class="form-group">
                <label for="dni">Dni</label>
                <input value="<?php echo $propietario->dni ?>" required name="dni" type="text" id="dni"
                    placeholder="dni del Propietario" class="form-control">
            </div>
            <?php
			if ($error != "") {
				echo "<div style='padding: 20px 0 20px 0; font-weight: bold;'>" . $error . "</div>";            
			}
			?>
            <!-- El botón guardar llama a la función que nos comprueba si los datos que intentamos actualizar son correctos-->
            <button type="submit" class="btn btn-outline-secondary"
                onclick="ComprobarPropietario(event)">Guardar</button>
            <a href="./index.php?vista=propietarios" class="btn btn-outline-info">Volver</a>
        </form>
    </div>
</div>
<!--Llamamos a pie.php que cierra todas las eqtiquetas de nuestro de html -->
<?php include_once "pie.php"?>
```
