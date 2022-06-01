# Código De la página principal donde se listarám los registros añadidos en la BD
## Este archivo se llamará listar.php
```php
<?php
/*
================================
Este archivo lista todos los
datos de la tabla, obteniendo a
los mismos como un arreglo
================================
*/
?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("select id, nombre, edad from mascotas");
$mascotas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!--Recordemos que podemos intercambiar HTML y PHP como queramos-->
<?php include_once "encabezado.php" ?>
<div class="row">
<!-- Aquí pon las col-x necesarias, comienza tu contenido, etcétera -->
	<div class="col-12">
    <?php
/*
================================
Este archivo muestra un formulario que
se envía a insertar.php, el cual guardará
los datos
================================
*/
?>
<?php include_once "encabezado.php" ?>

<div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group mr-2" role="group" aria-label="First group">
    <button type="button" class="btn btn-secondary" onclick="Agregar()">Agregar</button>
    <button type="button" class="btn btn-secondary">Buscar</button>
  </div>
  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text" id="btnGroupAddon">Nombre</div>
    </div>
    <input id="inp-nombre" type="text" class="form-control" placeholder="Nombre de la mascota" aria-label="Nombre de la mascota" aria-describedby="btnGroupAddon">
  </div>
  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text" id="btnGroupAddon">Edad</div>
    </div>
    <input id="inp-edad" type="text" class="form-control" placeholder="Edad de la mascota" aria-label="Edad de la mascota" aria-describedby="btnGroupAddon">
  </div>
</div>

<?php include_once "pie.php" ?>
<div id="div-contenedor">
	<div class="col-12">		
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Edad</th>
					</tr>
				</thead>
				<tbody>
					<!--
					Atención aquí, sólo esto cambiará
					Pd: no ignores las llaves de inicio y cierre {}
					-->
					<?php foreach($mascotas as $mascota){ ?>
						<tr>
							<td><?php echo $mascota->id ?></td>
							<td><?php echo $mascota->nombre ?></td>
							<td><?php echo $mascota->edad ?></td>
							<td><a class="btn btn-warning" href="<?php echo "editar.php?id=" . $mascota->id?>">Editar 📝</a></td>
							<td><a class="btn btn-danger" href="<?php echo "eliminar.php?id=" . $mascota->id?>">Eliminar 🗑️</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include_once "pie.php" ?>
```
