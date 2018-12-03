<?php

class CriterioDao {
    private $model = null;
    public function __construct(){
        $this->model = new model();
    }

    public function insertar($tipoEvaluacion,$nombre){
        $query = "INSERT INTO criterio (nombreCriterio, tipoEvaluacion, estado) VALUES ('".$tipoEvaluacion."', '".$nombre."','Activo')";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 1;
    }

    public function listar(){
        $query = "  SELECT  criterio.id, nombreCriterio, estado, tipoEvaluacion, tipoevaluacion.nombre
                    FROM criterio
                    INNER JOIN tipoevaluacion ON criterio.tipoEvaluacion = tipoevaluacion.id
                    ORDER BY criterio.id desc";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        $array = array();

        if(isset($respuesta) && $respuesta->num_rows>0){
            while($row = mysqli_fetch_array($respuesta)){
                array_unshift($array, $row);
            }
        }

        return ($array);
    }

    

    public function listarPreguntasDirector(){
        $query = "  SELECT  criteriopregunta.id, criteriopregunta.nombrePregunta, criteriopregunta.estado, criteriopregunta.criterio, criterio.nombreCriterio
                    FROM    criteriopregunta
                    INNER JOIN criterio ON criterio.id = criteriopregunta.criterio
                    ORDER BY criteriopregunta.id desc";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        $array = array();
        
        if(isset($respuesta) && $respuesta->num_rows>0){
            while($row = mysqli_fetch_array($respuesta)){


                array_unshift($array, $row);
            }
        }
        return ($array);
    }

    public function consultarPreguntasDirector(){
        $query = "  SELECT      criterio.id, nombreCriterio
                    FROM        criterio
                    WHERE       criterio.tipoEvaluacion = 4
                    ORDER BY    criterio.id     desc";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        $array = array();

        if(isset($respuesta) && $respuesta->num_rows>0){
            while($row = mysqli_fetch_array($respuesta)){
                array_unshift($array, $row);
            }
        }
        return ($array);
    }

    public function actualizarEstado($codigo, $estado){
        $query = "UPDATE criterio SET estado = '".$estado."' WHERE id = '".$codigo."'";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 1;
    }

    public function actualizarEstadoPreguntaDirector($codigo, $estado){
        $query = "UPDATE criteriopregunta SET estado = '".$estado."' WHERE id = '".$codigo."'";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 1;
    }

    public function actualizarDatosCriterio($codigo, $nombreCriterio, $tipoEvaluacion){
        $query = "  UPDATE criterio 
                    SET nombreCriterio = '".$nombreCriterio."',
                    tipoEvaluacion = '".$tipoEvaluacion."'
                    WHERE id = '".$codigo."'";


        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 1;
    }
    public function insertarPreguntaDirector($pregunta,$criterio){
        $query = "INSERT INTO criteriopregunta (criterio, nombrePregunta, estado) VALUES ('".$criterio."', '".$pregunta."','Activo')";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 1;
    }
    
    public function actualizarDatosPreguntaDirector($criterio,$codigo,$nombre){
        $query = "  UPDATE criteriopregunta 
        SET nombrePregunta = '".$nombre."',
        criterio = '".$criterio."'
        WHERE id = '".$codigo."'";

        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
        return 0;
        }
        return 1;
            }
}
?>