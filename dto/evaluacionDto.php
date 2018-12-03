<?php
class EvaluacionDto{
    private $id_periodo;
    private $resultado;
    private $descripcion;
    private $id_tipo_evaluacion;

    public function __construct($id_periodo, $resultado, $descripcion, $id_tipo_evaluacion) {
        $this->id_periodo = $id_periodo;
        $this->resultado = $resultado;
        $this->descripcion = $descripcion;
        $this->id_tipo_evaluacion = $id_tipo_evaluacion;
    }

    public function getIdPeriodo() {
        return $this->id_periodo;
    }

    public function setIdPeriodo($id_periodo) {
        $this->id_periodo = $id_periodo;
    }

    public function getResultado(){
        return $this->resultado;
    }

    public function setResultado($id_tipo_docente){
        $this->resultado = $id_tipo_docente;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getIdTipoEvaluacion(){
        return $this->id_tipo_evaluacion;
    }

    public function setIdTipoEvaluacion($id_tipo_departamento){
        $this->id_tipo_evaluacion = $id_tipo_departamento;
    }
}
?>