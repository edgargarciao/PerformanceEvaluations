<?php
session_start();
if (!isset($_SESSION['director'])){
    echo '<script style="color: red"> alert("Iniciar sesión para acceder a esta  página")</script>';
    header('Location: ../../index.html');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Performance Evaluations - Registro de Docente</title>
    <!-- Meta -->
   <?php include 'General/css.php';?>
</head>
<body>
    <div class="navbar-lateral full-reset">
        <div class="visible-xs font-movile-menu mobile-menu-button"></div>
        <div class="full-reset container-menu-movile custom-scroll-containers">
            <div class="logo full-reset all-tittles">
                <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i>
                Performance Evaluations &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <?php include 'General/leftpanel.php';?>
        </div>
    </div>
    <div class="content-page-container full-reset custom-scroll-containers">
        <!--Formulario de close-->
        <form id="close_sesion" method="post">
            <nav class="navbar-user-top full-reset">
                <ul class="list-unstyled full-reset">
                    <input type="hidden" name="solicitud" value="close">
                    <li  class="tooltips-general exit-system-button" data-href="../../index.html" data-placement="bottom" title="Cerrar sesión">
                        <i class="zmdi zmdi-power"></i>
                    </li>
                    <li style="color:#fff; cursor:default;">
                        <span id="name">director_name</span>
                    </li>
                    <li class="mobile-menu-button visible-xs" style="float: left !important;">
                        <i class="zmdi zmdi-menu"></i>
                    </li>
                </ul>
            </nav>
        </form>
        <div class="container nav-espacio">
            <h1 class="all-tittles">Agregar docente</h1>
        </div>
        <section class="full-reset text-center" style="padding: 40px 0;">
            <div class="container-fluid"  style="margin: 0px 0;">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <img src="../../assets/imgs/addTeacher.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                        En esta sección puede agregar un docente.<br>
                        Rellene los campos del formulario a continuación:
                    </div>
                    <div class="container-fluid contai-espacio">
                        <div class="container-flat-form">
                            <div class="title-flat-form title-flat-red">Agregar docente</div>
                            <div class="container-fluid">
                                <!--Formulario de registry teacher-->
                                <form id="registry_docente" action="../../include.php" method="post" autocomplete="off">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                                            <div class="group-material">
                                                <input type="number" name="codigo" class="material-control tooltips-general" placeholder="Código de docente" required="" maxlength="20" data-toggle="tooltip">
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label>Código del docente</label>
                                            </div>
                                            <div class="group-material">
                                                <input type="number" name="dni" class="material-control tooltips-general" placeholder="Cedula de docente" required="" maxlength="10" data-toggle="tooltip">
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label>Cedula del docente</label>
                                            </div>
                                            <div class="group-material">
                                                <input type="text" name="nombres" class="material-control tooltips-general" placeholder="Nombres de docente" required="" maxlength="50" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" data-toggle="tooltip">
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label>Nombres del docente</label>
                                            </div>
                                            <div class="group-material">
                                                <input type="email" name="correo" class="material-control tooltips-general" placeholder="Correo institucional de docente" required="" maxlength="200" data-toggle="tooltip">
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <label>Correo del docente</label>
                                            </div>
                                            <p class="text-center">
                                                <button type="submit" class="btn btn-danger"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                                                <!-- Router -->
                                                <input type="hidden" name="solicitud" value="registryDocente">
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </section>
        </form>
 <?php include 'General/down.php';?>
    </div>
    <!-- Jquery v1.11.2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/jquery-1.11.2.min.js"><\/script>')</script>
    <!-- Jquery mCustomScrollbar v3.1.13 -->
    <script src="../../assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Bootstrap js v3.3.2 -->
    <script src="../../assets/js/Bootstrap3/bootstrap.min.js"></script>
    <!-- Sweet Alert v0.5.0-->
    <script src="../../assets/js/sweet-alert.min.js"></script>
    <!-- Modernizr v2.8.3 -->
    <script src="../../assets/js/modernizr.js"></script>
    <!-- Main -->
    <script src="../../assets/js/main.js"></script>
    <!-- Fonts js -->
    <script src="../../assets/js/director.js"></script>
</body>
</html>