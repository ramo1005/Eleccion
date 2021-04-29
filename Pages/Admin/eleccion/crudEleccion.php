<?php
require_once '../../../database/Conect.php';

require_once 'eleccionService.php';

require_once 'terminarEleccion.php';


$conect =new Conect();

$eleccion=new eleccionService($conect->db);

$acabar= new TerminarEleccion();

if(isset($_POST['nombre'])&&isset($_POST['fecha'])&&isset($_POST['estado'])){

    $eleccion->EmpezarEleccion($_POST['nombre'],$_POST['fecha'],$_POST['estado']);
    $_POST = array();

}
if(isset($_POST['resultado'])&&isset($_POST['estadoAct'])){

    $acabar->Resultados();
    $eleccion->TerminarEleccion($_POST['estadoAct'],$_POST['resultado']);
    $_POST = array();

}
if(isset($_POST['idDelete'])){

    $eleccion->BorrarEleccion($_POST['idDelete']);
    unlink('resultados/resultado'.$_POST['idDelete'].'.txt');


    $_POST = array();

}



?>