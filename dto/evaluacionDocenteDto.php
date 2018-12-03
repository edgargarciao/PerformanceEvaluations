<?php
class EvaluacionDocenteDto{

    private $codigo_docente;
    private $id_evaluacion;

    public function __construct($codigoDocente, $id_evaluacion) {
        $this->codigo_docente = $codigoDocente;
        $this->id_evaluacion = $id_evaluacion;
    }

    public function getCodigoDocente() {
        return $this->codigo_docente;
    }

    public function setCodigoDocente($codigo_docente) {
        $this->codigo_docente = $codigo_docente;
    }

    public function getIdEvaluacion(){
        return $this->id_evaluacion;
    }

    public function setIdEvaluacion($id_evaluacion){
        $this->id_evaluacion = $id_evaluacion;
    }
}
?>