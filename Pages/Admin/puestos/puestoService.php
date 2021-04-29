<?php

    class puestoService{
        public $conexcion;

        function __construct($con){
            $this->conexcion=$con;
        }
        function CreatePuesto($nombre){

            $stmt = $this->conexcion->prepare("insert into puestos (nombre) values(?)");
            $stmt->bind_param("s",$nombre);
            $stmt->execute();
            $stmt->close();
            
            $this->CreateTableVoto($nombre);
            header("Location: puestos.php");
        }
        function ReleasePuesto($id,$nombre){

            $this->changeNameTableVoto($id,$nombre);

            $stmt = $this->conexcion->prepare("update  puestos set nombre=? where id=?");
            $stmt->bind_param("si",$nombre,$id);
            $stmt->execute();
            $stmt->close();
            
            header("Location: puestos.php");
        }
        function ListarPuesto(){

            $stmt = $this->conexcion->prepare("select * from puestos");
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;

            
        }
        function DeletePuesto($id){

            $this->DeleteTableVoto($id);

            $stmt = $this->conexcion->prepare("delete from puestos where id=?");
            $stmt->bind_param("i",$id);

            $stmt->execute();
            $stmt->close();


            header("Location: puestos.php");


            
        }
        function CreateTableVoto($nombre){

            $stmt = $this->conexcion->prepare("CREATE table IF NOT EXISTS voto_$nombre ( id INT NOT NULL AUTO_INCREMENT , votante_id INT NOT NULL UNIQUE , candidato_id INT NOT NULL , fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
            PRIMARY KEY (id),FOREIGN KEY (votante_id) REFERENCES ciudadanos(id),FOREIGN KEY (candidato_id) REFERENCES candidatos(id)) ");
            $stmt->execute();
            $stmt->close();

            
        }
        function changeNameTableVoto($id,$nombre){

            $data = $this->ChaName($id);

            while($row = $data->fetch_assoc()){
            
                $asd=$row['nombre'];

                $stmt = $this->conexcion->prepare("rename table voto_$asd to voto_$nombre");
                $stmt->execute();
                $stmt->close();
            }
            
        }
        function DeleteTableVoto($id){

            $data = $this->ChaName($id);

            while($row = $data->fetch_assoc()){
            
                $asd=$row['nombre'];
                
                print_r($asd);
                $stmt = $this->conexcion->prepare("drop table voto_$asd ");
                $stmt->execute();
                $stmt->close();
            }
        }
        function ChaName($id){

            $stmt = $this->conexcion->prepare("select nombre from puestos where id=$id");
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;        
        
        }

    }

?>