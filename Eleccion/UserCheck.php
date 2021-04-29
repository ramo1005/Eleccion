<?php

    class UserCheck{
        public $conexcion;

        function __construct($con){
            $this->conexcion=$con;
        }
        function CheckEleccionActiva(){

            $stmt = $this->conexcion->prepare("select * from elecciones where estado='Activa'");
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;

            
        }
        function CheckCiudadanoActivo($cedula){

            $stmt = $this->conexcion->prepare("select * from ciudadanos where cedula=? and estado='Activo'");
            $stmt->bind_param("s",$cedula);

            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;

            
        }
        function CheckCiudadanoVoto($idCiudadano){

            $stmt = $this->conexcion->prepare("select *  from voto_ciudadanos where votante_id=? ");

            $stmt->bind_param("i",$idCiudadano);

            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;

            
        }
        
    }
?>