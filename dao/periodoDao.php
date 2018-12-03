<?php

class PeriodoDao {
    private $model = null;
    public function __construct(){
        $this->model = new model();
    }

    public function insertar($dto){
        $query = "INSERT INTO periodo (fechaI, fechaF, descripcion) VALUES ('".$dto->getFechaI()."', '".$dto->getFechaF()."', '".$dto->getDescripcion()."')";
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
        $query = "SELECT descripcion, fechaI, fechaF FROM periodo ORDER BY descripcion";
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

    public function buscarActual(){
        $query = "SELECT id FROM periodo WHERE CURDATE() BETWEEN fechaI AND fechaF" ;
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();

        if(isset($respuesta) && $respuesta->num_rows>0){
            $period = array();

            $row = mysqli_fetch_array($respuesta);

            $period['id'] = $row['id'];

            return $period;
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