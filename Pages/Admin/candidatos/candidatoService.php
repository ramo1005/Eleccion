<?php

    class CandidatoService{
        public $conexcion;

        function __construct($con){
            $this->conexcion=$con;
        }
        function CreateCandidato($item){

            $stmt = $this->conexcion->prepare("insert into candidatos (cedula,nombres,apellidos,estado,partido,puesto,foto) values(?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssss",$item->cedula,$item->nombres,$item->apellidos,$item->estado,$item->partido,$item->puesto,$item->foto);
            $stmt->execute();
            $stmt->close();
            
            header("Location: candidato.php");
        }
        function ReleaseCandidato($item){
            print_r($item);

            $stmt = $this->conexcion->prepare("update  candidatos set cedula=?,nombres=?,apellidos=?,estado=?,partido=?,puesto=?,foto=? where id=?");
            $stmt->bind_param("sssssssi",$item->cedula,$item->nombres,$item->apellidos,$item->estado,$item->partido,$item->puesto,$item->foto,$item->id);
            $stmt->execute();
            $stmt->close();
            
            header("Location: candidato.php");
        }
        function ListarCandidato(){

            $stmt = $this->conexcion->prepare("select * from candidatos");
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;

            
        }
        function DeleteCandidato($id){

            $stmt = $this->conexcion->prepare("delete from candidatos where id=?");
            $stmt->bind_param("i",$id);

            $stmt->execute();
            $stmt->close();
        
            
        }
        function InfoCandidato($id){

            $stmt = $this->conexcion->prepare("select * from candidatos where id=?");
            $stmt->bind_param("i",$id);
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;

            
        }
        function photoId(){
            $stmt = $this->conexcion->prepare("select * from candidatos");
            $stmt->execute();
            $stmt->store_result();
            $totalRows = $stmt->num_rows;

            $GLOBALS['totalCandidatos'] = $totalRows;

            if($totalRows==0){
                return 1;
            }
            else{
                return $totalRows;
            }
            $stmt->close();

        }


    }

?>