<?php 
require_once '../../../database/Conect.php';

require_once '../../../layout/layout.php';
require_once '../../../layout/Menu.php';
require_once 'eleccionService.php';

include 'crudEleccion.php';

session_start();

$layout = new Layout();

$conect =new Conect();

$eleccion=new eleccionService($conect->db);

if(!$_SESSION['admin']['login']){
    header("Location: ../../../index.php");

}

?>
<?php echo $layout->printHeaderPuesto(); ?>

    <button type="button" class="btn btn-dark" onclick="VolverEleccionToOpcion()" >Volver</button>
    <center>
        <div class="card-body">
        <button type="button" class="btn btn-success"  onclick="chequearCandidatos()"
        <?php 
        $data=$eleccion->CheckEleccionTerminada();
        if($data->num_rows>0):
            $_SESSION['eleccion']['activa']=1
        ?> disabled
        <?php endif;?> >
            Empezar Eleccion
        </button>       
 
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#terminar-eleccion-modal"
         <?php 
        $data=$eleccion->CheckEleccionTerminada();
        if(!$data->num_rows>0):
            $_SESSION['eleccion']['activa']=0?> disabled
        <?php endif;?> >
        
            Terminar Eleccion
        </button> 
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminar-eleccion-modal"
        <?php 
        $data=$eleccion->CheckEleccionTerminada();
        if($data->num_rows>0):?> disabled
        <?php endif;?> >
        
            Eliminar Eleccion
        </button>  
        </div>
    </center>

        <table class="table table-dark " >
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Resultado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $data=$eleccion->ListarElecciones();
                    if($data->num_rows>0):
                        while($row = $data->fetch_assoc()) : ?>
                            <tr>
                            <th scope="row"><?= $row['id']?></th>
                            <td><?= $row['nombre'] ?></td>
                            <td><?= $row['fecha'] ?></td>
                            <td><?= $row['estado'] ?></td>
                            <td><a href="resultados/resultado<?= $row['id'] ?>.txt" download="resultadosElecciones"><?= $row['resultado']?></a></td>
                            </tr>

                        <?php endwhile ?>
                    <?php endif ?>


                </tbody>
        </table>

        <script >
            var elec=<?php echo $eleccion->checkCandidatosEleccion();?>;

            function VolverEleccionToOpcion(){
                window.location.href = "../menu/menu.php"; 
            }
        </script>



<?php echo $layout->printEleccionModals(); ?>
<?php echo $layout->printFooter(); ?>



