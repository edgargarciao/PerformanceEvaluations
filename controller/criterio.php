<?php
/*El director puede:
*/

class Criterio{
    //Metodo de buscar usuario

    public function registrarCriterio($tipoEvaluacion,$nombre){
        $dao = new CriterioDao();

        $respuesta = $dao->insertar($tipoEvaluacion,$nombre);
        if ($respuesta == 0) {
            header('Location: views/director/editEvaluations.php');                                             
            echo '<script> alert("Creacion Exitosa")</script>';
        }else {
            echo '<script> alert("Creacion Fallida")</script>';
        }
    }

    public function listarCriterios(){
        $dao = new CriterioDao();
        echo json_encode($dao->listar());
    }


    public function listarPreguntasDirector(){
        $dao = new CriterioDao();
        echo json_encode($dao->listarPreguntasDirector());
    }    

    public function consultarPreguntasDirector(){
        $dao = new CriterioDao();
        echo json_encode($dao->consultarPreguntasDirector());
    }
    
    public function habilitarCriterio($estado,$codigo){
        $dao = new CriterioDao();
        $respuesta = $dao->actualizarEstado($codigo, $estado);

        $response = array();

        if ( $respuesta == 0 ) {
            $response['status'] = 'success';
            $response['message'] = 'Criterio habilitado con exito.';            
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: contacte al administrador del sistema.';
        }

        echo json_encode($response);

    }

        
    public function habilitarPreguntaDirector($estado,$codigo){
        $dao = new CriterioDao();
        $respuesta = $dao->actualizarEstadoPreguntaDirector($codigo, $estado);

        $response = array();

        if ( $respuesta == 0 ) {
            $response['status'] = 'success';
            $response['message'] = 'Criterio habilitado con exito.';            
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: contacte al administrador del sistema.';
        }

        echo json_encode($response);

    }

    public function actualizarDatosCriterio($tipoCriterio,$codigo,$nombre){
        $dao = new CriterioDao();
        $respuesta = $dao->actualizarDatosCriterio($codigo, $nombre, $tipoCriterio);

        $response = array();

        if ( $respuesta == 0 ) {
            $response['status'] = 'success';
            $response['message'] = 'Docente actualizado con exito.';            
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: contacte al administrador del sistema.';
        }

        echo json_encode($response);

    }

    public function registrarPreguntaDirector($pregunta,$criterio){
        $dao = new CriterioDao();

        $respuesta = $dao->insertarPreguntaDirector($pregunta,$criterio);
        if ($respuesta == 0) {
                                             
            header('Location: views/director/editSelfEvaluation.php');                                             
            echo '<script> alert("Creacion Exitosa")</script>';
        }else {
            echo '<script> alert("Creacion Fallida")</script>';
        }
    }
    

    public function actualizarDatosPreguntaDirector($criterio,$codigo,$nombre){
        $dao = new CriterioDao();
        $respuesta = $dao->actualizarDatosPreguntaDirector($criterio,$codigo,$nombre);

        $response = array();

        if ( $respuesta == 0 ) {
            $response['status'] = 'success';
            $response['message'] = 'Pregunta de director actualizada con exito.';            
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: contacte al administrador del sistema.';
        }

        echo json_encode($response);

    }
    
}
?>