<?php

    class classCandidato{
        public $id;
        public $cedula;
        public $nombres;
        public $apellidos;
        public $estado;
        public $partido;
        public $puesto;
        public $foto;

        function __construct($id,$cedula,$nombres,$apellidos,$estado,$partido,$puesto,$foto){

            $this->id=$id;
            $this->cedula=$cedula;
            $this->nombres=$nombres;
            $this->apellidos=$apellidos;
            $this->estado=$estado;
            $this->partido=$partido;
            $this->puesto=$puesto;
            $this->foto=$foto;
        }
    }
?>