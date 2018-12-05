<?php
session_start();
if (!isset($_SESSION['docente'])){
    echo '<script style="color: red"> alert("Iniciar sesión para acceder a esta  página")</script>';
    header('Location: ../../index.html');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Performance Evaluations - AutoEvaluacion</title>
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
                        <span id="name">docente_name</span>
                    </li>
                    <li class="mobile-menu-button visible-xs" style="float: left !important;">
                        <i class="zmdi zmdi-menu"></i>
                    </li>
                </ul>
            </nav>
        </form>
        <div class="container nav-espacio">
            <h1 class="all-tittles">Auto-evaluación</h1>
        </div>
        <section class="full-reset text-center" style="padding: 40px 0;">
            <div class="container-fluid"  style="margin: 0px 0;">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <img src="../../assets/imgs/evaluation.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                        En esta sección debe diligenciar la auto-evaluación.
                    </div>
                    <div class="container-fluid contai-espacio">
                        <div class="container-flat-form">
                            <div class="title-flat-form title-flat-red">Auto-evaluación</div>
                            <div class="container-fluid"  style="margin: 50px 0;">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="table-responsive">
                                            <div id = "info" method="post">
                                            <h3 class="text-center all-tittles">Información general</h3>
                                                <table id="dataTables-example1" class="table table-hover text-center">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center">Fecha de la evaluación</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>"dd/mm/aaaa"</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="table-responsive">
                                            <h3 class="text-center all-tittles">Descripción de criterios de notas</h3>
                                            <table class="table table-hover text-center">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Escala de calificación</th>
                                                    <th class="text-center">
                                                        Rango de calificación
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Desempeño excelente (EX)</td>
                                                    <td class="text-center">5</td>
                                                </tr>
                                                <tr>
                                                    <td>Desempeño sobresaliente (S)</td>
                                                    <td class="text-center">4</td>
                                                </tr>
                                                <tr>
                                                    <td>Desempeño bueno (B)</td>
                                                    <td class="text-center">3</td>
                                                </tr>
                                                <tr>
                                                    <td>Desempeño aceptable (A)</td>
                                                    <td class="text-center">2</td>
                                                </tr>
                                                <tr>
                                                    <td>Desempeño deficiente (D)</td>
                                                    <td class="text-center">1</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <!-- Formulario de Auto-evaluacion director-->
                                        <form id="auto_director" action="../../include.php" method="post" autocomplete="off">
                                            <div class="table-responsive">
                                                <h3 class="text-center all-tittles">Tabla de auto-evaluación</h3>
                                                <table id = "tablatt" class="table table-hover text-center" >
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Aspecto a evaluar</th>
                                                        <th class="text-center">Excelente</th>
                                                        <th class="text-center">Sobresaliente</th>
                                                        <th class="text-center">Bueno</th>
                                                        <th class="text-center">Aceptable</th>
                                                        <th class="text-center">Deficiente</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbo">
                                                    <tr class="text-center">

                                                    </tr>
                                                   

                                                
                                                    </tbody>
                                                </table>
                                                <p class="text-center">
                                                    <a class="btn btn-danger" onclick="guardarAutoEvaluacionDirector()"><i class="zmdi zmdi-floppy" onclick="guardarAutoEvaluacionDirector()"></i> &nbsp;&nbsp; Guardar</a>
                                                </p>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer full-reset" style="margin-top: 0 !important;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                        <figure>
                            <img src="../../assets/imgs/logo_ingsistemas_vertical.png" alt="IS - UFPS" class="img-responsive center-box" style="width:70%; padding-bottom: 10px">
                        </figure>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <h3 class="all-tittles">Acerca de</h3>
                        <p>Programa de Ingeniería de Sistemas de la Universidad Francisco de Paula Santander<br>
                            Acreditación de alta calidad según resolución No. 15757 del Ministerio de Educación Nacional<br>
                            Avenida Gran Colombia No. 12E-96 Barrio Colsag, Cúcuta, Colombia<br>
                            Teléfono (57) 7 5776655 Extensiones 201 y 203<br>
                            Correo electrónico: ingsistemas@ufps.edu.co<br>
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <h3 class="all-tittles">Desarrollado por: </h3>
                        <ul class="list-unstyled">
                            <li><i class="zmdi zmdi-code zmdi-hc-fw"></i>&nbsp;&nbsp;Lizeth Rios Epalza </li>
                            <li><i class="zmdi zmdi-edit zmdi-hc-fw"></i>&nbsp;&nbsp;Jose David Castro Garcia</li>
                            <li><i class="zmdi zmdi-edit zmdi-hc-fw"></i>&nbsp;&nbsp;Derly Zuley Angel Medina</li>
                            <li><i class="zmdi zmdi-code zmdi-hc-fw"></i>&nbsp;&nbsp;Eismar Johann Paredes Peña</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright full-reset">Gidis © Todos los derechos reservados</div>
        </footer>
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
    <script src="../../assets/js/docente.js"></script>
</body>
</html>