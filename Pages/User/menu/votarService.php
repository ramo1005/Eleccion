<?php

class VotarService{
    public $conexcion;

    function __construct($con){
        $this->conexcion=$con;
    }
    function InsertarVoto($query){

        $stmt = $this->conexcion->prepare($query);

        $stmt->execute();

        $stmt->close();
        
    }
    function InsertarVotoNinguno($query){

        $stmt = $this->conexcion->prepare($query);

        $stmt->execute();

        $stmt->close();
        
    }
    function InsertarVotoTerminado($query){

        $stmt = $this->conexcion->prepare($query);

        $stmt->execute();

        $stmt->close();
        
    }
    function ListarCandidatos($puesto){

        $stmt = $this->conexcion->prepare("select * from candidatos where puesto=?");
        $stmt->bind_param("s",$puesto);

        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        
        return $result;

        
    }
    function IdVotante($cedula){
        $stmt = $this->conexcion->prepare("select id from ciudadanos where cedula=?");
        $stmt->bind_param("s",$cedula);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();

        return $result->fetch_assoc();

    }
    function InfoCandidatosResult($id){

        $stmt = $this->conexcion->prepare("select * from candidatos where id=?");
        $stmt->bind_param("i",$id);

        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        
        return $result->fetch_assoc();

        
    }
    function InfoCiudadanoEmail($cedula){

        $stmt = $this->conexcion->prepare("select correo from ciudadanos where cedula=?");
        $stmt->bind_param("s",$cedula);

        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        
        return $result->fetch_assoc();

        
    }

}
?>