<?php
    require_once '../EmailHandler/EmailHandler.php';

    require_once '../Pages/User/menu/votarService.php';
    require_once '../database/Conect.php';

    $conect =new Conect();

    $item = new VotarService($conect->db);
    $mail =new EmailHandler();

    if(isset($_POST['cedulaVotante'])){

        $path_to_file = 'User/menu/VotoEmail#'.$_POST['cedulaVotante'].'.txt';

        $myfile = fopen($path_to_file, "r");
        $data =fread($myfile,filesize($path_to_file));
        fclose($myfile);
        unlink($path_to_file);
        $mail->SendEmail($item->InfoCiudadanoEmail($_POST['cedulaVotante'])['correo'],'Resultado de mi Eleccion',$data);


    }
    
?>