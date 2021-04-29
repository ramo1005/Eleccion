<?php
require_once '../../../database/Conect.php';

require_once 'puestoService.php';

$conect =new Conect();

$puesto=new puestoService($conect->db);

if(isset($_POST['nombre'])){

    $puesto->CreatePuesto($_POST['nombre']);
    $_POST = array();

}
if(isset($_POST['idAct'])&&isset($_POST['nombreAct'])){

    $puesto->ReleasePuesto($_POST['idAct'],$_POST['nombreAct']);
    $_POST = array();

}
if(isset($_POST['idDelete'])){

    $puesto->DeletePuesto($_POST['idDelete']);


    $_POST = array();

}



?>