<!-- 
* Copyright 2016 Carlos Eduardo Alfaro Orellana
-->
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="assets/icons/book.ico" />
    <script src="js/sweet-alert.min.js"></script>
    <link rel="stylesheet" href="css/sweet-alert.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <div class="navbar-lateral full-reset">
        <div class="visible-xs font-movile-menu mobile-menu-button"></div>
        <div class="full-reset container-menu-movile custom-scroll-containers">
            <div class="logo full-reset all-tittles">
                <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i> 
                Menu
            </div>
            <div class="full-reset" style="background-color:#2B3D51; padding: 10px 0; color:#fff;">
                <figure>
                    <img src="assets/img/logo.png" alt="Evaluacion" class="img-responsive center-box" style="width:55%;">
                </figure>
                <p class="text-center" style="padding-top: 15px;"></p>
            </div>
            <div class="full-reset nav-lateral-list-menu">
                <ul class="list-unstyled">
                    <li><a href="home.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp; Inicio </a></li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp; Perfil <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="editProfile.php"><i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Editar Perfil</a>
                                <li><a href="viewProfile.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>&nbsp;&nbsp; Ver Perfil</a></li>
                            </ul>
                        </li>
                        <li>
                            <div class="dropdown-menu-button"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp; Departamentos <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                            <ul class="list-unstyled">
                                <li><a href="createDepartament.php"><i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Agregar departamento</a></li>
                                <li><a href="viewDepartament.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>&nbsp;&nbsp; Listar departamento</a></li>
                            </ul>
                        </li>
                        <li>
                            <div class="dropdown-menu-button"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>&nbsp;&nbsp; Asignaturas <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                            <ul class="list-unstyled">
                                <li><a href="#"><i class="zmdi zmdi-book zmdi-hc-fw"></i>&nbsp;&nbsp; Agregar asignatura</a></li>
                                <li><a href="#"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Mostrar asignaturas</a></li>
                            </ul>
                        </li>
                        <li>
                            <div class="dropdown-menu-button"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp; Evaluaciones &nbsp;&nbsp;<i class="zmdi zmdi-pin"></i><i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                            <ul class="list-unstyled">
                                <li><a href="#"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>&nbsp;&nbsp; Editar evaluacion</a></li>
                                <li><a href="teacherEvaluation.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>&nbsp;&nbsp; Realizar evaluación a pares &nbsp;&nbsp;<i class="zmdi zmdi-pin"></i></a></li>
                                <li><a href="selfEvaluation.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>&nbsp;&nbsp; Realizar auto-evaluación </a></li>
                                <li><a href="evaluation.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>&nbsp;&nbsp; Evaluacion</a></li>
                                <li><a href="#"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>&nbsp;&nbsp; Ver evaluación de docentes </a></li>
                            </ul>
                        </li>
                        <li>
                            <div class="dropdown-menu-button"><i class="zmdi zmdi-alarm zmdi-hc-fw"></i>&nbsp;&nbsp; Docentes <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                            <ul class="list-unstyled">
                                <li><a href="#"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i>&nbsp;&nbsp; Registrar docente</a></li>
                                <li><a href="#"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i>&nbsp;&nbsp; Ver listado de docentes</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content-page-container full-reset custom-scroll-containers">
            <nav class="navbar-user-top full-reset"> <!-- Quieto -->
                <ul class="list-unstyled full-reset"> <!-- Quieto -->
                    <li style="color:#fff; cursor:default;">
                        <span class="all-tittles">Admin Name</span>
                    </li>
                    <li  class="tooltips-general exit-system-button" data-href="index.html" data-placement="bottom" title="Salir del sistema">
                        <i class="zmdi zmdi-power"></i>
                    </li>
                    <li class="mobile-menu-button visible-xs" style="float: left !important;">
                        <i class="zmdi zmdi-menu"></i>
                    </li>
                </ul>
            </nav>
            <div class="container"> <!-- Quieto -->
                <div class="page-header"> <!-- Quieto -->
                  <h1 class="all-tittles"> Ver departamentos <small> Departamentos</small> </h1>
              </div>
          </div>
          <section class="full-reset text-center" style="padding: 40px 0;">
            <div class="container-fluid"  style="margin: 0px 0;">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <img src="assets/img/edit.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                        En esta sección puede visualizar la lista de departamentos agregados, a continuación: 
                    </div>
                    <br><br><br><br><br><br>
                    <div class="container-fluid">
                        <div class="container-flat-form">
                            <div class="title-flat-form title-flat-red">Departamentos
                            </div>
                            <div class="container-fluid"  style="margin: 50px 0;">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover text-center">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Departamento
                                                        </th>
                                                        <th class="text-center">Codigo
                                                        </th>
                                                        <th class="text-center">Accion
                                                        </th>
                                                        <th class="text-center">
                                                            Habilitar/deshabilitar
                                                        </th>
                                                    </tr> 
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>"Departamento 1"
                                                        </td>
                                                        <td>             
                                                         Codigo
                                                     </td>
                                                     <td>
                                                        <a href="" class="btn btn-danger">Editar</a>
                                                    </td>
                                                    <td>
                                                       <div class="btn-group btn-toggle">
                                                         <button class="btn btn-sm btn-default">ON</button>
                                                         <button class="btn btn-sm btn-danger active">OFF</button>
                                                     </div>
                                                 </td>
                                             </tr>
                                             <tr>
                                                <td>"Departamento 2"
                                                </td>
                                                <td>             
                                                    Codigo
                                                </td> 
                                                <td>
                                                    <a href="" class="btn btn-danger">Editar</a>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-toggle">
                                                     <button class="btn btn-sm btn-default">ON</button>
                                                     <button class="btn btn-sm btn-danger active">OFF</button>
                                                 </div>
                                             </td>
                                         </tr>                    
                                         <tr>
                                            <td>"Departamento 3"
                                            </td>
                                            <td>          
                                                Codigo
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-danger">Editar</a>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-toggle">
                                                 <button class="btn btn-sm btn-default">ON</button>
                                                 <button class="btn btn-sm btn-danger active">OFF</button>
                                             </div>
                                         </td>
                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
</div>
</section>

<footer class="footer full-reset">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <h4 class="all-tittles">Acerca de</h4>
                <p>
                    Programa de Ingeniería de Sistemas de la Universidad Francisco de Paula Santander
                    Acreditación de alta calidad según resolución No. 15757 del Ministerio de Educación Nacional
                    Avenida Gran Colombia No. 12E-96 Barrio Colsag, Cúcuta, Colombia
                    Teléfono (57) 7 5776655 Extensiones 201 y 203
                    Correo electrónico: ingsistemas@ufps.edu.co
                </p>
            </div>
            <div class="col-xs-12 col-sm-6">
                <h4 class="all-tittles">Desarrollado por: </h4>
                <ul class="list-unstyled">
                    <li><i class="zmdi zmdi-check zmdi-hc-fw"></i>&nbsp; Derly Zuley Angel Medina </li>
                    <li><i class="zmdi zmdi-check zmdi-hc-fw"></i>&nbsp; Lizeth Rios Epalza </li>
                    <li><i class="zmdi zmdi-check zmdi-hc-fw"></i>&nbsp; Eismar Johann Paredes Peña </li>
                    <li><i class="zmdi zmdi-check zmdi-hc-fw"></i>&nbsp; Jose David Castro </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright full-reset all-tittles">© 2018 Ingenieria de sistemas UFPS</div>
</footer>

</div>
</body>
</html>