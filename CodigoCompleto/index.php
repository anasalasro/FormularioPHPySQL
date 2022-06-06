<!-- PÁGINA PRINCIPAL DEL FORMULARIO-->

<?php include_once "encabezado.php" ?>

<div class="row">
    <div class="col-12">
        <!-- Incluimos el encabezado de nuestra página web -->
        <?php include_once "encabezado.php" ?>
        <!-- Menú con 2 pestañas que diferencia las mascotas de los propietarios para insertar mascotas y propietarios -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <!-- Pestaña de mascotas -->
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="mascotas-tab" data-bs-toggle="tab" data-bs-target="#mascotas"
                    type="button" role="tab" aria-controls="mascotas" aria-selected="true">Mascotas</button>
            </li>
            <!-- Pestaña de propietarios -->
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="propietario-tab" data-bs-toggle="tab" data-bs-target="#propietario"
                    type="button" role="tab" aria-controls="propietario" aria-selected="false">Propietarios</button>
            </li>
        </ul>

        <!-- 
        ----    Introducimos nuestro formulario y nuestra tabla en pestaña de mascotas 
        -->

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="mascotas" role="tabpanel" aria-labelledby="mascotas-tab">
                <!-- Creamos los botones de agregar, buscar, y limpiar llamando a sus respectivas funciones creadas en mascotas.js-->
                <div class="container pt-3">
                    <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn-secondary" onclick="Agregar()">Agregar</button>
                            <button type="button" class="btn btn-secondary" onclick="BuscarMascota()">Buscar</button>
                            <button type="button" class="btn btn-secondary" onclick="Limpiar()">Limpiar</button>
                        </div>
                    </div>
                    <!-- Creamos los inputs de nuestro formulario donde escribirémos los datos de las mascotas y prpietario-->
                    <div class="input-group pt-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text" id="btnGroupAddon">Nombre</div>
                        </div>
                        <input id="inp-nombre" type="text" class="form-control" placeholder="Nombre de la mascota"
                            aria-label="Nombre de la mascota" aria-describedby="btnGroupAddon">
                        <div class="input-group-prepend">
                            <div class="input-group-text" id="btnGroupAddon">Edad</div>
                        </div>
                        <input id="inp-edad" type="text" class="form-control" placeholder="Edad de la mascota"
                            aria-label="Edad de la mascota" aria-describedby="btnGroupAddon">
                    </div>
                    <div class="input-group pt-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text" id="btnGroupAddon">Propietario</div>
                        </div>
                        <!-- Llamamos a SelectPropietarios.php que nos crea un desplegable mostrando todos los propietarios registrado en nuestra BD-->
                        <?php include_once "SelectPropietarios.php" ?>
                    </div>
                    <!--Llamamos a nuestra tabla-->
                    <div id="div-contenedor"></div>
                    <script>
                    CrearLista();
                    </script>
                    <!-- Creamos un contenedor vacío para que nuesta función de CrearLista en mascotas.js nos imprima la tabla con los resultados de las consultas-->
                </div>

            </div>

            <!-- 
        ----    Introducimos nuestro formulario y nuestra tabla en pestaña de Propietarios 
        -->

            <div class="tab-pane fade" id="propietario" role="tabpanel" aria-labelledby="propietario-tab">

                <!-- Introducimos nuestro formulario y nuestra tabla en pestaña de mascotas -->

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade active show" id="propietario" role="tabpanel"
                        aria-labelledby="propietario-tab">

                        <!-- Creamos los botones de agregar, buscar, y limpiar llamando a sus respectivas funciones creadas en mascotas.js-->

                        <div class="container pt-3">
                            <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                    <button type="button" class="btn btn-secondary"
                                        onclick="AgregarPropietario()">Agregar</button>
                                    <button type="button" class="btn btn-secondary"
                                        onclick="CrearListaPropietarios()">Buscar</button>
                                    <button type="button" class="btn btn-secondary"
                                        onclick="LimpiarPropietario()">Limpiar</button>
                                </div>
                            </div>

                            <!-- Creamos los inputs de nuestro formulario donde escribirémos los datos de los propietarios -->

                            <div class="input-group pt-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" id="btnGroupAddon">Nombre</div>
                                </div>
                                <input id="inp-nombre-propietario" type="text" class="form-control"
                                    placeholder="Nombre del Propietario" aria-label="Nombre del Propietario"
                                    aria-describedby="btnGroupAddon">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" id="btnGroupAddon">Dni</div>
                                </div>
                                <input id="inp-dni" type="text" class="form-control" placeholder="Dni del Propietario"
                                    aria-label="Dni del Propietario" aria-describedby="btnGroupAddon">
                            </div>

                            <!-- Creamos un contenedor vacío para que nuesta función de CrearLista en mascotas.js nos imprima la tabla con los resultados de las consultas-->
                            <div id="div-contenedor-propietarios"></div>

                            <!--Llamamos a nuestra tabla-->
                            <script>
                            CrearListaPropietarios();
                            </script>

                        </div>
                    </div>
                </div>
            </div>

            <script>
            // Cambia de vista (Mascotas o Propietaios según el parámetro de la URL)

            var queryString = window.location.search;
            var urlParams = new URLSearchParams(queryString);
            var vista = urlParams.get('vista');
            if (vista === "propietarios") {
                let tab = new bootstrap.Tab($("button#propietario-tab")[0]);
                tab.show();
            }
            </script>

            <?php include_once "pie.php" ?>