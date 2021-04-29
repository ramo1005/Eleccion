<?php 
    require_once '../../../database/Conect.php';
    require_once 'eleccionService.php';
    
    class TerminarEleccion{

        function Resultados(){
            $conect =new Conect();
            $eleccion=new eleccionService($conect->db);

            $data=$eleccion->GetTablesPuestos();
            $eleccio=$eleccion->GetEleccionActiva();


            $path_to_file = 'resultados/resultado'.$eleccio['id'].'.txt';

            $myfile = fopen($path_to_file, "a");


            $titulo ="Eleccion:".$eleccio['nombre']."\nFecha:".$eleccio['fecha']."\n\n";
            fwrite($myfile,$titulo);



            if($data->num_rows>0){               
                while($row = $data->fetch_assoc()){
                    $text="Resultados de la posicion: ".$row['nombre']."\n";
                    fwrite($myfile,$text);
                    $table='voto_'.strtolower($row['nombre']);
                    
                    $data2=$eleccion->GetResultElection($table);
                    if($data2->num_rows>0){  
                        while($row2 = $data2->fetch_assoc()){
                            fwrite($myfile,json_encode($row2));
                            fwrite($myfile,"\n");

                        }
                    }
                    fwrite($myfile,"\n\n");
                    $eleccion->DropPuestosTable($table);
                }
            }
            fclose($myfile);
            $eleccion->DropDataTables();
        }
    }

?>