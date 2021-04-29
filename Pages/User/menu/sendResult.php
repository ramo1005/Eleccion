<?php
    
    class sendResult{


        function escribirResultado($puesto,$candidato,$cedula){
            $path_to_file = 'VotoEmail#'.$cedula.'.txt';

            if (file_exists($path_to_file)) {
                $myfile = fopen($path_to_file, "a");
                $text="$puesto:$candidato\n";
                fwrite($myfile, $text);
                fclose($myfile);
            } else {
                $myfile = fopen($path_to_file, "w");
                $text="Usted voto por:\n";
                fwrite($myfile, $text);
                $text="$puesto:$candidato\n";
                fwrite($myfile, $text);
                fclose($myfile);
            }
        }

    }

?>