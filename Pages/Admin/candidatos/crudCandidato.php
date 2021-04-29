<?php
require_once '../../../database/Conect.php';

require_once 'candidatoService.php';
require_once 'classCandidato.php';


$conect =new Conect();

$candidatoService=new CandidatoService($conect->db);

//add candidato
if(isset($_GET['cedula'])&&isset($_GET['nombres'])&&isset($_GET['apellidos'])&&isset($_GET['estado'])&&isset($_GET['partido'])&&
isset($_GET['puesto'])&&isset($_GET['foto'])){

    $candidato= new classCandidato(0,$_GET['cedula'],$_GET['nombres'],$_GET['apellidos'],$_GET['estado'],$_GET['partido'],$_GET['puesto'],$_GET['foto']);
    $candidatoService->CreateCandidato($candidato);
    $_POST = array();

}
//release candidato
if(isset($_GET['idAct'])&&isset($_GET['cedulaAct'])&&isset($_GET['nombresAct'])&&isset($_GET['apellidosAct'])&&isset($_GET['estadoAct'])&&isset($_GET['partidoAct'])&&
isset($_GET['puestoAct'])&&isset($_GET['fotoAct'])){


    $candidatoRelease= new classCandidato($_GET['idAct'],$_GET['cedulaAct'],$_GET['nombresAct'],$_GET['apellidosAct'],$_GET['estadoAct'],$_GET['partidoAct'],
    $_GET['puestoAct'],$_GET['fotoAct']);

    $candidatoService->ReleaseCandidato($candidatoRelease);

    $_POST = array();

}
//delete candidato
if(isset($_GET['idDelete'])&&isset($_GET['action'])&&$_GET['action']=="borrar"){

    $candidatoService->DeleteCandidato($_GET['idDelete']);


    $_POST = array();
    $_GET = array();

}



?>