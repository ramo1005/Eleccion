<?php
    class Menu{

        private $IsRoot;

        public function __construct($isRoot = false)
        {
            $this->IsRoot = $isRoot;
        }

    function printVotante(){

        $directory = ($this->IsRoot) ? "" : "../";

        $votante = <<<EOF

        <div class="col-md1" id="votante">
            <button id="btn-admin-volver" type="button" class="btn btn-dark float-end " style="display:none;" onclick="VolverAdminPanel()">Volver</button>
            <button id="btn-admin" type="button" class="btn btn-dark float-end"onclick="AdminPanel()">Administrador</button>
        </div>
        <br><br>
        <div class="row" id="login" >
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="card">
                <div class="card-header text-white bg-dark"><h3 class="text-center"> Datos del Votante</h3></div>
                <div class="card-body">
                    <div class="card-title"> <h3 class="text-center">Complete toda la informacion</h3></div>
                        <form id="formLogin" method="post" enctype="multipart/form-data">

                            <div class="margen-top-2">
                                <label for="cedula" class="form-label">Cedula:</label>
                                <input type="text" class="form-control" id="cedula">
                            </div>

                        </form>
                        <br>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success btn-lg" onclick="ValidarVotante()">Ingresar</button>
                        </div>
    
                </div>
            </div>
            </div>
            </div>
        </div>


EOF;

    echo $votante;

    }


    function printAdmin(){

        $directory = ($this->IsRoot) ? "" : "../";

        $admin = <<<EOF


        <div class="row" id="admin"style="display:none;" >
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <div class="card">
            <div class="card-header text-white bg-dark"><h3 class="text-center">Administrador</h3></div>
            <div class="card-body">
                    <form id="formAdmin" method="post"  enctype="multipart/form-data">

                        <div class="margen-top-2">
                            <label for="cedulaAdmin" class="form-label">Cedula:</label>
                            <input type="text" class="form-control" id="cedulaAdmin" name="cedulaAdmin">
                        </div>
                        <div class="margen-top-2">
                            <label for="passwordAdmin" class="form-label">Constraseña:</label>
                            <input type="password" class="form-control" id="passwordAdmin" name="passwordAdmin">
                        </div>
                    </form>
                    <br>
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-warning btn-lg"onclick="Registrarse()">Registrarse</button>
                        <button type="submit" class="btn btn-success btn-lg" onclick="ValidarAdmin()">Ingresar</button>
                    </div>

            </div>
        </div>
        </div>
        </div>

EOF;

    echo $admin;

    }
    function printRegistro(){

        $directory = ($this->IsRoot) ? "" : "../";

        $registro = <<<EOF

        <div class="row" id="registrarse"style="display:none;" >
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <div class="card">
            <div class="card-header text-white bg-dark"><h3 class="text-center">Administrador</h3></div>
            <div class="card-body">
            <div class="card-title"> <h3 class="text-center">Complete toda la informacion</h3></div>

                    <form id="formRegistro" method="post" enctype="multipart/form-data">

                        <div class="margen-top-2">
                            <label for="cedulaAdminRegistro" class="form-label">Cedula:</label>
                            <input type="text" class="form-control" id="cedulaAdminRegistro">
                        </div>
                        <div class="margen-top-2">
                            <label for="passwordAdminRegistro" class="form-label">Constraseña:</label>
                            <input type="password" class="form-control" id="passwordAdminRegistro">
                        </div>
                        <div class="margen-top-2">
                            <label for="password2AdminRegistro" class="form-label">Confirmar Constraseña:</label>
                            <input type="password" class="form-control" id="password2AdminRegistro">
                        </div>
                        <div class="margen-top-2">
                            <label for="codigoRegistro" class="form-label">Codigo de Registro:</label>
                            <input type="text" class="form-control" id="codigoRegistro">
                        </div>
                    </form>
                    <br>
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-warning btn-lg"onclick="VolverRegistrarse()">Volver</button>
                        <button type="submit" class="btn btn-success btn-lg" onclick="ValidarRegistroAdmin()">Registrarse</button>
                    </div>

            </div>
    </div>
    </div>
    </div>

EOF;

    echo $registro;

    }

}
