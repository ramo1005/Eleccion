<?php

    class AdminService{
        public $conexcion;

        function __construct($con){
            $this->conexcion=$con;
        }
        function CreateAdmin(){

            $stmt = $this->conexcion->prepare("insert into admin (cedula,contraseña,created) values(?,?,CURRENT_TIMESTAMP)");
            $stmt->bind_param("ss",$_GET['user'],$_GET['password']);
            $stmt->execute();
            $stmt->close();
            
            header("Location: index.php");
        }
        function CheckAdmin($cedula,$pass){

            $stmt = $this->conexcion->prepare("select * from admin where cedula=? and contraseña=?");
            $stmt->bind_param("ss",$cedula,$pass);
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;
        }

    }

?>