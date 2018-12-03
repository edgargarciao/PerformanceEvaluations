<?php
class PeriodoDto{

    private $id;
    private $fechaI;
    private $fechaF;
    private $descripcion;

    public function __construct($fechaI, $fechaF, $descripcion) {
        $this->fechaI = $fechaI;
        $this->fechaF = $fechaF;
        $this->descripcion = $descripcion;
    }

    public function getFechaI() {
        return $this->fechaI;
    }

    public function setFechaI($fechaI) {
        $this->fechaI = $fechaI;
    }

    public function getFechaF() {
        return $this->fechaF;
    }

    public function setFechaF($fechaF) {
        $this->fechaF = $fechaF;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
}
?>