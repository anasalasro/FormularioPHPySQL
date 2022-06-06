# Código para el desplegable de los propietarios en la pestaña de mascotas para la opción de agregar y buscar
```php
<!--Consulta para mostrar los propietarios -->
<?php

$filtrar = false;
if (isset($_POST["Filtrar"]) && $_POST["Filtrar"] = true) $filtrar = true;

//Llamamos a nuestra conexion de la BD
include_once "base_de_datos.php";
//Creamos la consulta para mostras los propietarios
$sentencia = $base_de_datos->query("select id, nombre, dni from propietario");
$propietarios = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!--Creamos el formulario desplegable que recorre nuestra base de datos buscando los propietarios registrados y los muestra en el desplegable.  -->
<select class="form-control" id="sel-propietarios">
    <!--Creamos la primera opción del desplegable para que sea por defecto una opción que no haga nada para que al buscar no nos de fallos  -->
    <?php if ($filtrar = true) echo('<option value="-1" selected="selected">No Aplica</option>'); ?>
    <!--Bucle que recorre todo los propietarios y los va añadiendo en la variable propietario con cada uno de sus datos -->
    <?php foreach($propietarios as $propietario){ ?>
    <option value="<?php echo $propietario->id ?>"><?php echo $propietario->nombre?> (<?php echo $propietario->dni?>)</option>
    <?php } ?>
</select>
```
