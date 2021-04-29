<?php 
require_once '../../../database/Conect.php';

require_once '../../../layout/layout.php';
require_once '../../../layout/Menu.php';
require_once 'PartidoService.php';
include 'crudPartido.php';

session_start();

$layout = new Layout();

$conect =new Conect();

$partido=new PartidoService($conect->db);

if(isset($_SESSION['eleccion']['activa'])&&$_SESSION['eleccion']['activa']==1){
    header("Location: ../../../index.php");

}
if(!$_SESSION['admin']['login']){
    header("Location: ../../../index.php");

}


?>
<?php echo $layout->printHeader(); ?>


    <div class="row"id="adminPartido">
        <div class="col-md1">
            <button class="btn btn-dark " onclick="VolverPartidoToOpcion()">Volver</button>
            <button class="btn btn-dark float-end" onclick="AgregarPartido()">Agregar Partido</button>
            <br>
        </div>    
    </div>
    <div class="row" id="partidos">
        <?php
            $asd=$partido->photoId();

            $alumnos = $GLOBALS['totalPartidos'];

            if ($alumnos==0) : ?>

            <h2 >No hay Partidos registrados</h2>

            <?php endif; ?>
            
            <div class="col-sm-3" 
                <?php
                    $data=$partido->ListarPartido();
                    
                    if($data->num_rows>0):
                        while($row = $data->fetch_assoc()) : ?>
                            <div class="col-sm-3" id="partido#<?=$row['id']?>"<?php if($row['estado']=='Inactivo'):
                                ?>style="color:red;"<?php endif; ?>                       >
                                <div class="card" >
                                    <img id="imgPartido#<?=$row['id']?>" class="card-img-top"src="http://localhost/<?=str_replace(['C:\xampp\htdocs\\','\\','#'],['','/','%23'],$row['logo'])?>"alt="Card image cap"style="height: 250px;width: 100%;">
                                    <div class="card-body">
                                    <h5 class="card-title"><?=$row['nombre']?></h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><?=$row['estado']?></li>
                                    <li class="list-group-item scrollbar" ><?=$row['descripcion']?></li>
                                    </ul>
                                    <div class="card-body">
                                    <center>
                                        <button id=<?=$row['id']?> type="button" class="btn btn-secondary" onclick="EditarPartido(this.id)">Editar</button>
                                        <button id=<?=$row['id']?> name=<?=$row['nombre']?> type="button" class="btn btn-danger"onclick="EliminarPartido(this.id,this.name)">Eliminar</button>
                                    </center>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile ?>
                    <?php endif ?>

            </div>
    </div>

<?php echo $layout->printFooter(); ?>
<div class="row">

    <div class="row" id="agregarPartido"style="display:none;" >
            <div class="col-md-4"></div>
            <div class="col-md-4">

            <div class="card">
                <div class="card-header text-white bg-dark"><h3 class="text-center"> Datos del Partido</h3></div>
                <div class="card-body">
                    <div class="card-title"> <h3 class="text-center">Complete toda la informacion</h3></div>
                        <form id="formPartido" method="post" enctype="multipart/form-data">

                            <div class="margen-top-2">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre"name="nombre">
                            </div>
                            <div>
                                <label for="estado" class="form-label">Estado:</label>
                                <select class="form-select"  id="estado" name="estado">
                                        <option>Activo</option>
                                        <option>Inactivo</option>
                                </select>
                            </div>

                            <div>
                                    <label for="logoPartido" class="form-label">Logo de Partido:</label>
                                    <input type="file" class="form-control" name="logoPartido" id="logoPartido"size="30">
                            </div>
                                
                            <br>
                            <div>
                                <textarea rows="5" cols="81" id="descripcion" placeholder="Descripcion:" name="descripcion"></textarea>
                            </div>
                            <br>

                        </form>
                        <div class="col-md-12 text-center">
                                    <button type="buttom" class="btn btn-dark btn-lg" onclick="VolverAgregarPartido()">Volver</button>
                                    <button type="submit" class="btn btn-success btn-lg" onclick="ValidarPartido()">Agregar</button>

                        </div>
                </div>
            </div>
            </div>
            </div>

            <div class="row" id="actualizarPartido" style="display:none;">
            <div class="col-md-4"></div>
            <div class="col-md-4">

            <div class="card">
                <div class="card-header text-white bg-dark"><h3 class="text-center"> Actualizar Datos del Partido</h3></div>
                <div class="card-body">
                    <div class="card-title"> <h3 class="text-center">Complete toda la informacion</h3></div>
                        <form id="formActualizarPartido" method="post" enctype="multipart/form-data">
                            <div class="margen-top-2"style="display:none;">
                                    <label for="idPartido" class="form-label">/label>
                                    <input type="text" class="form-control" id="idPartido"name="idPartido">
                            </div>

                            <div class="margen-top-2">
                                <label for="nombreAct" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombreAct"name="nombreAct">
                            </div>
                            <div>
                                <label for="estadoAct" class="form-label">Estado:</label>
                                <select class="form-select"  id="estadoAct"name="estadoAct">
                                        <option>Activo</option>
                                        <option>Inactivo</option>
                                </select>
                            </div>

                            <div>
                                    <label for="logoPartidoAct" class="form-label">Logo de Partido:</label>
                                    <input type="file" class="form-control" name="logoPartidoAct" id="logoPartidoAct" size="30">
                            </div>
                                
                            <br>
                            <div>
                                <textarea rows="5" cols="81" id="descripcionAct" name="descripcionAct"placeholder="Descripcion:"></textarea>
                            </div>
                            <br>

                        </form>
                        <div class="col-md-12 text-center">
                                <button type="buttom" class="btn btn-dark btn-lg" onclick="VolverActualizarPartido()">Volver</button>
                                <button type="submit" class="btn btn-success btn-lg" onclick="ValidarActualizarPartido();">Agregar</button>

                        </div>
                </div>
            </div>
            </div>
    </div>
</div>

