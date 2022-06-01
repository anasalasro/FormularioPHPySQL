## Código para el encabezado de nuestra página del formulario

<!doctype html>
<html lang="es">
<!--
CRUD con SQL Server y PHP
================================
Este archivo define un encabezado que es
incluido y reutilizado por otros archivos
================================
Plantilla inicial de Bootstrap 4
 
-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Conexión de PHP con SQL Server usando PDO">
    <title>Formulario de mascotas</title>
    <!-- Cargar el CSS de Boostrap-->
    <link href="\Styles\bootstrap.min.css" rel="stylesheet">
    <script src="\Scripts\jquery.js"></script>
    <script src="\Scripts\bootstrap.min.js"></script>
    <!-- Cargar estilos propios -->
    <link href="\Styles\style.css" rel="stylesheet">
    <script type="text/javascript" src="\Scripts\mascotas.js"></script>
</head>

<body>
    <!-- Definición del menú -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" target="_blank" href="">Mascotas</a>
        <div class="collapse navbar-collapse" id="miNavbar">
         <!--   <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./listar.php">Listar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./formulario.php">Agregar</a>
                </li>
            </ul>-->
        </div>
    </nav>
    <!-- Termina la definición del menú -->
    <main role="main" class="container">
