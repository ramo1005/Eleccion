<?php

require_once 'database/Conect.php';
require_once 'Eleccion/UserCheck.php';

session_start();

$conect =new Conect();

$check=new UserCheck($conect->db);

if(isset($_GET['cedula'])){

    $data=$check->CheckEleccionActiva();
    if(!$data->num_rows>0){
        echo'
        <script type="text/javascript">
            alert("No Hay eleciones Activa");
        </script>';
    }
    else{
        $data=$check->CheckCiudadanoActivo($_GET['cedula']);


        if($data->num_rows>0){

            $row=$data->fetch_assoc();
            $idCiudadano=$row['id'];
            $checkVote =$check->CheckCiudadanoVoto($idCiudadano);

            if(!$checkVote->num_rows>0){
                $_SESSION['votante']['cedula']=$_GET['cedula'];
                echo'
                <script type="text/javascript">
                    window.location.href = "Pages/User/menu/votar.php"; 
                </script>';
            }

            else{
                echo'
                <script type="text/javascript">
                    alert("Usted ya VOTO");
                </script>';
            }
        }
        else{
            echo'
            <script type="text/javascript">
                alert("No estas activo para votar en esta Elecciones");
            </script>';
        }
    }
}
?>