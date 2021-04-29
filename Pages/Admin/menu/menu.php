<?php
require_once '../../../database/Conect.php';

require_once '../../../layout/layout.php';
require_once '../../../layout/Menu.php';
require_once '../eleccion/eleccionService.php';




session_start();

$layout = new Layout();
$menu = new Menu(true);

$conect =new Conect();

$eleccion=new eleccionService($conect->db);


if(!$_SESSION['admin']['login']){
    header("Location: ../../../index.php");
}
?>


<?php echo $layout->printHeader(); ?>
    <center id="adminOpcion">
        <div class="card-body">
            <button type="button" class="btn btn-dark"onclick="Candidatos()"<?php $data=$eleccion->CheckEleccionTerminada();if($data->num_rows>0):?> disabled<?php endif;?> >Candidatos </button>            
            <button type="button" class="btn btn-dark"onclick="Partidos()"<?php $data=$eleccion->CheckEleccionTerminada();if($data->num_rows>0):?> disabled<?php endif;?>>Partidos</button>
            <button type="button" class="btn btn-dark"onclick="Puestos()"<?php $data=$eleccion->CheckEleccionTerminada();if($data->num_rows>0):?> disabled<?php endif;?>>Puesto Electivo</button>
            <button type="button" class="btn btn-dark"onclick="Ciudadanos()"<?php $data=$eleccion->CheckEleccionTerminada();if($data->num_rows>0):?> disabled<?php endif;?>>Ciudadanos</button>
            <button type="button" class="btn btn-warning"onclick="Eleccion()">Eleccion</button>   
            <button type="button" class="btn btn-danger float-end"onclick="SalirSession()">Salir</button>     

        </div>
    </center>
<?php echo $layout->printFooter(); ?>

