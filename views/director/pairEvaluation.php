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
    <title>Performance Evaluations - Evaluacion Par</title>
    <!-- Meta -->
   <?php include 'General/css.php';?>
</head>
<body>
    <div class="navbar-lateral full-reset">
        <div class="visible-xs font-movile-menu mobile-menu-button"></div>
        <div class="full-reset container-menu-movile custom-scroll-containers">
            <div class="logo full-reset all-tittles">
                <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i>
                Performance Evaluations
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
            <h1 class="all-tittles">Evaluación a pares</h1>
        </div>
        <section class="full-reset text-center" style="padding: 40px 0;">
            <div class="container-fluid"  style="margin: 0px 0;">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <img src="../../assets/imgs/evaluation.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                        En esta sección se debe diligenciar la evaluación a los pares disponibles del departamento.
                    </div>
                    <div class="container-fluid contai-espacio">
                        <div class="container-flat-form">
                            <div class="title-flat-form title-flat-red">Evaluación par</div>
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
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="table-responsive">
                                        <h3 class="text-center all-tittles">Descripción de criterios de notas</h3>
                                        <table class="table table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Escala de calificación</th>
                                                    <th class="text-center">Rango de calificación</th>
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
                                    <!-- Formulario de evaluacion par-->
                                    <form id="pair" action="../../include.php" method="post" autocomplete="off">
                                        <div class="table-responsive">
                                           <h3 class="text-center all-tittles">Tabla de evaluación a docentes</h3>
                                           <table class="table table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-right"></th>
                                                    <th class="text-right">Nombre docente:</th>
                                                    <th id="nameDoc" class="text-left" style="font-weight: normal">nombre docente</th>
                                                    <input type="hidden" id="codigo" name="cod" value="teacherDir">
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="text-center">Criterio a calificar</th>
                                                      <td class="text-center" >EX</td>
                                                      <td class="text-center" >S</td>
                                                      <td class="text-center" >B</td>
                                                      <td class="text-center" >A</td>
                                                      <td class="text-center" >D</td>
                                              </tr>
                                              <tr>
                                                <td class="text-center">Compromiso institucional</td>
                                                <td><input type="radio" name="a" value="5"></td>
                                                <td><input type="radio" name="a" value="4"></td>
                                                <td><input type="radio" name="a" value="3"></td>
                                                <td><input type="radio" name="a" value="2"></td>
                                                <td><input type="radio" name="a" value="1"></td>
                                              </tr>
                                              <tr>
                                                <td class="text-center">Liderazgo</td>
                                                <td><input type="radio" name="b" value="5"></td>
                                                <td><input type="radio" name="b" value="4"></td>
                                                <td><input type="radio" name="b" value="3"></td>
                                                <td><input type="radio" name="b" value="2"></td>
                                                <td><input type="radio" name="b" value="1"></td>
                                              </tr>
                                              <tr>
                                                <td class="text-center">Responsabilidad</td>
                                                <td><input type="radio" name="c" value="5"></td>
                                                <td><input type="radio" name="c" value="4"></td>
                                                <td><input type="radio" name="c" value="3"></td>
                                                <td><input type="radio" name="c" value="2"></td>
                                                <td><input type="radio" name="c" value="1"></td>
                                              </tr>
                                              <tr>
                                                <td class="text-center">Resolucion de Conflictos</td>
                                                <td><input type="radio" name="d" value="5"></td>
                                                <td><input type="radio" name="d" value="4"></td>
                                                <td><input type="radio" name="d" value="3"></td>
                                                <td><input type="radio" name="d" value="2"></td>
                                                <td><input type="radio" name="d" value="1"></td>
                                              </tr>

                                    
                                            </tbody>
                                            </table>
                                            <p class="text-center">
                                                <button type="submit" class="btn btn-danger"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                                                <!-- Router -->
                                                <input type="hidden" name="solicitud" value="pairDir">
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