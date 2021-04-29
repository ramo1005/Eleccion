<?php

require_once '../../../database/Conect.php';

require_once 'votarService.php';
require_once 'sendResult.php';


$conect =new Conect();

$item = new VotarService($conect->db);

$result= new sendResult();



if(isset($_POST['idCandidato'])&&isset($_POST['table'])&&isset($_POST['cedulaVotante'])){



    if($_POST['idCandidato']=="Ninguno"){
        $idVotante=$item->IdVotante($_POST['cedulaVotante'])['id'];
        $query="insert into candidato_default(votante_id,tabla) values({$idVotante},'{$_POST['table']}')";
        $item->InsertarVotoNinguno($query);
        $result->escribirResultado($_POST['table'],"Ninguno",$_POST['cedulaVotante']);
    }

    else{

        $data= $item->InfoCandidatosResult($_POST['idCandidato']);
        $fullName="{$data['nombres']} {$data['apellidos']}";

        $idVotante=$item->IdVotante($_POST['cedulaVotante'])['id'];
        $query="insert into voto_{$_POST['table']}(votante_id,candidato_id) values({$idVotante},{$_POST['idCandidato']})";
        $item->InsertarVoto($query);
        $result->escribirResultado($_POST['table'],$fullName,$_POST['cedulaVotante']);

    }

    $data= $item->InfoCandidatosResult($_POST['idCandidato']);
    $fullName="{$data['nombres']} {$data['apellidos']}";



           
}
if(isset($_POST['cedulaVotante'])&&isset($_POST['estado'])){

    $idVotante=$item->IdVotante($_POST['cedulaVotante'])['id'];


    $query="insert into voto_ciudadanos (votante_id,estado) values({$idVotante},{$_POST['estado']})";

    $item->InsertarVotoTerminado($query);



}

?>