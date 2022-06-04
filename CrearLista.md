# Código De la página que contiene la tabla donde se listarán todos los registros de la BD
## Este archivo se llamará CrearLista.php
```php
/* CREACIÓN DE LA TABLA DE MASCOTAS */
<?php
//Llamamos a coneixón de la base de datos 
include_once "base_de_datos.php";
//Creamos las variables donde guardaremos el nombre, la edad y el propietario
$nombre = $_POST["nombre"];
$edad = $_POST["edad"];
$propietario = $_POST["propietario"];
//Convertimos la edad em número
$edadNum = (int)$edad;
//Creamos el filtro, la consulta para cuando busquemos algún registro
$filtro = "";
//Comprobamos si se ha escrito algún nombre de mascota para buscar y si es así se le añade a la consulta
if ($nombre != "") {
    if ($filtro == "") $filtro = " WHERE ";
    $filtro .= "nombre like '%" . $nombre . "%'";
}
//Además comprobamos si se ha añadido alguna edad para buscar y si es así se la añadimos a la consulta
if (is_numeric($edad) && $edadNum >= 0 && $edadNum <= 50){

    if ($edad != "0")
    if ($filtro == "") {
        $filtro = " WHERE ";
    } else {
        $filtro .= " AND ";
    }
    $filtro .= "edad = " . $edad;     
}
//Y por último comprobamos si se ha seleccionado algún propietario para buscar y si es así se lo añadimos a la consulta.
if (is_numeric($propietario) && $propietario > 0) {

    if ($filtro == "") {
        $filtro = " WHERE ";
    } else {
        $filtro .= " AND ";
    }
    $filtro .= "id_propietario = " . $propietario;     
}

//Una vez comprobado todos los campos generamos la consulta pasandole al final nuestro filtro según las opciones elegidas en el formulario.
$sentencia = $base_de_datos->query("select id, nombre, edad, Propietario, dni from v_Mascotas" . $filtro);
$mascotas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!--Creamos nuestra tabla de mascotas recorriendo todos los datos de nuestra base de datos -->
<div class="col-md-8">
    <div class="table-responsive-sm table-striped pt-3">
        <table class="table">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Propietario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!--Bucle que recorre a nuestra base de datos para sacar los datos de las mascotas y los propietarios  -->
                <?php foreach($mascotas as $mascota){ ?>
                <tr>
                    <td><?php echo $mascota->id ?></td>
                    <!--Unión de td para visualmente nos aparezcan la mascota y su edad juntos en una misma celda de la tabla-->
                    <td><b><?php echo $mascota->nombre ?></b><br><?php echo $mascota->edad ?> año(s)</td> 
                    <!--Unión de td para visualmente nos aparezcan el propietario y su dni juntos en una misma celda de la tabla-->
                    <td><b><?php echo $mascota->Propietario?></b><br><?php echo $mascota->dni?></td>
                    <td>
                    <!--Botón de editar que nos redirige a nuestra página de editar.php-->
                        <a class="btn btn-outline-info" href="<?php echo "editar.php?id=" . $mascota->id?>">✏</a>
                    <!--Botón de eliminar que ejecuta eliminar.php pero antes nos pregunta si estamos seguro de eliminar-->
                        <a class="btn btn-outline-danger"
                            onclick="return confirm('¿Estás seguro de borrar la mascota?');"
                            href="<?php echo "eliminar.php?id=" . $mascota->id?>">🗑️</a>
                    </td>
                </tr>
                <?php }
                ?>

            </tbody>
        </table>
   /*Cuando hacemos una busqueda que no contiene ninguna mascota 
   nos aparecerá en la tabla un mensaje que dice: No se han encontrado mascotas*/
        <?php if (!$mascotas) { ?>
        <span class="ana-noencontrado">No se han encontrado mascotas</span>
        <?php   }?>
    </div>
</div>
```
