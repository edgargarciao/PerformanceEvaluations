<?php
    class model{
        private $pdo;
        private $pdo2;

        public function conexion(){
            $host = '127.0.0.1';
            $user = 'root';
            $password = 'root';
            $dataBase = 'db_evaluations';

            try {
                $this->pdo = mysqli_connect($host, $user, $password, $dataBase);
                $this->pdo->query("SET CHARACTER SET utf8;");
            }

            catch (Exception $exc) {
                mysqli_error($this->pdo);
                //echo '<script> alert("Fallo De Conexion")</script>';
            }
        }

        public function query($sql){
            return mysqli_query($this->pdo, $sql);
        }

        public function closeConexion(){
            mysqli_close($this->pdo);
            //echo '<script> alert("Conexion Cerrada")</script>';
        }


        public function conexion2(){
            $host = '127.0.0.1';
            $user = 'root';
            $password = 'root';
            $dataBase = 'db_evaluations';

            try {
                $this->pdo2 = mysqli_connect($host, $user, $password, $dataBase);
            
            }

            catch (Exception $exc) {
                mysqli_error($this->pdo2);
                //echo '<script> alert("Fallo De Conexion")</script>';
            }
        }

        public function query2($sql){
            return mysqli_query($this->pdo2, $sql);
        }

        public function closeConexion2(){
            mysqli_close($this->pdo2);
            //echo '<script> alert("Conexion Cerrada")</script>';
        }
    }
?>