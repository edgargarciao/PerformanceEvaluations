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
    <title>Performance Evaluations - Editar Perfil</title>
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
            <h1 class="all-tittles">Editar perfil</h1>
        </div>
        <section class="full-reset text-center">
            <div class="container-fluid"  style="margin: 0px 0;">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../../assets/imgs/editprofile.png" alt="edit" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    En esta sección podrá editar los datos respectivos de su perfil.<br>
                    Rellene los campos del formulario a continuación:
                </div>
                <div class="container-fluid contai-espacio">
                    <div class="container-flat-form">
                        <div class="title-flat-form title-flat-red">Editar Información</div>
                        <div class="container-fluid">
                            <!--Formulario de edit profile director-->
                            <form id="edit_profile" action="../../include.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                                        <div class="group-material">
                                            <input type="text" name="codi" id="codi" class="material-control tooltips-general" required="" maxlength="10" data-toggle="tooltip">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Codigo</label>
                                        </div>
                                        <div class="group-material">
                                            <input type="number" name="celular" id="cel" class="material-control tooltips-general" placeholder="Celular" required="" maxlength="10" data-toggle="tooltip">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Celular</label>
                                        </div>
                                        <div class="group-material">
                                            <input type="text" name="direccion" id="dir" class="material-control tooltips-general" placeholder="Dirección" required="" maxlength="50" data-toggle="tooltip">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Dirección</label>
                                        </div>
                                        <div class="group-material">
                                            <input type="text" name="apellidos" id="ape" class="material-control tooltips-general" placeholder="Apellidos" required="" maxlength="50" data-toggle="tooltip">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Apellidos</label>
                                        </div>

                                        <div class="group-material">
                                            <input type="file" name="foto" onchange="previewFile()" id="foto" class="material-control tooltips-general" placeholder="Apellidos" data-toggle="tooltip">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Foto</label>
                                            
                                            <img id="imgD" src="../../assets/imgs/user2.png" alt="user" class="img-responsive center-box" style="max-width: 110px; padding-top: 100px" >
                                            
                                        </div>                 


                                        <p class="text-center">
                                            <button type="submit" class="btn btn-danger"><i class="zmdi zmdi-floppy"></i>&nbsp;&nbsp;Guardar</button>
                                            <!-- Router -->
                                            <input type="hidden" name="solicitud" value="actProfileDir">
                                        </p>
                                    </div>
                                </div>
                            </form>
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


