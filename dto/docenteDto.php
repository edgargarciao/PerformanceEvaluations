<?php
class DocenteDto{

    private $codigo;
    private $id_persona;
    private $id_tipo_docente;
    private $id_tipo_departamento;

    public function __construct($codigo, $id_persona, $id_tipo_docente, $id_tipo_departamento) {
        $this->codigo = $codigo;
        $this->id_persona = $id_persona;
        $this->id_tipo_docente = $id_tipo_docente;
        $this->id_tipo_departamento = $id_tipo_departamento;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getIdPersona() {
        return $this->id_persona;
    }

    public function setIdPersona($id_persona) {
        $this->id_persona = $id_persona;
    }

    public function getIdDocente(){
        return $this->id_tipo_docente;
    }

    public function setIdDocente($id_tipo_docente){
        $this->id_tipo_docente = $id_tipo_docente;
    }

    public function getIdDepartamento(){
        return $this->id_tipo_departamento;
    }

    public function setIdDepartamento($id_tipo_departamento){
        $this->id_tipo_departamento = $id_tipo_departamento;
    }
}
?>