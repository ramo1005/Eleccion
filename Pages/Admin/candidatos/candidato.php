<?php 
require_once '../../../database/Conect.php';

require_once '../../../layout/layout.php';
require_once '../../../layout/Menu.php';
require_once 'candidatoService.php';
require_once '../puestos/puestoService.php';
require_once '../partidos/PartidoService.php';


include 'crudCandidato.php';

session_start();

$layout = new Layout();

$conect =new Conect();

$candidato=new CandidatoService($conect->db);

$puesto=new puestoService($conect->db);
$partido=new PartidoService($conect->db);


 


if(isset($_GET['idInfo'])&&isset($_GET['action'])&&$_GET['action']=="info"){

    $data=$candidatoService->InfoCandidato($_GET['idInfo']);

    if($data->num_rows>0){
        while($row = $data->fetch_assoc()){
            $_SESSION['candidato']['foto']=$row['foto'];
            $_SESSION['candidato']['cedula']=$row['cedula'];
            $_SESSION['candidato']['nombres']=$row['nombres'];
            $_SESSION['candidato']['apellidos']=$row['apellidos'];
            $_SESSION['candidato']['estado']=$row['estado'];
            $_SESSION['candidato']['partido']=$row['partido'] ;
            $_SESSION['candidato']['puesto']=$row['puesto'];
        }

    }              

}


?>
<?php echo $layout->printHeader(); ?>

    <div class="row"id="adminCandidato">
        <div class="col-md1">
            <button class="btn btn-dark " onclick="VolverCandidatoToOpcion()">Volver</button>
            <button class="btn btn-dark float-end" onclick="AgregarCandidato()">Agregar Candidato</button>
            <br>
        </div>    
    </div>
    <div class="row" id="candidatos">
        <?php
            $asd=$candidato->photoId();

            if(isset($GLOBALS['totalCandidatos'])){
                $candidatos = $GLOBALS['totalCandidatos'];
            }

            if (!isset($GLOBALS['totalCandidatos'])||$candidatos==0) : ?>

            <h2 >No hay Candidatos registrados</h2>

            <?php endif; ?>

            <div class="col-sm-3" 
                <?php 
                    $data=$candidato->ListarCandidato();
                    if($data->num_rows>0):               
                         while($row = $data->fetch_assoc()) : ?>
                             <div class="col-sm-3 " id="candidato#<?=$row['id']?>"<?php if($row['estado']=='Inactivo'):
                                ?>style="color:red;"<?php endif; ?>                       >
                                <div class="card" >
                                    <img class="card-img-top"src="<?=$row['foto']?>" alt="Card image cap"style="height: 250px;width: 100%;">
                                    <div class="card-body">
                                    <h5 class="card-title"><?=$row['nombres']?> <?=$row['apellidos']?></h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><?=$row['estado']?></li>
                                    <li class="list-group-item scrollbar" ><?=$row['partido']?></li>
                                    </ul>
                                    <div class="card-body">
                                    <center>
                                        <button id=<?=$row['id']?> type="button" class="btn btn-secondary" onclick="EditarCandidato(this.id)">Editar</button>                           
                                        <button id=<?=$row['id']?> type="button" class="btn btn-success"onclick="InfoCandidato(this.id);" >Info</button>
                                        <button id=<?=$row['id']?> type="button" class="btn btn-danger"onclick="EliminarCandidato(this.id)">Eliminar</button>
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

    <div class="row" id="agregarCandidato"style="display:none;" >
            <div class="col-md-4"></div>
            <div class="col-md-4">

            <div class="card">
                <div class="card-header text-white bg-dark"><h3 class="text-center"> Datos del Candidato</h3></div>
                <div class="card-body">
                    <div class="card-title"> <h3 class="text-center">Complete toda la informacion</h3></div>
                            <div class="margen-top-2">
                                <label for="cedula" class="form-label">Cedula:</label>
                                <input type="text" class="form-control" id="cedula"name="cedula">
                            </div>
                            <div>
                                <label for="partido" class="form-label">Partido:</label>
                                <select class="form-select"  id="partido">
                                        <option>Seleccione una opcion:</option>
                                        <?php 
                                        $data=$partido->ListarPartido();
                                        if($data->num_rows>0):
                                            while($row = $data->fetch_assoc()) : 
                                                 if($row['estado']=='Activo'):?>
                                                    <option><?=$row['nombre']?></option>
                                                <?php endif; ?>

                                            <?php endwhile ?>
                                        <?php endif ?>
                                        
                                        
                                </select>
                            </div>
                            <div>
                                <label for="puesto" class="form-label">Puesto:</label>
                                <select class="form-select"  id="puesto">
                                        <option>Seleccione una opcion:</option>
                                    <?php 
                                        $data=$puesto->ListarPuesto();
                                        if($data->num_rows>0):
                                            while($row = $data->fetch_assoc()) : ?>
                                        <option><?=$row['nombre']?></option>


                                            <?php endwhile ?>
                                        <?php endif ?>
                                        
                                </select>
                            </div>
                            <div>
                                <label for="estado" class="form-label">Estado:</label>
                                <select class="form-select"  id="estado" name="estado">
                                        <option>Activo</option>
                                        <option>Inactivo</option>
                                </select>
                            </div>
                        <div class="col-md-12 text-center">
                                    <button type="buttom" class="btn btn-dark btn-lg" onclick="VolverAgregarCandidato()">Volver</button>
                                    <button type="submit" class="btn btn-success btn-lg" onclick="ValidarCandidato()">Agregar</button>

                        </div>
                </div>
            </div>
            </div>
            </div>

    
            
    </div>

    <div class="row" id="actualizarCandidato"style="display:none;" >
            <div class="col-md-4"></div>
            <div class="col-md-4">

            <div class="card">
                <div class="card-header text-white bg-dark"><h3 class="text-center"> Datos del Candidato</h3></div>
                <div class="card-body">
                    <div class="card-title"> <h3 class="text-center">Complete toda la informacion</h3></div>
                            <div class="margen-top-2">
                                <label for="cedula" class="form-label">Cedula:</label>
                                <input type="text" class="form-control" id="cedulaAct">
                            </div>
                            <div>
                                <label for="partido" class="form-label">Partido:</label>
                                <select class="form-select"  id="partidoAct">
                                        <option>Seleccione una opcion:</option>
                                        <?php 
                                        $data=$partido->ListarPartido();
                                        if($data->num_rows>0):
                                            while($row = $data->fetch_assoc()) : 
                                                 if($row['estado']=='Activo'):?>
                                                    <option><?=$row['nombre']?></option>
                                                <?php endif; ?>

                                            <?php endwhile ?>
                                        <?php endif ?>
                                        
                                        
                                </select>
                            </div>
                            <div>
                                <label for="puesto" class="form-label">Puesto:</label>
                                <select class="form-select"  id="puestoAct">
                                        <option>Seleccione una opcion:</option>
                                    <?php 
                                        $data=$puesto->ListarPuesto();
                                        if($data->num_rows>0):
                                            while($row = $data->fetch_assoc()) : ?>
                                        <option><?=$row['nombre']?></option>


                                            <?php endwhile ?>
                                        <?php endif ?>
                                        
                                </select>
                            </div>
                            <div>
                                <label for="estado" class="form-label">Estado:</label>
                                <select class="form-select"  id="estadoAct">
                                        <option>Activo</option>
                                        <option>Inactivo</option>
                                </select>
                            </div>
                        <div class="col-md-12 text-center">
                                    <button type="buttom" class="btn btn-dark btn-lg" onclick="VolverActualizarCandidato()">Volver</button>
                                    <button type="submit" class="btn btn-success btn-lg" onclick="ValidarActualizarCandidato()">Actualizar</button>

                        </div>
                </div>
            </div>
            </div>
            </div> 
    </div>                                       

</div>
<?php  if(isset($_SESSION['candidato'])):?>
    <div class="row">
        <div class="row" id="infoCandidato" style="display:none;">
            <div class="col-md-4"></div>
            <div class="col-md-4">

            <div class="card">
                <div class="card-header text-white bg-dark"><h3 class="text-center"> Datos del Candidato</h3></div>
                <div class="card-body">
                <div class="card-title"> <h3 class="text-center">Foto de Perfil:</h3></div>
                        <center>
                        <img class="card-img-top"src="<?=$_SESSION['candidato']['foto']?>"alt="Card image cap"style="height: 250px;width: 50%;">

                        </center>
                        <div class="margen-top-2">
                            <label for="cedulaInfo" class="form-label">Cedula:</label>
                            <input type="text" class="form-control" id="cedulaInfo" value="<?=$_SESSION['candidato']['cedula']?>" readonly="readonly">
                        </div>

                        <div class="margen-top-2">
                            <label for="nombreInfo" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombreInfo" value="<?=$_SESSION['candidato']['nombres']?>" readonly="readonly">
                        </div>
                        <div class="margen-top-2">
                            <label for="apellidoInfo" class="form-label">Apellido:</label>
                            <input type="text" class="form-control" id="apellidoInfo" value="<?=$_SESSION['candidato']['apellidos']?>" readonly="readonly">
                        </div>
                        <div>
                            <label for="estadoInfo" class="form-label">Estado:</label>
                            <input type="text" class="form-control" id="estadoInfo" value="<?=$_SESSION['candidato']['estado']?>" readonly="readonly">

                        </div>
                        <div>
                            <label for="fechaInfo" class="form-label">Partido:</label>
                            <input type="text" class="form-control" id="fechaInfo" value="<?=$_SESSION['candidato']['partido']?>" readonly="readonly">

                        </div>
                        <div>
                            <label for="lugarInfo" class="form-label">Puesto:</label>
                            <input type="text" class="form-control" id="lugarInfo" value="<?=$_SESSION['candidato']['puesto']?>" readonly="readonly">

                        </div>

                        <div class="col-md-12 text-center">
                                <button type="buttom" class="btn btn-dark btn-lg" onclick="VolverInfoCandidato(1)">Volver</button>
                
                        </div>
                </div>
            
            </div>
            </div>
        </div>
    </div>
<?php endif ?>
<?php 
if(isset($_GET['idInfo'])&&isset($_GET['action'])&&$_GET['action']=="info"){

    echo'
    <script type="text/javascript">
        document.getElementById("candidatos").style.display="none";
        document.getElementById("adminCandidato").style.display="none";                    
        document.getElementById("infoCandidato").style.display="";
    </script>
    ';
}

    
?>
