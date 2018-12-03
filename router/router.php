<?php
class Router
{
    private $general;
    private $controllerDirector;
    private $controllerDocente;
    private $controllerEstudiante;
    private $controllerMateria;
    private $controllerCriterio;

    public function __construct() {
        $this->general = new General();
        $this->controllerDirector = new Director();
        $this->controllerDocente = new Docente();
        $this->controllerMateria = new Materia();
        $this->controllerCriterio = new Criterio();
        /*
        $this->controllerEstudiante = new Estudiante();
        */
    }

    public function router(){
        if (isset($_POST['solicitud'])) {
            //Metodo de Iniciar Sesion
            if ($_POST['solicitud'] == 'login') {
                $user = $_POST['user'];
                $pass = $_POST['password'];

                $this->general->iniciarSesion($user, $pass);
            }

            //Metodo de Restablecer Contraseña
            elseif ($_POST['solicitud'] == 'reset') {
                $email = $_POST['correo'];

                $this->general->restablecerContraseña($email);
            }

            //Metodo de Cerrar Sesion
            elseif ($_POST['solicitud'] == 'close') {
                $this->general->cerrarSesion();
            }

            //Director
            elseif ($_POST['solicitud'] == 'homeDir'){
                $usuario = $_SESSION['director'];
                $this->controllerDirector->buscarUsuario($usuario);
            }

            elseif ($_POST['solicitud'] == 'viewProfileDir'){
                $usuario = $_SESSION['director'];
                $this->controllerDirector->buscarUsuario($usuario);
            }



            elseif ($_POST['solicitud'] == 'actProfileDir'){
                $usuario = $_SESSION['director'];
                $celular = $_POST['celular'];
                $direccion = $_POST['direccion'];
                $this->controllerDirector->actualizarPerfil($usuario, $celular, $direccion);
            }

            elseif ($_POST['solicitud'] == 'registryDocente'){
                $codigo = $_POST['codigo'];
                $dni = $_POST['dni'];
                $nombres = $_POST['nombres'];
                $correo = $_POST['correo'];

                $this->controllerDirector->registrarDocente($codigo, $dni, $nombres, $correo);
            }

            elseif ($_POST['solicitud'] == 'listDocentes'){
                $this->controllerDirector->listarDocente();
            }

            elseif ($_POST['solicitud'] == 'addSubject'){
                $nombre = $_POST['nombre'];
                $codigo = $_POST['codigo'];
                $this->controllerDirector->crearMateria($codigo, $nombre);
            }

            elseif ($_POST['solicitud'] == 'listMateria'){
                $this->controllerDirector->listarMateria();
            }

            elseif ($_POST['solicitud'] == 'addPeriod'){
                $fechaI = $_POST['fechaInicio'];
                $fechaF = $_POST['fechaFin'];
                $descripcion = $_POST['descripcion'];

                $this->controllerDirector->crearPeriodo($fechaI, $fechaF, $descripcion);
            }

            elseif ($_POST['solicitud'] == 'listPeriodo'){
                $this->controllerDirector->listarPeriodo();
            }

            elseif ($_POST['solicitud'] == 'teacherDir'){
                $codigo = $_POST['cod'];
                $a = $_POST['a'];
                $b = $_POST['b'];
                $c = $_POST['c'];
                $d = $_POST['d'];
                $e = $_POST['e'];
                $f = $_POST['f'];
                $g = $_POST['g'];
                $h = $_POST['h'];
                $this->controllerDirector->evaluacionDocente($codigo, $a, $b, $c, $d, $e, $f, $g, $h);
            }

            elseif ($_POST['solicitud'] == 'pairDir'){
                $codigo = $_POST['cod'];
                $a = $_POST['a'];
                $b = $_POST['b'];
                $c = $_POST['c'];
                $d = $_POST['d'];
                $e = $_POST['e'];
                $f = $_POST['f'];
                $g = $_POST['g'];
                $h = $_POST['h'];
                $this->controllerDirector->evaluacionPar($codigo, $a, $b, $c, $d, $e, $f, $g, $h);
            }

            elseif ($_POST['solicitud'] == 'selfDir'){
                $a = $_POST['a'];
                $b = $_POST['b'];
                $c = $_POST['c'];
                $d = $_POST['d'];
                $e = $_POST['e'];
                $f = $_POST['f'];
                $g = $_POST['g'];
                $h = $_POST['h'];
                $i = $_POST['i'];
                $j = $_POST['j'];
                $k = $_POST['k'];
                $usuario = $_SESSION['director'];
                $this->controllerDirector->autoEvaluacion($usuario, $a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k);
            }

            //Docente
            elseif ($_POST['solicitud'] == 'homeDoc'){
                $usuario = $_SESSION['docente'];
                $this->controllerDocente->buscarUsuario($usuario);
            }

            elseif ($_POST['solicitud'] == 'viewProfileDoc'){
                $usuario = $_SESSION['docente'];
                $this->controllerDocente->buscarUsuario($usuario);
            }

            elseif ($_POST['solicitud'] == 'actProfileDoc'){
                $usuario = $_SESSION['docente'];
                $celular = $_POST['celular'];
                $direccion = $_POST['direccion'];
                $this->controllerDocente->actualizarPerfil($usuario, $celular, $direccion);
            }

            elseif ($_POST['solicitud'] == 'pairDoc'){
                echo "llego";
                $codigo = $_POST['cod'];
                $a = $_POST['a'];
                $b = $_POST['b'];
                $c = $_POST['c'];
                $d = $_POST['d'];
                $e = $_POST['e'];
                $f = $_POST['f'];
                $g = $_POST['g'];
                $h = $_POST['h'];
                $this->controllerDocente->evaluacionPar($codigo, $a, $b, $c, $d, $e, $f, $g, $h);
            }

            elseif ($_POST['solicitud'] == 'selfDoc'){
                $a = $_POST['a'];
                $b = $_POST['b'];
                $c = $_POST['c'];
                $d = $_POST['d'];
                $e = $_POST['e'];
                $f = $_POST['f'];
                $g = $_POST['g'];
                $h = $_POST['h'];
                $i = $_POST['i'];
                $j = $_POST['j'];
                $k = $_POST['k'];
                $usuario = $_SESSION['docente'];
                $this->controllerDocente->autoEvaluacion($usuario, $a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k);
            }
            elseif ($_POST['solicitud'] == 'changeStateTeacher'){
                $estado = $_POST['estado'];
                $codigo = $_POST['codigo'];            

                $this->controllerDocente->habilitarDocente($estado,$codigo);
            }

            elseif ($_POST['solicitud'] == 'updateTeacherName'){
                $nombre = $_POST['nombre'];
                $codigo = $_POST['codigo'];            

                $this->controllerDocente->actualizarDatosDocente($nombre,$codigo);
            }

            elseif ($_POST['solicitud'] == 'changeStateAsignatura'){
                $estado = $_POST['estado'];
                $codigo = $_POST['codigo'];            

                $this->controllerMateria->habilitarAsignatura($estado,$codigo);
            }

            elseif ($_POST['solicitud'] == 'updateAsignatura'){
                $nombre = $_POST['nombre'];
                $codigo = $_POST['codigo'];
                $codigoNuevo = $_POST['codigoNuevo'];            

                $this->controllerMateria->actualizarDatosAsignatura($nombre,$codigo,$codigoNuevo);
            }


            elseif ($_POST['solicitud'] == 'listCriterios'){           
                $this->controllerCriterio->listarCriterios();
            }

            elseif ($_POST['solicitud'] == 'registryCriterio'){   
                
                $nombre = $_POST['criterio'];
                $codigo = $_POST['tipoEvaluacion'];  
                $this->controllerCriterio->registrarCriterio($nombre,$codigo);
            }

            elseif ($_POST['solicitud'] == 'updateCriterio'){   
                $nombre = $_POST['nombre'];
                $tipoevaluacion = $_POST['tipoevaluacion']; 
                $codigo = $_POST['codigo'];

                $this->controllerCriterio->actualizarDatosCriterio($tipoevaluacion,$codigo,$nombre);
            }

            elseif ($_POST['solicitud'] == 'changeStateCriterio'){
                $estado = $_POST['estado'];
                $codigo = $_POST['codigo'];            

                $this->controllerCriterio->habilitarCriterio($estado,$codigo);
            }

            elseif ($_POST['solicitud'] == 'consultarPreguntasDirector'){        
                $this->controllerCriterio->consultarPreguntasDirector();
            }
            elseif ($_POST['solicitud'] == 'listPreguntasDirector'){           
                $this->controllerCriterio->listarPreguntasDirector();
            }
            
            elseif ($_POST['solicitud'] == 'registryPreguntaDirector'){   
                
                $pregunta = $_POST['pregunta'];
                $criterio = $_POST['criterioOptions'];  
                $this->controllerCriterio->registrarPreguntaDirector($pregunta,$criterio);
            }

            elseif ($_POST['solicitud'] == 'changeStatePreguntaDirector'){
                $estado = $_POST['estado'];
                $codigo = $_POST['codigo'];            

                $this->controllerCriterio->habilitarPreguntaDirector($estado,$codigo);
            }


            elseif ($_POST['solicitud'] == 'updatePreguntaDirector'){   
                $nombre = $_POST['nombre'];
                $criterio = $_POST['criterio']; 
                $codigo = $_POST['codigo'];
                $this->controllerCriterio->actualizarDatosPreguntaDirector($criterio,$codigo,$nombre);
            }
            
            

            

            
            //Estudiante
            /* elseif ($_POST['solicitud'] == ''){

            }
            */

            else {
                echo '<script> alert("No encontro la solicitud")</script>';
            }
        }
    }
}
?>