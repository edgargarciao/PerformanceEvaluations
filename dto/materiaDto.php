<?php
class MateriaDto{

    private $codigo;
    private $nombre;
    private $id_programa;

    public function __construct($codigo, $nombre, $id_programa) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->id_programa = $id_programa;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getIdPrograma(){
        return $this->id_programa;
    }

    public function setIdPrograma($id_programa){
        $this->id_programa = $id_programa;
    }
}
?>