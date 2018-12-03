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

}
?>