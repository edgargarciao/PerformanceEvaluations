<?php
/*El director puede:
*/

class Director{
    //Metodo de buscar usuario
    public function buscarUsuario($usuario){
        $dao = new PersonaDao();
        echo json_encode($dao->buscar($usuario),JSON_FORCE_OBJECT);
    }

    public function buscarFoto($usuario){
        $dao = new PersonaDao();
        $dao->buscarFoto($usuario);
    }
    

    //Metodo de actualizar perfil de director
    public function actualizarPerfil($codi,$usuario, $celular, $direccion,$apellidos,$imagename,$imagetmp){
        $dao = new PersonaDao();

        $respuesta = $dao->actualizar($codi,$usuario, $celular, $direccion,$apellidos,$imagename,$imagetmp);
        if ($respuesta == 0) {
            $cod = "";
            if(isset($_SESSION['director'])){
                $cod = $_SESSION['director'];
            }
            if($cod != $codi){
                echo '<script> alert("Actualizacion Exitosa")</script>';
                $general = new General();
                $general->cerrarSesion();
                header('Location: index.html');
            }else{
                header('Location: views/director/editProfile.php');
                echo '<script> alert("Registro Exitoso")</script>';
            }

        }else{
            echo '<script> alert("Actualizacion Fallida")</script>';
        }
    }

    //Metodo de registrar docente
    public function registrarDocente($codigo, $dni, $nombres, $correo){
        $dto = new PersonaDto($dni, $nombres, 'null', 'null', 'null', $correo);
        $dao = new PersonaDao();

        $respuesta = $dao->insertar($dto);

        if ($respuesta == 0) {
            echo '<script> alert("Persona Registrada")</script>';
            $usuario = $this->crearUsuario($codigo, $dni);
           
            $docente = $this->crearDocente($codigo, $dni);


            if ($docente == 0 && $usuario == 0) {

                // Enviar el correo
                /*mail($correo, 'Performance - evaluations', "Has sido registrado en el sistema. \n\n En este link puedes llenar el resto de la informacion: https://google.com ");*/

                header('Location: views/director/teacherRegistry.php');
                echo '<script> alert("Registro Exitoso")</script>';
            } else {
                echo '<script> alert("Registro Fallido")</script>';
            }
        }else {
            echo '<script> alert("Docente no Registrado")</script>';
        }
    }

    public function crearUsuario($codigo, $dni){
        $dto = new UsuarioDto($codigo, $dni, 'Activo',2);
        $dao = new UsuarioDao();

        $respuesta = $dao->insertar($dto);
        if ($respuesta == 0) {
            echo '<script> alert("Creacion Exitosa")</script>';
        }else {
            echo '<script> alert("Creacion Fallida")</script>';
        }
    }

    public function crearDocente($codigo, $dni){
        $dto = new DocenteDto($codigo, $dni, 2, 1);
        $dao = new DocenteDao();

        $respuesta = $dao->insertar($dto);
        if ($respuesta == 0) {
            echo '<script> alert("Creacion Exitosa")</script>';
        }else {
            echo '<script> alert("Creacion Fallida")</script>';
        }
    }

    public function listarDocente(){
        $dao = new DocenteDao();
        echo json_encode($dao->listar());
    }

    public function listarDirectorDocente(){
        $dao = new DocenteDao();
        echo json_encode($dao->listarDirectorDocente());
    }

    public function listarDocentesDocente(){
        $dao = new DocenteDao();
        echo json_encode($dao->listarDocentesDocente());
    }

    public function crearMateria($codigo, $nombre){
        $dto = new MateriaDto($codigo, $nombre, 1);
        $dao = new MateriaDao();

        $respuesta = $dao->insertar($dto);
        if ($respuesta == 0) {
            header('Location: views/director/addSubject.php');
            echo '<script> alert("Creacion Exitosa")</script>';
        }else {
            echo '<script> alert("Creacion Fallida")</script>';
        }
    }

    public function listarMateria(){
        $dao = new MateriaDao();
        echo json_encode($dao->listar());
    }

    public function crearPeriodo($fechaI, $fechaF, $descripcion){

        error_log($fechaI >= $fechaF);
        if($fechaI >= $fechaF){
            error_log("ENTROOO");            
            //header('Location: views/director/periodos.php');
            //echo '<script type="text/javascript"> alert("La fecha inicial no puede ser mayor o igual que la final ")</script>';
            echo "<script>";
            echo "alert('La fecha inicial no puede ser mayor o igual que la final');";
            echo "window.location = 'views/director/periodos.php';"; // redirect with javascript, after page loads
            echo "</script>";
            
            return;                  
        }

        $dto = new PeriodoDto($fechaI, $fechaF, $descripcion);
        $dao = new PeriodoDao();

        $respuesta = $dao->insertar($dto);
        if ($respuesta == 0) {
            header('Location: views/director/periodos.php');
            echo '<script type="text/javascript"> alert("Creacion Exitosa")</script>';
        }else {
            echo '<script type="text/javascript"> alert("Creacion Fallida")</script>';
        }
    }

    public function listarPeriodo(){
        $dao = new PeriodoDao();
        echo json_encode($dao->listar());
    }

    public function evaluacionDocente($codigoDocente,$resultados,$codigoDirector,$tipoevaluacion){//}, $a, $b, $c, $d, $e, $f, $g, $h){
        
        $numItem = count($resultados);
        $valorPorcentual = 100/$numItem;
        $valorItem =$valorPorcentual/10;
        $resultado = 0;
        foreach($resultados as $item) { //foreach element in $arr
            $resultado = $resultado + ($item['valor'] * $valorItem);
        }
        $resultado = $resultado / 10;
        $daoP = new PeriodoDao();
        $buscar_periodo = $daoP->buscarActual();
        $id_periodo = $buscar_periodo['id'];

        $dtoE = new EvaluacionDto($id_periodo, $resultado, "Ninguna", $tipoevaluacion);
        $daoE = new EvaluacionDao();

        $respuesta = $daoE->insertar($dtoE);
        if ($respuesta == 0) {
            $buscar_id_evaluation = $daoE->buscarUltimo();
            $id_evaluation = $buscar_id_evaluation['id'];

            $evaluacionD = $this->crearEvaluacionDocente($codigoDocente, $id_evaluation);
            if ($evaluacionD == 0) {
                if($tipoevaluacion == 1){
                    header('Location: views/director/listTeacherEvaluation.php');
                }elseif($tipoevaluacion == 2){
                    header('Location: views/director/listPairEvaluation.php');
                }
                echo '<script> alert("Evaluacion Exitoso")</script>';
            } else {
                echo '<script> alert("Esta evaluacion ya se realizo")</script>';
            }
        }else {
            echo '<script> alert("Creacion Fallida")</script>';
        }

    }

    public function crearEvaluacionDocente($codigo_docente, $id_evaluacion){
        $dto = new EvaluacionDocenteDto($codigo_docente, $id_evaluacion);
        $dao = new EvaluacionDocenteDao();

        $respuesta = $dao->insertar($dto);
        if ($respuesta == 0) {
            echo '<script> alert("Creacion Exitosa")</script>';
        }else {
            echo '<script> alert("Creacion Fallida")</script>';
        }
        return $respuesta;
    }

    public function evaluacionPar($resultados,$tipoevaluacion){
        $numItem = count($resultados);
        $valorPorcentual = 100/$numItem;
        $valorItem =$valorPorcentual/10;
        $resultado = 0;
        foreach($resultados as $item) { //foreach element in $arr
            $resultado = $resultado + ($item['valor'] * $valorItem);
        }
        $resultado = $resultado / 10;
        $daoP = new PeriodoDao();
        $buscar_periodo = $daoP->buscarActual();
        $id_periodo = $buscar_periodo['id'];

        $dtoE = new EvaluacionDto($id_periodo, $resultado, "Ninguna", $tipoevaluacion);
        $daoE = new EvaluacionDao();

        $respuesta = $daoE->insertar($dtoE);
        if ($respuesta == 0) {
            echo '<script> alert("Evaluacion Exitoso")</script>';
        }else {
            echo '<script> alert("Creacion Fallida")</script>';
        }

    }

    public function autoEvaluacion($codigo, $a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k){
        $numItem = 11;
        $valorPorcentual = 100/$numItem;
        $valorItem =$valorPorcentual/10;
        $resultado = $a * $valorItem + $b * $valorItem + $c * $valorItem + $d * $valorItem + $e * $valorItem + $f * $valorItem + $g * $valorItem + $h * $valorItem + $i * $valorItem + $j * $valorItem + $k * $valorItem;
        $resultado = $resultado / 10;
        $daoP = new PeriodoDao();
        $buscar_periodo = $daoP->buscarActual();
        $id_periodo = $buscar_periodo['id'];

        $dtoE = new EvaluacionDto($id_periodo, $resultado, "Ninguna", 3);
        $daoE = new EvaluacionDao();

        $respuesta2 = $daoE->insertar($dtoE);
        if ($respuesta2 == 0) {
            $buscar_id_evaluation = $daoE->buscarUltimo();
            $id_evaluation = $buscar_id_evaluation['id'];

            echo '<script> alert("Creacion Exitosa")</script>';
            $evaluacionD = $this->crearEvaluacionDocente($codigo, $id_evaluation);
            if ($evaluacionD == 0) {
                header('Location: views/director/selfEvaluation.php');
                echo '<script> alert("Evaluacion Exitoso")</script>';
            } else {
                echo '<script> alert("Evaluacion Fallido")</script>';
            }
        } else {
            echo '<script> alert("Creacion Fallida")</script>';
        }
    }

    public function listarEvaluacionesDirectorProfesor($periodo){
        $dao = new DocenteDao();
        echo json_encode($dao->listarEvaluacionesDirectorProfesor($periodo));
    }

    public function listarEvaluacionesProfesorProfesor($periodo){
        $dao = new DocenteDao();
        echo json_encode($dao->listarEvaluacionesProfesorProfesor($periodo));
    }

    public function obtenerAutoevaluacionDirector($periodo){
        $dao = new DocenteDao();
        echo json_encode($dao->obtenerAutoevaluacionDirector($periodo));
    }

    public function listarAutoevaluacionesProfesores($periodo){
        $dao = new DocenteDao();
        echo json_encode($dao->listarAutoevaluacionesProfesores($periodo));
    }
    
    public function obtenerAutoevaluacionDocente($periodo){
        $dao = new DocenteDao();
        echo json_encode($dao->obtenerAutoevaluacionDocente($periodo));
    }

    public function listarEvaluacionesDocenteDocente($periodo){
        $dao = new DocenteDao();
        echo json_encode($dao->listarEvaluacionesDocenteDocente($periodo));
    }

    function actualizarPeriodo($codigo,$descripcion,$fechaI,$fechaF){
        $dao = new PeriodoDao();
        error_log($fechaI >= $fechaF);
        if($fechaI >= $fechaF ){
            error_log("AQUIIII 222222");
            echo "<script>";
            echo "alert('La fecha inicial no puede ser mayor o igual que la final');";
            echo "window.location = 'views/director/periodos.php';"; // redirect with javascript, after page loads
            echo "</script>";
            
            return;                  
        }
        if($dao->estaSolapada($fechaI) or $dao->estaSolapada($fechaF)){
            $responsew = array();
            $responsew['status'] = 'error';
            $responsew['message'] = 'Error: contacte al administrador del sistema.';
            echo json_encode($responsew);
        }else{

        

            $respuesta = $dao->actualizar($codigo,$descripcion,$fechaI,$fechaF);
            $response = array();
            if ( $respuesta == 0 ) {
                $response['status'] = 'success';
                $response['message'] = 'PPeriodo actualizado con exito.';            
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error: contacte al administrador del sistema.';
            }

            echo json_encode($response);
        }
    }

    public function pdfEvaluacionesDirectorProfesor($periodo){
        $dao = new DocenteDao();
        $dao->pdfEvaluacionesDirectorProfesor($periodo);
    }

    public function pdfEvaluacionesProfesorProfesor($periodo){
        $dao = new DocenteDao();
        $dao->pdfEvaluacionesProfesorProfesor($periodo);
    }

    public function pdfEvaluacionesAutoevaluacionesProfesores($periodo){
        $dao = new DocenteDao();
        $dao->pdfEvaluacionesAutoevaluacionesProfesores($periodo);
    }



    
}
?>