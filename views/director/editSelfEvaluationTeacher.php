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
    <title>Performance Evaluations - administración</title>
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
            <h1 class="all-tittles">Administración de preguntas de la auto-evaluación</h1>
        </div>
        <section class="full-reset text-center">
            <div class="container-fluid"  style="margin: 0px 0;">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <img src="../../assets/imgs/progress.png" alt="view" class="img-responsive center-box" style="max-width: 110px;">
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                        En esta sección puede el director editar el contenido de las preguntas de la auto-evaluación del docente, asi como deshabilitar/habilitar algunas de estás preguntas y agregar nuevas preguntas.
                    </div>
                    <div class="container-fluid contai-espacio">
                        <div class="container-flat-form">
                            <div class="title-flat-form title-flat-red">Administrar preguntas
                            </div>
                            <div class="container-fluid"  style="margin: 50px 0;">
                                <div class="row">
                                    <form>
                                    <div class="col-xs-12">
                                        <div class="table-responsive">
                                            <div id = "administrarT" method="post">
                                                
                                                <table id="dataTables-example" class="table table-striped text-center" style="border: #8080802e 1px solid">
                                                        <thead>
                                                        <tr class="danger">                                                            
                                                            <th class="text-center">Criterio</th>
                                                            <th class="text-center">Pregunta</th>
                                                            <th class="text-center">Acción</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            
                                                            <td class="text-center" id="criterio">Compromiso institucional</td>
                                                            <td class="text-center" id="nombre">Participa en los diversos comités y equipos de trabajo que desarrollan acciones de mejora de los procesos pedagógicos.</td>
                                                                <td>
                                                                    <a href="#" class="btn btn-default" data-toggle="modal" data-target=".myModal">Editar
                                                                    </a>  
                                                                    <button class="btn btn-danger">Deshabilitar</button>
                                                                    <button class="btn btn-success">Habilitar</button>
                                                                </td>
                                                            </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target=".myModal2">Añadir nueva pregunta
                                            </a> 
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modals">
            </div>



        <form id="reset" action="../../include.php" method="post" autocomplete="off">
            <!-- Referencia del modal -->
            <div class="modal fade myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="display: block">
                            <p class="modal-tittle">AÑADIR CRITERIO</p>
                        </div>
                        <div class="modal-body">
                            <label style="text-align: justify;padding-top: 0px;" class="login-box-msg">Escriba el nuevo criterio a registrar, ingresando la información requerida</label>
                            <br><br><br>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-sm-offset-2">

                                    <div class="group-material">
                                    <input type="hidden" name="t" class="material-control tooltips-general" required="" maxlength="50" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" data-toggle="tooltip">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Escoge el criterio</label>
                                    </div>

                                    <div class="group-material">                                                                                  
                                        <select class="form-control" name="criterioOptions" id="criterioOptions">

                                        </select>                                      
                                    </div>
                                    <div class="group-material">
                                        <input type="text" name="pregunta" class="material-control tooltips-general" placeholder="Nueva pregunta" required="" data-toggle="tooltip">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Nombre de la pregunta</label>
                                    </div>
                                    <p class="text-center">
                                            <input type="hidden" name="solicitud" value="registryPreguntaDirector">
                                        <button type="submit" class="btn btn-danger"><i class="zmdi zmdi-floppy"></i>&nbsp;&nbsp;Añadir</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </section>
 <?php include 'General/down.php';?>
    </div>
    <!-- Jquery v1.11.2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
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