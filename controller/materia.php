<?php
/*El director puede:
*/

class Materia{
    //Metodo de buscar usuario
    
    public function habilitarAsignatura($estado,$codigo){
        $dao = new MateriaDao();
        $respuesta = $dao->actualizarEstado($codigo, $estado);

        $response = array();

        if ( $respuesta == 0 ) {
            $response['status'] = 'success';
            $response['message'] = 'Docente habilitado con exito.';            
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: contacte al administrador del sistema.';
        }

        echo json_encode($response);

    }

    public function actualizarDatosAsignatura($nombre,$codigo,$codigoNuevo){
        $dao = new MateriaDao();
        $respuesta = $dao->actualizarDatosAsignatura($codigo, $nombre, $codigoNuevo);

        $response = array();

        if ( $respuesta == 0 ) {
            $response['status'] = 'success';
            $response['message'] = 'Docente actualizado con exito.';            
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: contacte al administrador del sistema.';
        }

        echo json_encode($response);

    }
}
?>