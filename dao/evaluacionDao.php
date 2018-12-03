<?php

class EvaluacionDao {
    private $model = null;
    public function __construct(){
        $this->model = new model();
    }

    public function insertar($dto){
        $query = "INSERT INTO evaluacion (id_periodo, resultado, descripcion, id_tipo_evaluacion) VALUES ('".$dto->getIdPeriodo()."', '".$dto->getResultado()."', '".$dto->getDescripcion()."', '".$dto->getIdTipoEvaluacion()."')";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 1;
    }


    public function actualizar($usuario, $password, $newPassword){
        $query = "UPDATE usuario SET contraseña = '".$newPassword."' WHERE usuario = '".$usuario."' AND contraseña = '".$password."'";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 1;
    }

    public function eliminar($usuario){
        $query = "DELETE FROM usuario WHERE usuario = '".$usuario."'";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 1;
    }

    public function listar(){
        $query = "SELECT persona.nombres, persona.apellidos, docente.codigo, docente.id_departamento FROM persona INNER JOIN docente ON persona.dni = docente.id_persona ORDER BY persona.nombres";
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

    public function listarTipo($tipo){
        $query = "SELECT * FROM usuario ORDER BY usuario ASC WHERE tipo = $tipo" ;
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

    public function buscarUltimo(){
        $query = "SELECT MAX(evaluacion.id) AS id FROM evaluacion";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        $json_data = array();

        if(isset($respuesta) && $respuesta->num_rows>0){
            $evaluation = array();

            $row = mysqli_fetch_array($respuesta);

            $evaluation['id'] = $row['id'];

            return $evaluation;
        }
        return null;
    }

    public function buscar($usuario){
        $query = "SELECT * FROM usuario WHERE usuario = '".$usuario."'";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        $json_data = array();

        if(isset($respuesta) && $respuesta->num_rows>0){
            $json_data['success'] = 0;

            $row = mysqli_fetch_array($respuesta);
            $user = array();
            $user['usuario'] = $row['usuario'];
            $user['contraseña'] = $row['password'];
            $user['tipo'] = $row['tipo'];
            $json_data['usuario'] = $user;
        }else{
            $json_data['success'] = 1;
        }

        return $json_data;
    }

}
?>