# Código para editar los registros insertados
## Este archivo se llamará editar.php
```php
/*EDITAR UN REGISTRO DE NUESTRA BASE DE DATOS*/
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
include_once "base_de_datos.php";
/*Creamos la consulta pasandole el id que hemos seleccionado 
para mostrarnos en nuestro formulario de la página editar.php 
los datos de la mascota seleciona*/
$sentencia = $base_de_datos->prepare("SELECT id, nombre, edad FROM mascotas WHERE id = ?;");
$sentencia->execute([$id]);
$mascota = $sentencia->fetchObject();
//Comprobamos que existe si no, nos muestra que no existe 
if (!$mascota) {
    echo "¡No existe alguna mascota!";
    exit();
}

/*Si la mascota existe, se ejecuta esta parte del código que nos crea el formulario 
con los datos sacados de la base de datos a través del id seleccionado.*/
?>
<?php include_once "encabezado.php"?>
<div class="row">
	<div class="col-12">
		<h1>Editar</h1>
		 <!-- Nos muestra el formulario si todos los datos están correctos 
		 y llamamos a guardarDatosEditados.php 
		 que es donde realizamos el update -->
		<form action="guardarDatosEditados.php" method="POST">
			<input type="hidden" name="id" value="<?php echo $mascota->id; ?>">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input value="<?php echo $mascota->nombre; ?>" required name="nombre"
				type="text" id="nombre" placeholder="Nombre de mascota" class="form-control">
			</div>
			<div class="form-group">
				<label for="edad">Edad</label>
				<input value="<?php echo $mascota->edad; ?>" required name="edad" 
				type="number" id="edad" placeholder="Edad de mascota" class="form-control" >
			</div>
		<!-- El botón guardar llama a la función que nos comprueba si los datos que intentamos actualizar son correctos-->
			<button type="submit" class="btn btn-outline-secondary" onclick="Comprobar(event)">Guardar</button>
			<a href="./index.php" class="btn btn-outline-info">Volver</a>
		</form>
	</div>
</div>
 <!--Llamamos a pie.php que cierra todas las eqtiquetas de nuestro de html -->
<?php include_once "pie.php"?>
```
