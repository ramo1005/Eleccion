<?php
require_once '../../../database/Conect.php';

require_once 'PartidoService.php';

$conect =new Conect();

$partido=new PartidoService($conect->db);

if(isset($_POST['nombre'])&&isset($_POST['estado'])&&isset($_POST['descripcion'])){
    getPartidoPicture();

    $partido->CreatePartido($_POST['nombre'],$_POST['estado'],$_POST['realpath'],$_POST['descripcion']);
    $_POST = array();

}
if(isset($_POST['nombreAct'])&&isset($_POST['estadoAct'])&&isset($_POST['descripcionAct'])&&isset($_POST['idPartido'])){
    getReleasePartidoPicture();

    $partido->ReleasePartido($_POST['nombreAct'],$_POST['estadoAct'],$_POST['realpath'],$_POST['descripcionAct'],$_POST['idPartido']);
    $_POST = array();

}
if(isset($_GET['id'])&&isset($_GET['action'])&&isset($_GET['pathPhoto'])&&isset($_GET['nombre'])){

    $partido->DeletePartido($_GET['id'],$_GET['nombre']);

    $path=str_replace('http://localhost/Eleccion/Pages/Admin/partido/','',$_GET['pathPhoto']);
    unlink($path);

    $_POST = array();
    $_GET = array();

    header("Location: partidos.php");


}


function getPartidoPicture(){
    $conect =new Conect();
    $partido=new PartidoService($conect->db);

    $id=$partido->photoId();

    $nombre="partido#".$id.'.'.pathinfo($_FILES['logoPartido']['name'], PATHINFO_EXTENSION);
    $guardado=$_FILES['logoPartido']['tmp_name'];

    
    if(!file_exists('img/logos')){
        mkdir('img/logos',0777,true);
        if(file_exists('img/logos')){
            if(move_uploaded_file($guardado, 'img/logos/'.$nombre)){
                $_POST['realpath']=realpath('img/logos/'.$nombre);
            }
        }
    }else{
        if(move_uploaded_file($guardado, 'img/logos/'.$nombre)){
            $_POST['realpath']=realpath('img/logos/'.$nombre);

        }
    }
}
function getReleasePartidoPicture(){


    $id=$_POST['idPartido'];

    $nombre="partido#".$id.'.'.pathinfo($_FILES['logoPartidoAct']['name'], PATHINFO_EXTENSION);
    $guardado=$_FILES['logoPartidoAct']['tmp_name'];

    
    if(!file_exists('img/logos')){
        mkdir('img/logos',0777,true);
        if(file_exists('img/logos')){
            if(move_uploaded_file($guardado, 'img/logos/'.$nombre)){
                $_POST['realpath']=realpath('img/logos/'.$nombre);
            }
        }
    }else{
        if(move_uploaded_file($guardado, 'img/logos/'.$nombre)){
            $_POST['realpath']=realpath('img/logos/'.$nombre);

        }
    }
}
?>