<?php 
require_once '../../../database/Conect.php';

require_once '../../../layout/layout.php';
require_once '../../../layout/Menu.php';
require_once 'puestoService.php';

include 'crudPuestos.php';

session_start();

$layout = new Layout();

$conect =new Conect();

$puesto=new puestoService($conect->db);

if(isset($_SESSION['eleccion']['activa'])&&$_SESSION['eleccion']['activa']==1){
    header("Location: ../../../index.php");

}

if(!$_SESSION['admin']['login']){
    header("Location: ../../../index.php");

}



?>
<?php echo $layout->printHeaderPuesto(); ?>

    <button type="button" class="btn btn-dark" onclick="VolverPuestoToOpcion()" >Volver</button>
    <center>
        <div class="card-body">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevo-puesto-modal">
            Agregar Puesto
        </button>            
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editar-puesto-modal">
            Editar Puesto
        </button>  
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminar-puesto-modal">
            Eliminar Puesto
        </button>
        </div>
    </center>

        <table class="table table-dark " >
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Creado</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $data=$puesto->ListarPuesto();
                    if($data->num_rows>0):
                        while($row = $data->fetch_assoc()) : ?>
                            <tr>
                            <th scope="row"><?= $row['id']?></th>
                            <td><?= $row['nombre'] ?></td>
                            <td><?= $row['created'] ?></td>
                            </tr>

                        <?php endwhile ?>
                    <?php endif ?>


                </tbody>
        </table>

        <script >
            function VolverPuestoToOpcion(){
                window.location.href = "../menu/menu.php"; 
            }
        </script>



<?php echo $layout->printModals(); ?>
<?php echo $layout->printFooter(); ?>



