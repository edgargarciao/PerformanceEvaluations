<?php
include_once 'control.php';

class General extends model{

    public function __construct(){

    }

    public function iniciarSesion($user, $pass){
        $control = new Control();
        $respuesta = $control->validarSesion($user, $pass);
        $respuesta2 = $control->validarTypeUser($user);
        $json_data = array();

        if(!is_null($respuesta)) {
            if (!is_null($respuesta2)) {
                $array = array();
                $json_data['success'] = 0;

                $array['typeUser'] = $respuesta2['typeUser'];

                if ($array['typeUser'] == 1) {
                    session_start();
                    $_SESSION['director'] = $user;
                    echo '<script> alert("Bienvenido, Director")</script>';
                    header('Location: views/director/home.php');
                    exit();
                } elseif ($array['typeUser'] == 2) {
                    session_start();
                    $_SESSION['docente'] = $user;
                    echo '<script> alert("Bienvenido, Docente")</script>';
                    header('Location: views/docente/home.php');
                    exit();
                } elseif ($array['typeUser'] == 3) {
                    session_start();
                    $_SESSION['student'] = $user;
                    echo '<script> alert("Bienvenido, Estudiante")</script>';
                    header('Location: views/student/evaluationResult.php');
                    exit();
                }
            }
            header('Location: indexError.html');
        }
        else{
            echo '<script type="text/javascript">',
            'errorSesion()',
            '</script>';
            header('Location: indexError.html');

        }
    }

    public function restablecerContraseña($email){
        $control = new Control();
        $respuesta = $control->validarRestablecimiento($email);
        $json_data = array();

        if(!is_null($respuesta)) {
            $array = array();
            $json_data['success'] = 0;

            $array['nombres'] = $respuesta['nombres'];
            $array['email'] = $respuesta['email'];

            if ($array['email'] == $email ) {
                echo '<script> alert("Datos Validos")</script>';
                $mail = new PHPMailer;
                //Establece el método para enviar el mensaje puede ser mail, senmail o (smtp -> Recomendado).
                $mail->isSMTP();
                //Establece el servidor SMTP.
                $mail->Host = 'smtp.gmail.com';
                //Establece el puerto por defecto del servidor SMTP
                $mail->Port = 587;//Puerto TCP para la conexion
                //Establece la seguridad del servidor SMTP
                $mail->SMTPSecure = 'tls';
                //Establece la autentificación SMTP
                $mail->SMTPAuth = true;
                //Establece el nombre de quien envía el mensaje
                $mail->FromName = "DeSoft - Work Meter";
                //Establece la dirección de correo de origen del Mensaje
                $mail->From = "desoft.casadesarrolladora@gmail.com";
                //Establece el nombre de usuario SMTP
                $mail->Username = "desoft.casadesarrolladora@gmail.com";
                //Establece la contraseña del servidor SMTP
                $mail->Password = "desoft.1";
                //Añade una dirección de destino del mensaje. El parámetro $name es opcional
                $mail->addAddress($email);
                //Activa la condificacion utf-8
                $mail->CharSet = "UTF-8";
                //Establece el asunto del mensaje
                $mail->Subject = "Restablecer Contraseña";
                // Establecer el formato de correo electrónico en HTML
                $mail->isHTML(true);
                //Establece la dirección de correo a la que se enviará una Confirmación de que el correo ha sido leido
                $mail->ConfirmReadingTo = "desoft.casadesarrolladora@gmail.com";
                //Establece la dirección Reply-To
                $mail->addReplyTo('no-reply@ufps.edu.co','Notificaciones');

                //Body del mensaje
                $toName= $array['nombres'] ;
                $txt_message = 'Recientemente, alguien solicitó cambiar la contraseña de tu cuenta de Performance Evaluations. 
                Si solicitaste el cambio, ingresa en el siguiente enlace para continuar con esta operación';
                $txt_messageC = 'Si no quieres cambiar tu contraseña o no solicitaste hacerlo, ignora y elimina el mensaje.';

                $message = file_get_contents( 'views/general/restore_password.html');
                $message = str_replace('{{first_name}}', $toName, $message);
                $message = str_replace('{{message}}', $txt_message, $message);
                $message = str_replace('{{messageC}}', $txt_messageC, $message);

                $mail->msgHTML($message);
                if(!$mail->send()) {
                    echo '<script style="color:red"> alert("No se pudo enviar el mensaje...")</script>';
                    echo '<p style="color:red">';
                    echo 'Error de correo: ' . $mail->ErrorInfo;
                    echo "</p>";
                    header('Location: index.html');
                } else {
                    echo '<script style="color:green"> alert("Tu mensaje ha sido enviado!")</script>';
                    header('Location: index.html');
                }
            }
        }
    }

    public function cerrarSesion(){
        // Inicializar la sesión.
        // Si está usando session_name("algo"), ¡no lo olvide ahora!
        session_start();

        // Destruir todas las variables de sesión.
        $_SESSION = array();

        // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
        // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión.
        session_destroy();
        echo ' <script style="color:red"> alert("¡¡¡Sesión Cerrada!!!")</script>';
        header('Location: index.html');
    }
}
?>
