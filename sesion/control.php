<?php
class Control extends model{

    public function __construct(){

    }

    public function validarSesion($user, $pass){
        $query = "  SELECT * 
                    FROM usuario 
                    WHERE usuario = '$user' 
                    AND clave = '$pass'
                    AND estado = 'Activo'";
        $this->conexion();
        $respuesta = $this->query($query);
        $this->closeConexion();

        if(isset($respuesta) && $respuesta->num_rows>0){
            $users = array();

            $row = mysqli_fetch_array($respuesta);

            $users['user'] = $row['usuario'];
            $users['pass'] = $row['clave'];

            return $users;
        }
        return null;
    }

    public function validarTypeUser($user){
        $query = "SELECT tipousuario FROM usuario WHERE usuario = $user";
        $this->conexion();
        $respuesta = $this->query($query);
        $this->closeConexion();

        if(isset($respuesta) && $respuesta->num_rows>0){
            $users = array();

            $row = mysqli_fetch_array($respuesta);

            $users['typeUser'] = $row['tipousuario'];

            return $users;
        }
        return null;
    }

    public function validarRestablecimiento($email){
        $query = "SELECT nombres, correo FROM persona WHERE correo = '$email'";

        $this->conexion();
        $respuesta = $this->query($query);
        $this->closeConexion();

        if(isset($respuesta) && $respuesta->num_rows>0){
            $users = array();

            $row = mysqli_fetch_array($respuesta);

            $users['nombres'] = $row['nombres'];
            $users['email'] = $row['correo'];

            return $users;
        }
        return null;
    }
}
?>