<?php 
require_once '../../../database/Conect.php';
require_once '../../../layout/layout.php';
require_once '../../../layout/Menu.php';
require_once '../../Admin/puestos/puestoService.php';

require_once 'votarService.php';



$layout = new Layout();

$conect =new Conect();

$puesto=new puestoService($conect->db);

$item = new VotarService($conect->db);

$conteo=0;


?>

<?php echo $layout->printHeader(); ?>

        <div class="row"id="adminCiudadano">
                <div class="col-md1">
                    <button id="back" class="btn btn-dark " onclick="VolverPuestosVotar()"style="display:none">Volver</button>
                    <button id="end" class="btn btn-dark float-end " onclick="SalirVotar()">Terminar</button>

                    <br>
                </div> 
                <center><h2 id="tituloPuesto">Puestos Electivos</h2></center> 
        </div>
        <div class="row" id="puestos">

            <div class="col-sm-3" 
                <?php 
                    $data=$puesto->ListarPuesto();
                    $toJavaScript=array();
                    $toJavaScript2=array();

                    if($data->num_rows>0):               
                        while($row = $data->fetch_assoc()) : ?>
                            <div class="col-sm-3 "id="<?=$row['nombre']?>">
                                <div class="card text-center" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$row['nombre']?></h5>
                                        <center>
                                            <button id="puestoElectivo<?=$conteo?>" name="<?=$conteo?>" type="button" class="btn btn-success" onclick="verCandidatosVotar(this.name,this.id)" >Votar</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <?php   array_push($toJavaScript2,$row['nombre']);
                                    array_push($toJavaScript,'voto_'.strtolower($row['nombre']));
                                    $conteo+=1;?>

        
                        <?php endwhile ?>
                    <?php endif ?>   
            </div>
        </div> 

        <div class="row" id="candidatos">

                <?php 
        
                for ($i = 0; $i <count($toJavaScript2); $i++):

                    $data2=$item->ListarCandidatos($toJavaScript2[$i]);

                    if($data2->num_rows>0):?>
                        <div class="row" id="voto_<?=strtolower($toJavaScript2[$i])?>"style="display:none;">
                        <?php while($row2 = $data2->fetch_assoc()) : ?>
                            <?php  if ($row2['estado']=='Activo'):?>


                                    <div class="col-sm-3 card" id="candidato#<?=$row2['id']?>">
                                    <input id="<?=$row2['id']?>" class="form-check-input" type="checkbox"  onclick="ActivarBotonVotar(this.id)">

                                        <div class="card" >
                                            <img class="card-img-top"src="<?=$row2['foto']?>" alt="Card image cap"style="height: 250px;width: 100%;">
                                            <div class="card-body">
                                            <h5 class="card-title"><?=$row2['nombres']?> <?=$row2['apellidos']?></h5>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><?=$row2['estado']?></li>
                                            <li class="list-group-item scrollbar" ><?=$row2['partido']?></li>
                                        </ul>
                                        <div class="card-body">
                                        <center>
                                            <button id=<?=$row2['id']?> type="button" class="btn btn-warning"onclick="InfoVotarCandidato(this.id);" >Info</button>


                                            <button id="boton<?=$row2['id']?>" name="<?=$toJavaScript2[$i]?>" type="button" class="btn btn-success"onclick="VotarUserCandidato(this.id,this.name);"disabled >Votar</button>
                                        </center>
                                        </div>
                                        </div>
                                </div>
                                <?php endif ?> 

                        <?php endwhile ?>
                            <div class="col-sm-3 ">
                                    <div class="card text-center" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">Ninguno</h5>
                                            <center>
                                                <button name="<?=$toJavaScript2[$i]?>" type="button" class="btn btn-success" onclick="VotarUserCandidato('Ninguno',this.name)"  >Votar</button>
                                            </center>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    <?php endif ?> 
                <?php endfor ?>

            
        </div>
        <script type="text/javascript">
            var obj = <?php echo json_encode($toJavaScript); ?>;
            var obj2 = <?php echo json_encode($toJavaScript2); ?>;       
        </script>

        <script src="js/UserFuntions.js"></script>         
<?php include 'subirVotos.php';?>
<?php echo $layout->printFooter(); ?>

