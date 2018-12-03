<?php
    include_once 'controller/director.php';
    include_once 'controller/docente.php';
    include_once 'controller/estudiante.php';
    include_once 'controller/materia.php';
    include_once 'controller/criterio.php';

    include_once 'dao/docenteDao.php';
    include_once 'dao/evaluacionDao.php';
    include_once 'dao/evaluacionDocenteDao.php';
    include_once 'dao/materiaDao.php';
    include_once 'dao/periodoDao.php';
    include_once 'dao/personaDao.php';
    include_once 'dao/usuarioDao.php';
    include_once 'dao/criterioDao.php';

    include_once 'dto/docenteDto.php';
    include_once 'dto/evaluacionDto.php';
    include_once 'dto/evaluacionDocenteDto.php';
    include_once 'dto/materiaDto.php';
    include_once 'dto/periodoDto.php';
    include_once 'dto/personaDto.php';
    include_once 'dto/usuarioDto.php';

    include_once 'model/model.php';

    require 'PHPMailer/PHPMailerAutoload.php';

    require_once 'router/router.php';

    include_once 'sesion/control.php';
    include_once 'sesion/general.php';

    session_start();

    $router = new Router();
    $router->router();
?>