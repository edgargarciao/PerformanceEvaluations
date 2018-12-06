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

            elseif ($_POST['solicitud'] == 'imagenDir'){
                $usuario = $_SESSION['director'];
                $this->controllerDirector->buscarFoto($usuario);
            }

            elseif ($_POST['solicitud'] == 'imagenDoc'){
                $usuario = $_SESSION['docente'];
                $this->controllerDirector->buscarFoto($usuario);
            }

            



            elseif ($_POST['solicitud'] == 'actProfileDir'){
                $usuario = $_SESSION['director'];
                $celular = $_POST['celular'];
                $direccion = $_POST['direccion'];
                $apellidos = $_POST['apellidos'];

                $imagename="";
                $imagetmp="";

                if($_FILES['foto']['size'] > 0){
                    error_log("ENTROOOO");
                    $imagename=$_FILES["foto"]["name"]; 
                    //Get the content of the image and then add slashes to it 
                    $imagetmp=addslashes (file_get_contents($_FILES['foto']['tmp_name']));
                    error_log("PASSSSSOOO");
                }
                $this->controllerDirector->actualizarPerfil($usuario, $celular, $direccion,$apellidos,$imagename,$imagetmp);
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
                $apellidos = $_POST['apellidos'];

                $imagename="";
                $imagetmp="";

                if($_FILES['foto']['size'] > 0){
                    error_log("ENTROOOO");
                    $imagename=$_FILES["foto"]["name"]; 
                    //Get the content of the image and then add slashes to it 
                    $imagetmp=addslashes (file_get_contents($_FILES['foto']['tmp_name']));
                    error_log("PASSSSSOOO");
                }
                
                $this->controllerDocente->actualizarPerfil($usuario, $celular, $direccion,$apellidos,$imagename,$imagetmp);
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

            elseif ($_POST['solicitud'] == 'listPreguntasDocente'){           
                $this->controllerCriterio->listarPreguntasDocente();
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
            
            elseif ($_POST['solicitud'] == 'consultarPreguntasDocente'){        
                $this->controllerCriterio->consultarPreguntasDocente();
            }

            elseif ($_POST['solicitud'] == 'listPreguntasDirectorDocente'){        
                $this->controllerCriterio->listarPreguntasDirectorDocente();
            }

            elseif ($_POST['solicitud'] == 'guardarEvaluacionDirectorDocente'){                
                $codigoDocente = $_POST['codigoDocente'];
                $resultados = ($_POST['resultados']);                 
                $codigoDirector = $_SESSION['director'];
                $this->controllerDirector->evaluacionDocente($codigoDocente,$resultados,$codigoDirector,1);
            }
            elseif ($_POST['solicitud'] == 'listarDirectorDocente'){
                $this->controllerDirector->listarDirectorDocente();
            }

            elseif ($_POST['solicitud'] == 'guardarEvaluacionDocenteDocente'){        
                
                $codigoDocente = $_POST['codigoDocente'];
                $resultados = ($_POST['resultados']);                 
                $codigoDirector = $_SESSION['director'];
                $this->controllerDirector->evaluacionDocente($codigoDocente,$resultados,$codigoDirector,2);
            }

            elseif ($_POST['solicitud'] == 'listPreguntasDocenteDocente'){        
                $this->controllerCriterio->listPreguntasDocenteDocente();
            }

            elseif ($_POST['solicitud'] == 'listarDocentesDocente'){
                $this->controllerDirector->listarDocentesDocente();
            }

            elseif($_POST['solicitud'] == 'listPreguntasAutoDirector'){
                $this->controllerCriterio->listarPreguntasAutoDirector();
            }
            elseif($_POST['solicitud'] == 'guardarAutoEvaluacionDirector'){
                $resultados = ($_POST['resultados']);                 
                $codigoDirector = $_SESSION['director'];
                $this->controllerDirector->evaluacionPar($resultados,4);
            }


            elseif($_POST['solicitud'] == 'listPreguntasAutoDocente'){
                $this->controllerCriterio->listarPreguntasAutoDocente();
            }
            elseif($_POST['solicitud'] == 'guardarAutoEvaluacionDocente'){
                $resultados = ($_POST['resultados']);                 
                $codigoDirector = $_SESSION['director'];
                $this->controllerDirector->evaluacionPar($resultados,3);
            }

            elseif($_POST['solicitud'] == 'obtenerPeriodos'){
                $this->controllerCriterio->listarPeriodos();
            }


            elseif($_POST['solicitud'] == 'evaluacionesDirectorProfesor'){

                $periodo = ($_POST['periodo']);
                $this->controllerDirector->listarEvaluacionesDirectorProfesor($periodo);
            }

            elseif($_POST['solicitud'] == 'evaluacionesDocenteDocente'){

                $periodo = ($_POST['periodo']);
                $this->controllerDirector->listarEvaluacionesDocenteDocente($periodo);
            }

            elseif($_POST['solicitud'] == 'evaluacionesProfesorProfesor'){
                $periodo = ($_POST['periodo']);
                $this->controllerDirector->listarEvaluacionesProfesorProfesor($periodo);
            }

            elseif($_POST['solicitud'] == 'autoevaluacionDirector'){   
                $periodo = ($_POST['periodo']);             
                $this->controllerDirector->obtenerAutoevaluacionDirector($periodo);
            }
            elseif($_POST['solicitud'] == 'autoevaluacionesProfesores'){
                $periodo = ($_POST['periodo']);
                $this->controllerDirector->listarAutoevaluacionesProfesores($periodo);
            }
            elseif($_POST['solicitud'] == 'autoevaluacionDocente'){   
                $periodo = ($_POST['periodo']);             
                $this->controllerDirector->obtenerAutoevaluacionDocente($periodo);
            }

            elseif($_POST['solicitud'] == 'periodolist'){   
              
                $this->controllerDirector->listarPeriodo();
            }
            elseif($_POST['solicitud'] == 'registryPeriodo'){   

                $descripcion = $_POST['descripcion'];
                $fechaI = $_POST['fechai']; 
                $fechaF = $_POST['fechaf'];
                $this->controllerDirector->crearPeriodo($fechaI,$fechaF,$descripcion);
            }

            elseif ($_POST['solicitud'] == 'updatePeriodo'){   
                $descripcion = $_POST['descripcion'];
                $fechaI = $_POST['fechai']; 
                $fechaF = $_POST['fechaf'];
                $codigo = $_POST['codigo'];
                $this->controllerDirector->actualizarPeriodo($codigo,$descripcion,$fechaI,$fechaF);
            }

            elseif ($_POST['solicitud'] == 'generate_pdf_rdd'){   
                $periodo = 1;//($_POST['periodo']);
                $this->controllerDirector->pdfEvaluacionesDirectorProfesor($periodo);
            }

            
            else {
                echo '<script> alert("No encontro la solicitud")</script>';
            }
        }
    }
}
?>