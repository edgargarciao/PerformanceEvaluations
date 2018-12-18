<?php
class PersonaDao{
    private $model = null;
    public function __construct(){
        $this->model = new model();
    }

    public function insertar($dto){
        $query = "INSERT INTO persona (dni, nombres, apellidos, celular, direccion, correo) VALUES ('".$dto->getDni()."', '".$dto->getNombres()."', '".$dto->getApellidos()."', '".$dto->getCelular()."', '".$dto->getDireccion()."', '".$dto->getCorreo()."')";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();



        if($respuesta){
            return 0;
        }
        return 1;
    }

    public function actualizar($codi,$dni, $celular, $direccion,$apellidos,$imagename,$imagetmp){
        

        $query = "";

        if($imagename == ""){
            error_log("PASSSSSOOO SINNNNN");
            $query = "UPDATE persona SET celular = '".$celular."', direccion = '".$direccion."', apellidos = '".$apellidos."'       WHERE dni = (SELECT dni FROM (SELECT persona.dni FROM persona, docente WHERE docente.codigo = '".$dni."' AND persona.dni = docente.id_persona) AS alias_persona)";
        }else{
            error_log("PASSSSSOOO    CONNN");
            $query = "UPDATE persona SET celular = '".$celular."', direccion = '".$direccion."', apellidos = '".$apellidos."', nomimg = '".$imagename."' , foto = '".$imagetmp."'       WHERE dni = (SELECT dni FROM (SELECT persona.dni FROM persona, docente WHERE docente.codigo = '".$dni."' AND persona.dni = docente.id_persona) AS alias_persona)";            
        }
        error_log("sql -->   <".$query.">");
        $this->model->conexion2();
        $respuesta = $this->model->query2($query);
        $this->model->closeConexion2();


        $cod = "";
        if(isset($_SESSION['director'])){
            $cod = $_SESSION['director'];
        }elseif(isset($_SESSION['docente'])){
            $cod = $_SESSION['docente'];
        }
        if($cod != $codi){
            $val = $this->updateRol($cod,$codi);
            $val2 = $this->updateUser($cod,$codi);
            $val3 = $this->updateEvals($cod,$codi);
            $val4 = $this->updateEvalsDoc($cod,$codi);
            
            if($val == 2 OR $val2 == 2 OR $val3 == 2 OR $val4 == 2){
                return $val;
            }
        }

        if($respuesta){
            return 0;
        }
        return 1;
    }

    public function updateRol($cod, $codigo){


        $query = "  UPDATE docente 
                    SET codigo = '".$codigo."' 
                    WHERE codigo = '".$cod."'";

        error_log("sql -->   <".$query.">");
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 2;
    }

    public function updateEvals($cod,$codigo){

        $query = "  UPDATE evaluacion 
                    SET profesor_desde = '".$codigo."'
                    WHERE profesor_desde = '".$cod."'";

        error_log("sql -->   <".$query.">");
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 2;
    }

    public function updateEvalsDoc($cod,$codigo){

        $query = "  UPDATE evaluaciondocente 
                    SET codigo_docente = '".$codigo."'
                    WHERE codigo_docente = '".$cod."'";

        error_log("sql -->   <".$query.">");
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 2;
    }

    public function updateUser($cod,$codigo){

        $query = "  UPDATE usuario 
                    SET usuario = '".$codigo."'
                    WHERE usuario = '".$cod."'";

        error_log("sql -->   <".$query.">");
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 2;
    }

    public function listar(){
        $query = "SELECT * FROM persona ORDER BY nombres ASC";
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

    public function buscar($usuario){
        $query = "SELECT persona.dni, persona.nombres, persona.apellidos, persona.celular, persona.direccion, persona.correo, docente.codigo, persona.foto foto FROM persona INNER JOIN docente ON docente.codigo = '".$usuario."' AND docente.id_persona = persona.dni";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        $json_data = array();

        if(isset($respuesta) && $respuesta->num_rows>0){
            $json_data['success'] = 0;

            $row = mysqli_fetch_array($respuesta);
            $persona = array();
            $persona['dni'] = $row['dni'];
            $persona['nombres'] = $row['nombres'];
            $persona['apellidos'] = $row['apellidos'];
            $persona['celular'] = $row['celular'];
            $persona['direccion'] = $row['direccion'];
            $persona['correo'] = $row['correo'];
            $persona['codigo'] = $row['codigo'];
            $persona['foto'] = base64_encode($row['foto']);

            $json_data['persona'] = $persona;
        }else{
            $json_data['success'] = 1;
        }
        return $json_data;
    }

    public function buscarFoto($usuario){
        $query = "SELECT persona.foto foto FROM persona INNER JOIN docente ON docente.codigo = '".$usuario."' AND docente.id_persona = persona.dni";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        $json_data = array();

        if(isset($respuesta) && $respuesta->num_rows>0){
            $result = mysqli_fetch_array($respuesta);

        $user = array();
        $user["image"] = base64_encode($result["foto"]);
        $response["success"] = 1;
       $response["image_table"] = array();

        array_push($response["image_table"], $user);
        echo json_encode($response);

            /*$json_data['success'] = 0;

            $row = mysqli_fetch_array($respuesta);

            $json['Image_Urls'][]=$row;
            $json_data['foto'] = $row['foto'];
            
            header('Content-Type:image/jpeg'); 
            echo $row['foto']; */
        }else{
            $json_data['success'] = 1;
        }
        //return $json_data;
    }

    public function existencia($dni){
        $query = "SELECT * FROM persona WHERE dni = '".$dni."'";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 1;
    }

    public function cambiarEstado($usuario, $newEstado){
        $query = "UPDATE usuario SET estado = '".$newEstado."' WHERE usuario = '".$usuario."'";
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