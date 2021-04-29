<?php

    class PartidoService{
        public $conexcion;

        function __construct($con){
            $this->conexcion=$con;
        }
        function CreatePartido($nombre,$estado,$logo,$descripcion){

            $stmt = $this->conexcion->prepare("insert into partidos (nombre,estado,logo,descripcion) values(?,?,?,?)");
            $stmt->bind_param("ssss",$nombre,$estado,$logo,$descripcion);
            $stmt->execute();
            $stmt->close();
            
            header("Location: partidos.php");
        }
        function ReleasePartido($nombre,$estado,$logo,$descripcion,$id){

            $stmt = $this->conexcion->prepare("update  candidatos set estado=? where partido=?");
            $stmt->bind_param("ss",$estado,$nombre);
            $stmt->execute();

            $stmt = $this->conexcion->prepare("update  partidos set nombre=?,estado=?,logo=?,descripcion=? where id=?");
            $stmt->bind_param("ssssi",$nombre,$estado,$logo,$descripcion,$id);
            $stmt->execute();
            $stmt->close();
            
            header("Location: partidos.php");
        }
        function ListarPartido(){

            $stmt = $this->conexcion->prepare("select * from partidos");
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;

            
        }
        function DeletePartido($id,$nombre){

            $stmt = $this->conexcion->prepare("update  candidatos set estado='Inactivo' where partido=?");
            $stmt->bind_param("s",$nombre);

            $stmt->execute();

            $stmt = $this->conexcion->prepare("delete from partidos where id=?");
            $stmt->bind_param("i",$id);

            $stmt->execute();
            $stmt->close();
            

            
        }
        function photoId(){
            $stmt = $this->conexcion->prepare("select * from partidos");
            $stmt->execute();
            $stmt->store_result();
            $totalRows = $stmt->num_rows;

            $GLOBALS['totalPartidos'] = $totalRows;

            if($totalRows==0){
                return 1;
            }
            else{
                return $totalRows;
            }
            $stmt->close();

        }
        function pathFhoto($id){
            $stmt = $this->conexcion->prepare("select logo from partidos where id=?");
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $result = $stmt->get_result();

            $stmt->close();

            return $result;

        }
    }

?>