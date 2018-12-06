<?php

class PeriodoDao {
    private $model = null;
    public function __construct(){
        $this->model = new model();
    }

    public function insertar($dto){


        if($this->estaSolapada($dto->getFechaI()) and $this->estaSolapada($dto->getFechaF())){
            echo "<script>";
            echo "alert('Alguna de las fechas se solapa con un rango existente');";
            echo "window.location = 'views/director/periodos.php';"; // redirect with javascript, after page loads
            echo "</script>";
            
            return;
        }

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
        $query = "SELECT id, descripcion, fechaI, fechaF FROM periodo ORDER BY fechaI Desc";
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

    public function actualizar($codigo,$descripcion,$fechaI,$fechaF){
        $query = "  UPDATE periodo 
        SET descripcion = '".$descripcion."',
        fechaF = '".$fechaF."',
        fechaI = '".$fechaI."'
        WHERE id = '".$codigo."'";

        
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();

        if($respuesta){
            return 0;
        }
        return 1;
    }

    public function estaSolapada($date){
        $query = "SELECT id FROM periodo WHERE '$date' > fechaI AND  fechaF > '$date'" ;
                  
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();

        error_log("QUERY -->    <".$query.">");

        if(isset($respuesta) && $respuesta->num_rows>0){
            return true;
        }
        return false;
    }

}
?>