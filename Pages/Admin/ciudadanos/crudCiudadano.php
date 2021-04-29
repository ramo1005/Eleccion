<?php
require_once '../../../database/Conect.php';

require_once 'ciudadanoService.php';
require_once 'classCiudadano.php';


$conect =new Conect();

$ciudadanoService=new ciudadanoService($conect->db);

//add ciudadano
if(isset($_GET['cedula'])&&isset($_GET['nombres'])&&isset($_GET['apellidos'])&&isset($_GET['estado'])&&isset($_GET['fecha_nacimiento'])&&
isset($_GET['lugar_nacimiento'])&&isset($_GET['sexo'])&&isset($_GET['estado_civil'])&&isset($_GET['foto'])&&isset($_GET['correo'])){

    $ciudadano= new classCiudadano(0,$_GET['cedula'],$_GET['nombres'],$_GET['apellidos'],$_GET['estado'],$_GET['fecha_nacimiento'],
    $_GET['lugar_nacimiento'],$_GET['sexo'],$_GET['estado_civil'],$_GET['foto'],$_GET['correo']);
    $ciudadanoService->CreateCiudadano($ciudadano);
    $_POST = array();

}
//release ciudadano
if(isset($_GET['idAct'])&&isset($_GET['cedulaAct'])&&isset($_GET['nombresAct'])&&isset($_GET['apellidosAct'])&&isset($_GET['estadoAct'])&&isset($_GET['fecha_nacimientoAct'])&&
isset($_GET['lugar_nacimientoAct'])&&isset($_GET['sexoAct'])&&isset($_GET['estado_civilAct'])&&isset($_GET['fotoAct'])&&isset($_GET['correoAct'])){


    $ciudadanoRelease= new classCiudadano($_GET['idAct'],$_GET['cedulaAct'],$_GET['nombresAct'],$_GET['apellidosAct'],$_GET['estadoAct'],$_GET['fecha_nacimientoAct'],
    $_GET['lugar_nacimientoAct'],$_GET['sexoAct'],$_GET['estado_civilAct'],$_GET['fotoAct'],$_GET['correoAct']);

    $ciudadanoService->ReleaseCiudadano($ciudadanoRelease);

    $_POST = array();

}
//delete ciudadano
if(isset($_GET['idDelete'])&&isset($_GET['action'])&&$_GET['action']=="borrar"){

    $ciudadanoService->DeleteCiudadano($_GET['idDelete']);


    $_POST = array();
    $_GET = array();

    header("Location: ciudadano.php");

}



?>