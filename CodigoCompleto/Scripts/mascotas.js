//#region Mascotas

function Limpiar(){
    //Botón limpar del formulario, ponemos los campoas del formulario vacios.
    $("#inp-nombre").val("");
    $("#inp-edad").val("");
    $("select#sel-propietarios").val("-1"); //Ponemos selecionado en el campo de selected la opción que no hace nada.
    //Llamamos a la lista para que vuelva completa.
    CrearLista();
}

function Agregar() {
    //Creamos las variables que recogen los datos de nombre, edad, y la opción seleccionada de propietarios de nuestro index.php.
    let nombre = $("#inp-nombre").val().trim();
    let edad = $("#inp-edad").val().trim();
    let propietario = $("select#sel-propietarios").val().trim();

    //Comprobamos si hemos introducido un nombre
    if (!nombre || nombre.trim() === "") {
        alert("El nombre es obligatorio");
        return;
    }
    // Limitamos la edad entre 0 y 50
    try{
        //Pasamos la edad a una cadena numérica y la comprobamos
        let edadNum = parseInt(edad.trim());
        if (isNaN(edadNum) || edad < 0 || edad > 50){
            alert("La edad debe ser un número entre 0 y 50 años");
            return;
        }
    } catch {
        alert("La edad debe ser un número entre 0 y 50 años");
        return;
    }

    //Comprobamos el propietario o que no sea la opción No Aplica de lo contrario nos saltará la alerta   
    if (!propietario || propietario === "" || propietario === "-1" ) {
        alert("El Propietario es obligatorio");
        return;
    }
/*  AJAX significa JavaScript asíncrono y XML 
    (Asynchronous JavaScript and XML). 
    Es un conjunto de técnicas de desarrollo web 
    que permiten que las aplicaciones web funcionen de forma asíncrona, 
    procesando cualquier solicitud al servidor en segundo plano.*/
    $.ajax(
        {
            //Cogemos los datos almacenados en nombre,edad,propietario y se lo pasamos a insertar.php
            url:"insertar.php", 
            method: "post",
            data: { nombre: nombre, edad: edad, propietario: propietario},
           //Si todo es correcto le pasamos el resultado a insertar.php
            success:function(result) { 
            //Una vez pasados los datos se limpia el formulario poniendo los campos con valor vacio.   
                $("#inp-nombre").val("");
                $("#inp-edad").val("");
                $("select#sel-propietarios").val("-1");
            //Imprimimos el resultado de nuestro nuevo registro añadido en la tabla de index.php
                CrearLista(); 
            }
        }
    )
}

function BuscarMascota(){
    /* Creamos esta función para que cuando busquemos por edad solo podamos insertar un número entre 0 y 50*/
    let edad = $("input#inp-edad").val().trim();
    try{
        let edadNum = parseInt(edad.trim());
        /*Si no escribimos edad por defecto nos devuelve isNaN( que no es un número ) 
        entonces comprobamos que se introduzca la edad y que sea un número y que esté entre 0 y 50*/
        if ((edad != "" && isNaN(edadNum)) || (!isNaN(edadNum) && (edadNum < 0 || edadNum > 50))){
            alert("La edad debe ser un número entre 0 y 50 años");
            return false;
        }
    } catch {
        alert("La edad debe ser un número entre 0 y 50 años");
        return false;
    }

    CrearLista();
}

function CrearLista() {
    //Creamos la variable para almacenar al propietario selecionado en selectPropietarios.php
    let propietario = $("select#sel-propietarios").val();

    $.ajax(
        {
            /*Cogemos los datos insertados en el formulario y los insertamos en CrearLista.php 
            generando nuestra tabla con todos los datos*/
            url:"CrearLista.php", 
            method: "post",
            //cogemos cada dato de sus respectivos inputs del index.php y le pasamos la variable de propietario declarada arriba
            data: { nombre: $("#inp-nombre").val(), edad: $("#inp-edad").val(), propietario: propietario},
            //si todo es correcto el resultado nos devuelve la tabla y la crea en div-contenedor creado en nuestro index.php
            success:function(result) { $("#div-contenedor").html(result); }
        }
    )
}

//Creamos la función para comprobar que los datos insertados en editar.php son correctos.
function Comprobar(e){
    //Creamos las variables que guardan el nombre y edad del input de editar.php 
    //.trim() elimina los espacios en blanco tanto de un lado como del otro del valor
    let nombre = $("input#nombre").val().trim();
    let edad = $("input#edad").val().trim();
    let id_propietario = $("select#sel-propietarios").val().trim();

    //Comprobamos que se escribre un nombre
    if (!nombre || nombre.trim() === "") {

        alert("El nombre es obligatorio");
        e.preventDefault();
        return false;
    }

    /*Si la edad no es correcta se cancela el evento y 
    nos muestra el mensaje de que la edad debe ser un número entre 0 y 50 y no edita nada.*/
    try{
        let edadNum = parseInt(edad.trim());
        //comprobamos que sea un número entre 0 y 50
        if (isNaN(edadNum) || edadNum < 0 || edadNum > 50){
            alert("La edad debe ser un número entre 0 y 50 años");
            e.preventDefault();
            return false;
        }
    } catch {
        alert("La edad debe ser un número entre 0 y 50 años");
        e.preventDefault();
        return false;
    }
    //comprobamos que se introduzca un propietario
    if (!id_propietario) {
        alert("El propietario es obligatorio");
        e.preventDefault();
        return false;
    }
}

//#endregion

//#region Propietarios

function CrearListaPropietarios() {
    //Creamos la variable para almacenar a los propietarios
    let propietario = $("select#sel-propietarios").val();

    $.ajax(
        {
            /*Cogemos los datos insertados en el formulario y los insertamos en CrearLista.php 
            generando nuestra tabla con todos los datos*/
            url:"CrearListaPropietarios.php", 
            method: "post",
            data: { nombre: $("#inp-nombre-propietario").val(), dni: $("#inp-dni").val()},
            success:function(result) { $("#div-contenedor-propietarios").html(result); }
        }
    )
}

function AgregarPropietario() {

    //Creamos las variables que recogen los datos de nombre, edad, y la opción seleccionada de propietarios.
    let nombre = $("#inp-nombre-propietario").val().trim();
    let dni = $("#inp-dni").val().trim().toUpperCase();

    //Comprobamos si hemos introducido un nombre
    if (!nombre || nombre.trim() === "") {
        alert("El nombre es obligatorio");
        return;
    }

    //Comprobamos si hemos introducido un dni
    if (!dni || dni.trim() === "") {
        alert("El dni es obligatorio");
        return;
    } else {

        if (!((/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i.test(dni)) || (/^[XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i.test(dni)))) {
            alert("El dni debe contener 8 números y una letra");
            return;
        }
    }

/*  AJAX significa JavaScript asíncrono y XML 
    (Asynchronous JavaScript and XML). 
    Es un conjunto de técnicas de desarrollo web 
    que permiten que las aplicaciones web funcionen de forma asíncrona, 
    procesando cualquier solicitud al servidor en segundo plano.*/

    $.ajax(
        {
            //Cogemos los datos de insertar.php almacenados en nombre,edad,propietario
            url:"insertarPropietario.php", 
            method: "post",
            data: { nombre: nombre, dni: dni },
           //Guardamos los datos de nuestro nuevo registro en result
            success:function(result) { 
            //Una vez agregados los datos se limpia el formulario poniendo los campos con valor vacio.   
                $("#inp-nombre-propietario").val("");
                $("#inp-dni").val("");
            //Imprimimos el resultado de nuestro nuevo registro añadido en la tabla
                CrearListaPropietarios();
            }
        }
    )
}

function LimpiarPropietario() {

    //Botón limpar del formulario, ponemos los campoas del formulario vacios.

    $("#inp-nombre-propietario").val("");
    $("#inp-dni").val("");
    
    //Llamamos a la lista para que vuelva completa.
    
    CrearListaPropietarios();
}

//#endregion

