# Código para crear la tabla de los propietarios
```php
<!-- CREACIÓN DE LA TABLA DE PROPIETARIOS -->
<?php
//Llamamos a coneixón de la base de datos 
include_once "base_de_datos.php";
//Creamos las variables donde guardaremos el nombre, la edad y el propietario
$nombre = $_POST["nombre"];
$dni = $_POST["dni"];

//Creamos el filtro, la consulta para cuando busquemos algún registro
$filtro = "";

if ($nombre != "") {
    if ($filtro == "") $filtro = " WHERE ";
    $filtro .= "nombre like '%" . $nombre . "%'";
}

if ($dni != "") {

    if ($filtro == "") {
        $filtro = " WHERE ";
    } else {
        $filtro .= " AND ";
    }

    $filtro .= "dni like '%" . $dni . "%'";
}

//Una vez comprobado todos los campos generamos la consulta pasandole al final nuestro filtro según las opciones elegidas en el formulario.
$sentencia = $base_de_datos->query("select id, nombre, dni from propietario "  . $filtro . " order by nombre");
$propietarios = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!--Creamos nuestra tabla de propietarios recorriendo todos los datos de nuestra base de datos -->
<div class="col-md-8">
    <div class="table-responsive-sm table-striped pt-3">
        <table class="table">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dni</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!--Bucle que recorre a nuestra base de datos para sacar los datos de las propietarios y los propietarios  -->
                <?php foreach($propietarios as $propietario){ ?>
                <tr>
                    <td><?php echo $propietario->id ?></td>
                    <!--Unión de td para visualmente nos aparezcan la propietario y su edad juntos en una misma celda de la tabla-->
                    <td><b><?php echo $propietario->nombre ?></td> 
                    <!--Unión de td para visualmente nos aparezcan el propietario y su dni juntos en una misma celda de la tabla-->
                    <td><b><?php echo $propietario->dni?></td>
                    <td>
                    <!--Botón de editar que nos redirige a nuestra página de editar.php-->
                        <a class="btn btn-outline-info" href="<?php echo "editarPropietario.php?id=" . $propietario->id?>">✏</a>
                    <!--Botón de eliminar que ejecuta eliminar.php pero antes nos pregunta si estamos seguro de eliminar-->
                        <a class="btn btn-outline-danger"
                            onclick="return confirm('¿Estás seguro de borrar el propietario y TODAS sus mascotas?');"
                            href="<?php echo "eliminarPropietario.php?id=" . $propietario->id?>">🗑️</a>
                    </td>
                </tr>
                <?php }
                ?>

            </tbody>
        </table>
    <!--Cuando hacemos una busqueda que no contiene ninguna propietario nos aparecerá en la tabla un mensaje que dice: No se han encontrado propietarios-->
        <?php if (!$propietarios) { ?>
        <span class="ana-noencontrado">No se han encontrado propietarios</span>
        <?php   }?>
    </div>
</div>
```
