<?php

    class CiudadanoService{
        public $conexcion;

        function __construct($con){
            $this->conexcion=$con;
        }
        function CreateCiudadano($item){

            $stmt = $this->conexcion->prepare("insert into ciudadanos (cedula,nombres,apellidos,estado,fecha_nacimiento,lugar_nacimiento,sexo,estado_civil,foto,correo) values(?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssssssss",$item->cedula,$item->nombres,$item->apellidos,$item->estado,$item->fecha_nacimiento,$item->lugar_nacimiento,$item->sexo,$item->estado_civil,$item->foto,$item->correo);
            $stmt->execute();
            $stmt->close();
            
            header("Location: ciudadano.php");
        }
        function ReleaseCiudadano($item){

            $stmt = $this->conexcion->prepare("update  ciudadanos set cedula=?,nombres=?,apellidos=?,estado=?,fecha_nacimiento=?,lugar_nacimiento=?,sexo=?,estado_civil=?,foto=?,correo=? where id=?");
            $stmt->bind_param("ssssssssssi",$item->cedula,$item->nombres,$item->apellidos,$item->estado,$item->fecha_nacimiento,$item->lugar_nacimiento,$item->sexo,$item->estado_civil,$item->foto,$item->correo,$item->id);
            $stmt->execute();
            $stmt->close();
            
            header("Location: ciudadano.php");
        }
        function ListarCiudadano(){

            $stmt = $this->conexcion->prepare("select * from ciudadanos");
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;

            
        }
        function DeleteCiudadano($id){

            $stmt = $this->conexcion->prepare("delete from ciudadanos where id=?");
            $stmt->bind_param("i",$id);

            $stmt->execute();
            $stmt->close();
        
            
        }
        function InfoCiudadano($id){

            $stmt = $this->conexcion->prepare("select * from ciudadanos where id=?");
            $stmt->bind_param("i",$id);
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;

            
        }
        function photoId(){
            $stmt = $this->conexcion->prepare("select * from ciudadanos");
            $stmt->execute();
            $stmt->store_result();
            $totalRows = $stmt->num_rows;

            $GLOBALS['totalCiudadanos'] = $totalRows;

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