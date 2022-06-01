# Código para poder insertar datos desde el formulário a nuestra BD
## Este archivo se llamará insertar.php
´´´ PHP
<?php
/*
================================
Este archivo inserta los datos 
enviados a través de formulario.php
================================
*/
?>
<?php
#Salir si alguno de los datos no está presente
if (!isset($_POST["nombre"]) || !isset($_POST["edad"])) {
    exit();
}

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$nombre = $_POST["nombre"];
$edad = $_POST["edad"];

/*
Al incluir el archivo "base_de_datos.php", todas sus variables están
a nuestra disposición. Por lo que podemos acceder a ellas tal como si hubiéramos
copiado y pegado el código
 */
$sentencia = $base_de_datos->prepare("INSERT INTO mascotas(nombre, edad) VALUES (?, ?);");
$resultado = $sentencia->execute([$nombre, $edad]); # Pasar en el mismo orden de los ?

#execute regresa un booleano. True en caso de que todo vaya bien, falso en caso contrario.
#Con eso podemos evaluar

if ($resultado === true) {
    
    $sentencia = $base_de_datos->query("select id, nombre, edad from mascotas");
    $mascotas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
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
<?php
} else {
    echo "Algo salió mal. Por favor verifica que la tabla exista";
}
?>
´´´
