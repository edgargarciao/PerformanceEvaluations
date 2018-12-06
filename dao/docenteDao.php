<?php

class DocenteDao {
    private $model = null;
    public function __construct(){
        $this->model = new model();
    }

    public function insertar($dto){
        $query = "INSERT INTO docente (codigo, id_persona, id_tipo_docente, id_departamento) VALUES ('".$dto->getCodigo()."', '".$dto->getIdPersona()."', '".$dto->getIdDocente()."', '".$dto->getIdDepartamento()."')";
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
        $query = "SELECT docente.codigo, persona.nombres, persona.apellidos, persona.celular, persona.direccion, persona.correo, docente.id_departamento, usuario.estado 
                  FROM persona 
                  INNER JOIN docente ON persona.dni = docente.id_persona 
                  INNER JOIN usuario ON usuario.usuario = docente.codigo                   
                  ORDER BY persona.nombres";
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

    public function listarDirectorDocente(){
        $query = "SELECT docente.codigo, persona.nombres, persona.apellidos, persona.celular, persona.direccion, persona.correo, docente.id_departamento, usuario.estado 
                  FROM persona 
                  INNER JOIN docente ON persona.dni = docente.id_persona 
                  INNER JOIN usuario ON usuario.usuario = docente.codigo  
                  WHERE 
                  docente.id_tipo_docente = 2
                  AND
                  NOT EXISTS(
                      SELECT  *
                        FROM  evaluacion e
                        WHERE e.id_tipo_evaluacion = 1
                          AND EXISTS(
                              SELECT  *
                                FROM  evaluaciondocente ed
                               WHERE  ed.id_evaluacion = e.id
                                 AND  ed.codigo_docente = docente.codigo
                          )

                  )                 
                  ORDER BY persona.nombres";
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

    public function listarDocentesDocente(){
        $cod = "";
        if(isset($_SESSION['director'])){
            $cod = $_SESSION['director'];
        }elseif(isset($_SESSION['docente'])){
            $cod = $_SESSION['docente'];
        }

        $query = "SELECT docente.codigo, persona.nombres, persona.apellidos, persona.celular, persona.direccion, persona.correo, docente.id_departamento, usuario.estado 
                  FROM persona 
                  INNER JOIN docente ON persona.dni = docente.id_persona 
                  INNER JOIN usuario ON usuario.usuario = docente.codigo  
                  WHERE 
                  docente.id_tipo_docente = 2
                  AND
                docente.codigo <> $cod
                  AND
                  NOT EXISTS(
                      SELECT  *
                        FROM  evaluacion e                         
                        WHERE e.id_tipo_evaluacion = 2
                          AND EXISTS(
                              SELECT  *
                                FROM  evaluaciondocente ed
                               WHERE  ed.id_evaluacion = e.id
                                 AND  ed.codigo_docente = docente.codigo
                          )
                          AND e.profesor_desde = $cod

                  )                 
                  ORDER BY persona.nombres";
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

    public function actualizarEstado($codigo, $estado){
        $query = "UPDATE usuario SET estado = '".$estado."' WHERE usuario = '".$codigo."'";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 1;
    }

    public function actualizarDatosDocente($codigo, $nombre){
        $query = "  UPDATE persona 
                    SET nombres = '".$nombre."' 
                    WHERE persona.dni = (
                                            SELECT id_persona
                                              FROM docente
                                             WHERE codigo  = '".$codigo."'   
                                            )";

        error_log("sql -->   <".$query.">");
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        if($respuesta){
            return 0;
        }
        return 1;
    }

    public function listarEvaluacionesDirectorProfesor($periodo){

        $cod = "";
        if(isset($_SESSION['director'])){
            $cod = $_SESSION['director'];
        }elseif(isset($_SESSION['docente'])){
            $cod = $_SESSION['docente'];
        }

        $query = "  SELECT docente.codigo, persona.nombres, persona.apellidos, persona.celular, persona.direccion, persona.correo, docente.id_departamento, usuario.estado, evaluacion.resultado 
                    FROM persona, docente, usuario, evaluacion, evaluaciondocente 
                    WHERE persona.dni = docente.id_persona 
                    AND usuario.usuario = docente.codigo  
                    AND evaluacion.id = evaluaciondocente.id_evaluacion
                    AND evaluaciondocente.codigo_docente = docente.codigo
                    AND docente.id_tipo_docente = 2
                    AND evaluacion.id_tipo_evaluacion = 1
                    AND evaluacion.id_periodo = $periodo
                    AND evaluacion.profesor_desde = $cod";
                    //group by docente.codigo";
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

    public function listarEvaluacionesProfesorProfesor($periodo){

        $cod = "";
        if(isset($_SESSION['director'])){
            $cod = $_SESSION['director'];
        }elseif(isset($_SESSION['docente'])){
            $cod = $_SESSION['docente'];
        }

        $query = "   SELECT  evaluaciondocente.codigo_docente codigo,  (SUM(CAST(evaluacion.resultado AS UNSIGNED INTEGER))/ count(1)) resultado, 
        (SELECT persona.nombres
                          FROM persona 
                          INNER JOIN docente ON persona.dni = docente.id_persona 
                          INNER JOIN usuario ON usuario.usuario = docente.codigo
                          WHERE docente.codigo = evaluaciondocente.codigo_docente ) nombres,
                          (SELECT persona.apellidos
                          FROM persona 
                          INNER JOIN docente ON persona.dni = docente.id_persona 
                          INNER JOIN usuario ON usuario.usuario = docente.codigo
                          WHERE docente.codigo = evaluaciondocente.codigo_docente ) apellidos
                            FROM persona, docente, usuario, evaluacion, evaluaciondocente 
                            WHERE persona.dni = docente.id_persona 
                            AND usuario.usuario = docente.codigo  
                            AND evaluacion.id = evaluaciondocente.id_evaluacion
                            AND evaluaciondocente.codigo_docente = docente.codigo
                            AND evaluacion.id_tipo_evaluacion = 2
                            AND evaluacion.id_periodo = $periodo
                            group by evaluaciondocente.codigo_docente";
                    //group by docente.codigo";
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

    public function obtenerAutoevaluacionDirector($periodo){
        $cod = "";
        if(isset($_SESSION['director'])){
            $cod = $_SESSION['director'];
        }elseif(isset($_SESSION['docente'])){
            $cod = $_SESSION['docente'];
        }

        $query = "  SELECT  evaluacion.resultado 
                    FROM evaluacion
                    WHERE evaluacion.id_tipo_evaluacion = 4
                    AND evaluacion.id_periodo = $periodo
                    AND evaluacion.profesor_desde = $cod";
                    //group by docente.codigo";
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


    public function listarAutoevaluacionesProfesores($periodo){

        $cod = "";
        if(isset($_SESSION['director'])){
            $cod = $_SESSION['director'];
        }elseif(isset($_SESSION['docente'])){
            $cod = $_SESSION['docente'];
        }

        $query = "  SELECT docente.codigo, persona.nombres, persona.apellidos, persona.celular, persona.direccion, persona.correo, docente.id_departamento, usuario.estado, evaluacion.resultado 
                    FROM persona, docente, usuario, evaluacion 
                    WHERE persona.dni = docente.id_persona 
                    AND usuario.usuario = docente.codigo  
                    AND evaluacion.profesor_desde = docente.codigo
                    AND evaluacion.id_tipo_evaluacion = 3
                    AND evaluacion.id_periodo = $periodo";
                    //group by docente.codigo";
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

    public function obtenerAutoevaluacionDocente($periodo){
        $cod = "";
        if(isset($_SESSION['director'])){
            $cod = $_SESSION['director'];
        }elseif(isset($_SESSION['docente'])){
            $cod = $_SESSION['docente'];
        }

        $query = "  SELECT  evaluacion.resultado 
                    FROM evaluacion
                    WHERE evaluacion.id_tipo_evaluacion = 3
                    AND evaluacion.id_periodo = $periodo
                    AND evaluacion.profesor_desde = $cod";
                    //group by docente.codigo";
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


    public function listarEvaluacionesDocenteDocente($periodo){

        $cod = "";
        if(isset($_SESSION['director'])){
            $cod = $_SESSION['director'];
        }elseif(isset($_SESSION['docente'])){
            $cod = $_SESSION['docente'];
        }

        $query = "  SELECT docente.codigo, persona.nombres, persona.apellidos, persona.celular, persona.direccion, persona.correo, docente.id_departamento, usuario.estado, evaluacion.resultado 
                    FROM persona, docente, usuario, evaluacion, evaluaciondocente 
                    WHERE persona.dni = docente.id_persona 
                    AND usuario.usuario = docente.codigo  
                    AND evaluacion.id = evaluaciondocente.id_evaluacion
                    AND evaluaciondocente.codigo_docente = docente.codigo
                    AND docente.id_tipo_docente = 2
                    AND evaluacion.id_tipo_evaluacion = 2
                    AND evaluacion.id_periodo = $periodo
                    AND evaluacion.profesor_desde = $cod";
                    //group by docente.codigo";
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

    public function pdfEvaluacionesDirectorProfesor($periodo){
        error_log("LLEgo 111");
        $cod = "";
        if(isset($_SESSION['director'])){
            $cod = $_SESSION['director'];
        }elseif(isset($_SESSION['docente'])){
            $cod = $_SESSION['docente'];
        }

        $query = "  SELECT docente.codigo codigo, persona.nombres nombres , evaluacion.resultado resultado
                    FROM persona, docente, usuario, evaluacion, evaluaciondocente 
                    WHERE persona.dni = docente.id_persona 
                    AND usuario.usuario = docente.codigo  
                    AND evaluacion.id = evaluaciondocente.id_evaluacion
                    AND evaluaciondocente.codigo_docente = docente.codigo
                    AND docente.id_tipo_docente = 2
                    AND evaluacion.id_tipo_evaluacion = 1
                    AND evaluacion.id_periodo = $periodo
                    AND evaluacion.profesor_desde = $cod";
                    //group by docente.codigo";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        $array = array();
        error_log("LLEgo 22222 -->  <".$query.">");
        $pdf = new PDF();
        //header
        $pdf->AddPage();
        //foter page
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial','B',12);
       
        $pdf->Cell(40,12,"Codigo",1);
        $pdf->Cell(40,12,"nombres",1);
        $pdf->Cell(40,12,"resultado",1);
        
       
        error_log("LLEgo 3333");

        if(isset($respuesta) && $respuesta->num_rows>0){
        while($row = mysqli_fetch_array($respuesta)){

            error_log("LLEgo assasasasasasas");
                $pdf->Ln();
                    error_log("COOOODEEE --> ".$row['codigo']);
                    $pdf->Cell(40,12,$row['codigo'],1);
                    $pdf->Cell(40,12,$row['nombres'],1);
                    $pdf->Cell(40,12,$row['resultado'],1);
                
            }
        }

        error_log("LLEgo 4444");
        $pdf->Output();
    }

    public function pdfEvaluacionesProfesorProfesor($periodo){
        error_log("LLEgo 111");
        $cod = "";
        if(isset($_SESSION['director'])){
            $cod = $_SESSION['director'];
        }elseif(isset($_SESSION['docente'])){
            $cod = $_SESSION['docente'];
        }

        $query = "  SELECT docente.codigo, persona.nombres, evaluacion.resultado 
                    FROM persona, docente, usuario, evaluacion, evaluaciondocente 
                    WHERE persona.dni = docente.id_persona 
                    AND usuario.usuario = docente.codigo  
                    AND evaluacion.id = evaluaciondocente.id_evaluacion
                    AND evaluaciondocente.codigo_docente = docente.codigo
                    AND docente.id_tipo_docente = 2
                    AND evaluacion.id_tipo_evaluacion = 2
                    AND evaluacion.id_periodo = $periodo
                    AND evaluacion.profesor_desde = $cod";
                    //group by docente.codigo";
        $this->model->conexion();
        $respuesta = $this->model->query($query);
        $this->model->closeConexion();
        $array = array();
        error_log("LLEgo 22222 -->  <".$query.">");
        $pdf = new PDF();
        //header
        $pdf->AddPage();
        //foter page
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial','B',12);
       
        $pdf->Cell(40,12,"Codigo",1);
        $pdf->Cell(40,12,"nombres",1);
        $pdf->Cell(40,12,"resultado",1);
        
       
        error_log("LLEgo 3333");

        if(isset($respuesta) && $respuesta->num_rows>0){
        while($row = mysqli_fetch_array($respuesta)){

            error_log("LLEgo assasasasasasas");
                $pdf->Ln();
                    error_log("COOOODEEE --> ".$row['codigo']);
                    $pdf->Cell(40,12,$row['codigo'],1);
                    $pdf->Cell(40,12,$row['nombres'],1);
                    $pdf->Cell(40,12,$row['resultado'],1);
                
            }
        }

        error_log("LLEgo 4444");
        $pdf->Output();
    }
}
?>

