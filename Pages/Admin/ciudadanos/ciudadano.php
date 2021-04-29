<?php 
require_once '../../../database/Conect.php';

require_once '../../../layout/layout.php';
require_once '../../../layout/Menu.php';
require_once 'ciudadanoService.php';
include 'crudCiudadano.php';

session_start();

$layout = new Layout();

$conect =new Conect();

$ciudadano=new CiudadanoService($conect->db);

if(isset($_SESSION['eleccion']['activa'])&&$_SESSION['eleccion']['activa']==1){
    header("Location: ../../../index.php");

}

if(!$_SESSION['admin']['login']){
    header("Location: ../../../index.php");

}

if(isset($_GET['idInfo'])&&isset($_GET['action'])&&$_GET['action']=="info"){

    $data=$ciudadanoService->InfoCiudadano($_GET['idInfo']);

    if($data->num_rows>0){
        while($row = $data->fetch_assoc()){
            $_SESSION['ciudano']['foto']=$row['foto'];
            $_SESSION['ciudano']['cedula']=$row['cedula'];
            $_SESSION['ciudano']['nombres']=$row['nombres'];
            $_SESSION['ciudano']['apellidos']=$row['apellidos'];
            $_SESSION['ciudano']['estado']=$row['estado'];
            $_SESSION['ciudano']['fecha_nacimiento']=str_replace('00:00:00.000','',$row['fecha_nacimiento']) ;
            $_SESSION['ciudano']['lugar_nacimiento']=$row['lugar_nacimiento'];
            $_SESSION['ciudano']['sexo']=$row['sexo'];
            $_SESSION['ciudano']['estado_civil']=$row['estado_civil'];
            $_SESSION['ciudano']['correo']=$row['correo'];
        }

    }              

}


?>
<?php echo $layout->printHeader(); ?>

    <div class="row"id="adminCiudadano">
        <div class="col-md1">
            <button class="btn btn-dark " onclick="VolverCiudadanoToOpcion()">Volver</button>
            <button class="btn btn-dark float-end" onclick="AgregarCiudadano()">Agregar Ciudadano</button>
            <br>
        </div>    
    </div>
    <div class="row" id="ciudadanos">
        <?php
            $asd=$ciudadano->photoId();

            if(isset($GLOBALS['totalCiudadanos'])){
                $ciudadanos = $GLOBALS['totalCiudadanos'];
            }

            if (!isset($GLOBALS['totalCiudadanos'])||$ciudadanos==0) : ?>

            <h2 >No hay Ciudadanos registrados</h2>

            <?php endif; ?>

            <div class="col-sm-3" 
                <?php 
                    $data=$ciudadano->ListarCiudadano();
                    if($data->num_rows>0):               
                         while($row = $data->fetch_assoc()) : ?>
                             <div class="col-sm-3" id="ciudadano#<?=$row['id']?>"<?php if($row['estado']=='Inactivo'):
                                ?>style="color:red;"<?php endif; ?>                       >
                                <div class="card" >
                                    <img class="card-img-top"src="<?=$row['foto']?>" alt="Card image cap"style="height: 250px;width: 100%;">
                                    <div class="card-body">
                                    <h5 class="card-title"><?=$row['nombres']?> <?=$row['apellidos']?></h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><?=$row['estado']?></li>
                                    <li class="list-group-item scrollbar" ><?=$row['correo']?></li>
                                    </ul>
                                    <div class="card-body">
                                    <center>
                                        <button id=<?=$row['id']?> type="button" class="btn btn-secondary" onclick="EditarCiudadano(this.id)">Editar</button>                           
                                        <button id=<?=$row['id']?> type="button" class="btn btn-success"onclick="InfoCiudadano(this.id);" >Info</button>
                                        <button id=<?=$row['id']?> type="button" class="btn btn-danger"onclick="EliminarCiudadano(this.id)">Eliminar</button>
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

    <div class="row" id="agregarCiudadano"style="display:none;" >
            <div class="col-md-4"></div>
            <div class="col-md-4">

            <div class="card">
                <div class="card-header text-white bg-dark"><h3 class="text-center"> Datos del Ciudadano</h3></div>
                <div class="card-body">
                    <div class="card-title"> <h3 class="text-center">Complete toda la informacion</h3></div>
                            <div class="margen-top-2">
                                <label for="cedula" class="form-label">Cedula:</label>
                                <input type="text" class="form-control" id="cedula"name="cedula">
                            </div>
                            <div>
                                <label for="estado" class="form-label">Estado:</label>
                                <select class="form-select"  id="estado" name="estado">
                                        <option>Activo</option>
                                        <option>Inactivo</option>
                                </select>
                            </div>
                            <div class="margen-top-2">
                                <label for="correo" class="form-label">Correo:</label>
                                <input type="text" class="form-control" id="correo"name="correo">
                            </div>
                        <div class="col-md-12 text-center">
                                    <button type="buttom" class="btn btn-dark btn-lg" onclick="VolverAgregarCiudadano()">Volver</button>
                                    <button type="submit" class="btn btn-success btn-lg" onclick="ValidarCiudadano()">Agregar</button>

                        </div>
                </div>
            </div>
            </div>
            </div>

            <div class="row" id="actualizarCiudadano" style="display:none;">
            <div class="col-md-4"></div>
            <div class="col-md-4">

            <div class="card">
                <div class="card-header text-white bg-dark"><h3 class="text-center"> Actualizar Datos del Ciudadano</h3></div>
                <div class="card-body">
                    <div class="card-title"> <h3 class="text-center">Complete toda la informacion</h3></div>

                            <div class="margen-top-2">
                                <label for="cedulaAct" class="form-label">Cedula:</label>
                                <input type="text" class="form-control" id="cedulaAct"name="cedulaAct">
                            </div>
                            <div>
                                <label for="estadoAct" class="form-label">Estado:</label>
                                <select class="form-select"  id="estadoAct" name="estadoAct">
                                        <option>Activo</option>
                                        <option>Inactivo</option>
                                </select>
                            </div>
                            <div class="margen-top-2">
                                <label for="correoAct" class="form-label">Correo:</label>
                                <input type="text" class="form-control" id="correoAct"name="correoAct">
                            </div>
                        <div class="col-md-12 text-center">
                                <button type="buttom" class="btn btn-dark btn-lg" onclick="VolverActualizarCiudadano()">Volver</button>
                                <button type="submit" class="btn btn-success btn-lg" onclick="ValidarActualizarCiudadano();">Agregar</button>

                        </div>
                </div>
            </div>
            </div>
            
    </div>
</div>
<?php  if(isset($_SESSION['ciudano'])):?>
    <div class="row">
        <div class="row" id="infoCiudadano" style="display:none;">
            <div class="col-md-4"></div>
            <div class="col-md-4">

            <div class="card">
                <div class="card-header text-white bg-dark"><h3 class="text-center"> Datos del Ciudadano</h3></div>
                <div class="card-body">
                <div class="card-title"> <h3 class="text-center">Foto de Perfil:</h3></div>
                        <center>
                        <img class="card-img-top"src="<?=$_SESSION['ciudano']['foto']?>"alt="Card image cap"style="height: 250px;width: 50%;">

                        </center>
                        <div class="margen-top-2">
                            <label for="cedulaInfo" class="form-label">Cedula:</label>
                            <input type="text" class="form-control" id="cedulaInfo" value="<?=$_SESSION['ciudano']['cedula']?>" readonly="readonly">
                        </div>

                        <div class="margen-top-2">
                            <label for="nombreInfo" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombreInfo" value="<?=$_SESSION['ciudano']['nombres']?>" readonly="readonly">
                        </div>
                        <div class="margen-top-2">
                            <label for="apellidoInfo" class="form-label">Apellido:</label>
                            <input type="text" class="form-control" id="apellidoInfo" value="<?=$_SESSION['ciudano']['apellidos']?>" readonly="readonly">
                        </div>
                        <div>
                            <label for="estadoInfo" class="form-label">Estado:</label>
                            <input type="text" class="form-control" id="estadoInfo" value="<?=$_SESSION['ciudano']['estado']?>" readonly="readonly">

                        </div>
                        <div>
                            <label for="fechaInfo" class="form-label">Fecha de Nacimiento:</label>
                            <input type="text" class="form-control" id="fechaInfo" value="<?=$_SESSION['ciudano']['fecha_nacimiento']?>" readonly="readonly">

                        </div>
                        <div>
                            <label for="lugarInfo" class="form-label">Lugar de Nacimiento:</label>
                            <input type="text" class="form-control" id="lugarInfo" value="<?=$_SESSION['ciudano']['lugar_nacimiento']?>" readonly="readonly">

                        </div>
                        <div>
                            <label for="sexoInfo" class="form-label">Sexo:</label>
                            <input type="text" class="form-control" id="sexoInfo" value="<?=$_SESSION['ciudano']['sexo']?>" readonly="readonly">

                        </div>
                        <div>
                            <label for="estadocInfo" class="form-label">Estado Civil:</label>
                            <input type="text" class="form-control" id="estadocInfo" value="<?=$_SESSION['ciudano']['estado_civil']?>" readonly="readonly">

                        </div>
                        <div>
                            <label for="correoInfo" class="form-label">Correo:</label>
                            <input type="text" class="form-control" id="correoInfo" value="<?=$_SESSION['ciudano']['correo']?>" readonly="readonly">

                        </div>

                        <div class="col-md-12 text-center">
                                <button type="buttom" class="btn btn-dark btn-lg" onclick="VolverInfoCiudadano()">Volver</button>
                
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
        document.getElementById("ciudadanos").style.display="none";
        document.getElementById("adminCiudadano").style.display="none";                    
        document.getElementById("infoCiudadano").style.display="";
    </script>
    ';
}

    
?>
