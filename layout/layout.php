<?php
    class Layout{

        private $IsRoot;

        public function __construct($isRoot = false)
        {
            $this->IsRoot = $isRoot;
        }

    function printHeader(){

        $directory = ($this->IsRoot) ? "" : "../../../";

        $header = <<<EOF
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Final</title>

    <link rel="stylesheet" href="{$directory}assets/css/style.css">
    <link rel="stylesheet" href="{$directory}assets/css/bootstrap/bootstrap.min.css">
</head>

<body style="background-color:grey;">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{$directory}index.php">Elecciones</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">

            </ul>
        </div>
    </div>
    </nav>

    <br><br><br><br><br>

    <main id="menu"class="container">


EOF;

    echo $header;

    }
    function printHeaderPuesto(){

        $directory = ($this->IsRoot) ? "" : "../../../";

        $header = <<<EOF

        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Final</title>

    <link rel="stylesheet" href="{$directory}assets/css/style.css">
    <link rel="stylesheet" href="{$directory}assets/css/bootstrap/bootstrap.min.css">

</head>

<body style="background-color:grey;">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{$directory}index.php">Eleccion</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">

            </ul>
        </div>
    </div>
    </nav>

    <br><br><br><br><br>

    <main id="menu"class="container">


EOF;

    echo $header;

    }


    function printFooter(){

        $directory = ($this->IsRoot) ? "" : "../../../";

        $footer = <<<EOF

        </main>      
        <script src="{$directory}assets/js/index/MenuFuntions.js"></script>
        <script src="{$directory}assets/js/index/AdminCiudadanosFuntions.js"></script>
        <script src="{$directory}assets/js/index/AdminPartidosFuntions.js"></script>
        <script src="{$directory}assets/js/index/AdminPuestosFuntions.js"></script>
        <script src="{$directory}assets/js/index/AdminCandidatosFuntions.js"></script>
        <script src="{$directory}assets/js/index/AdminEleccionFuntions.js"></script>


        <script src="{$directory}assets/js/bootstrap/bootstrap.min.js"></script>
        <script src="{$directory}assets/js/jquery/jquery-3.5.1.min.js"></script>

    
    </body>
    
    </html>

EOF;

    echo $footer;

    }
    function printModals(){


        $modal = <<<EOF
        <div class="modal fade" id="nuevo-puesto-modal" tabindex="-1" aria-labelledby="nuevopuestoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevopuestoLabel">Nuevo Puesto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
    
                    <form action="puestos.php" method="POST">
                        <div class="mb-3">
                            <label for="puesto-nombre" class="form-label">Nombre:</label>
                            <input name="nombre" type="text" class="form-control" id="puesto-nombre">
    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
    <div class="modal fade" id="editar-puesto-modal" tabindex="-1" aria-labelledby="editarpuestoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarpuestoLabel">Editar Puesto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
    
                    <form action="puestos.php" method="POST">
                        <div class="mb-3">
                            <label for="puesto-id" class="form-label">Id:</label>
                            <input name="idAct" type="text" class="form-control" id="puesto-id">
                        </div>
                        <div class="mb-3">
                            <label for="puesto-nombre" class="form-label">Nombre:</label>
                            <input name="nombreAct" type="text" class="form-control" id="puesto-nombre">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
    <div class="modal fade" id="eliminar-puesto-modal" tabindex="-1" aria-labelledby="eliminarpuestoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarpuestoLabel">Borrar Puesto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
    
                    <form action="puestos.php" method="POST">
                        <div class="mb-3">
                            <label for="puesto-id-delete" class="form-label">Id:</label>
                            <input name="idDelete" type="text" class="form-control" id="puesto-id-delete">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Borrar</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
    

EOF;

    echo $modal;

    }

    function printEleccionModals(){


        $modal = <<<EOF
        <div class="modal fade" id="empezar-eleccion-modal" tabindex="-1" aria-labelledby="empezareleccionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="empezareleccionLabel">Nuevo Eleccion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
    
                    <form action="eleccion.php" method="POST">
                        <div class="mb-3">
                            <label for="eleccion-nombre" class="form-label">Nombre:</label>
                            <input name="nombre" type="text" class="form-control" id="eleccion-nombre">
    
                        </div>
                            <div class="mb-3">
                            <label for="eleccion-fecha" class="form-label">Fecha:</label>
                            <input name="fecha" type="text" class="form-control" id="eleccion-fecha">

                        </div>
                        <div class="mb-3">
                            <label for="eleccion-estado" class="form-label">Estado:</label>
                            <input name="estado" type="text" value="Activa" class="form-control" id="eleccion-estado" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Empezar</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
    <div class="modal fade" id="terminar-eleccion-modal" tabindex="-1" aria-labelledby="terminareleccionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="terminareleccionLabel">Terminar Eleccion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="eleccion.php" method="POST">
                        <div class="mb-3">
                            <label for="eleccion-resultado" class="form-label">Resultado:</label>
                            <input name="resultado" type="text" value="Link de Resultados" class="form-control" id="eleccion-resultado"readonly>

                        </div>
                        <div class="mb-3">
                            <label for="elccion-estadoAct" class="form-label">Estado:</label>
                            <input name="estadoAct" type="text" value="Finalizada" class="form-control" id="elccion-estadoAct" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Terminar</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
    <div class="modal fade" id="eliminar-eleccion-modal" tabindex="-1" aria-labelledby="eliminareleccionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminareleccionLabel">Borrar Eleccion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
    
                    <form action="eleccion.php" method="POST">
                        <div class="mb-3">
                            <label for="puesto-id-delete" class="form-label">Id:</label>
                            <input name="idDelete" type="text" class="form-control" id="puesto-id-delete">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Borrar</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
    

EOF;

    echo $modal;

    }

}
