<?php

    class eleccionService{
        public $conexcion;

        function __construct($con){
            $this->conexcion=$con;
        }
        function EmpezarEleccion($nombre,$fecha,$estado){

            $stmt = $this->conexcion->prepare("insert into elecciones (nombre,fecha,estado) values(?,?,?)");
            $stmt->bind_param("sss",$nombre,$fecha,$estado);
            $stmt->execute();
            $stmt->close();
            
            header("Location: eleccion.php");
        }
        function TerminarEleccion($estado,$resultado){

            $stmt = $this->conexcion->prepare("update  elecciones set estado=?,resultado=? where estado='Activa'");
            $stmt->bind_param("ss",$estado,$resultado);
            $stmt->execute();
            $stmt->close();
            
            header("Location: eleccion.php");
        }
        function ListarElecciones(){

            $stmt = $this->conexcion->prepare("select * from elecciones");
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;

            
        }
        function BorrarEleccion($id){

            $stmt = $this->conexcion->prepare("delete from elecciones where id=?");
            $stmt->bind_param("i",$id);

            $stmt->execute();
            $stmt->close();
            
            header("Location: eleccion.php");


            
        }
        function CheckEleccionTerminada(){

            $stmt = $this->conexcion->prepare("select * from elecciones where estado='Activa'");
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;

            
        }
        function GetResultElection($table){
            $stmt = $this->conexcion->prepare("SELECT candidato_id,candidatos.cedula,candidatos.nombres,candidatos.apellidos,candidatos.partido,candidatos.puesto,COUNT(*)as 'Votos Conseguidos',(SELECT COUNT(*)'total' FROM `$table` )+(SELECT COUNT(*)'total' FROM `candidato_default` where tabla='$table') as 'Votos totales',(COUNT(*)/ ((SELECT COUNT(*)'total' FROM `$table`)+(SELECT COUNT(*)'total' FROM `candidato_default` where tabla='$table')))*100 as 'Porcentaje' FROM `$table` INNER JOIN candidatos ON $table.candidato_id=candidatos.id GROUP by candidato_id ORDER BY `Porcentaje` DESC");
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;
        }
        function GetTablesPuestos(){

            $stmt = $this->conexcion->prepare("select * from puestos");
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;

            
        }
        function GetEleccionActiva(){

            $stmt = $this->conexcion->prepare("select * from elecciones where estado='Activa'");
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result->fetch_assoc();

            
        }

        function checkCandidatosEleccion(){

            $result=array();
            $data=$this->GetTablesPuestos();

            if($data->num_rows>0){
                while($row = $data->fetch_assoc()){
                    $query="select * from candidatos where estado='Activo' and puesto='".$row['nombre']."'";
                    $data2=$this->checkDataPuesto($query);
                    if($data2->num_rows>1){
                        array_push($result,1);
                    }
                    else{
                        array_push($result,0);
                    }
                }
            }

            return json_encode($result);
        }

        function checkDataPuesto($query){
            $stmt = $this->conexcion->prepare($query);
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;
        }

        function DropDataTables(){

            $stmt = $this->conexcion->prepare("DELETE FROM candidatos");
            $stmt->execute();
            $stmt = $this->conexcion->prepare("DELETE FROM candidato_default");
            $stmt->execute();
            $stmt = $this->conexcion->prepare("DELETE FROM ciudadanos");
            $stmt->execute();
            $stmt = $this->conexcion->prepare("DELETE FROM partidos");
            $stmt->execute();
            $stmt = $this->conexcion->prepare("DELETE FROM puestos");
            $stmt->execute();
            $stmt = $this->conexcion->prepare("DELETE FROM voto_ciudadanos");
            $stmt->execute();

            $stmt->close();
            
            
        }
        function DropPuestosTable($table){

            $stmt = $this->conexcion->prepare("DROP TABLE $table");
            $stmt->execute();
            $stmt->close();
            
            
        }
        
    }

?>