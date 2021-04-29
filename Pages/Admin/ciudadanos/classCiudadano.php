<?php

    class classCiudadano{
        public $id;
        public $cedula;
        public $nombres;
        public $apellidos;
        public $estado;
        public $fecha_nacimiento;
        public $lugar_nacimiento;
        public $sexo;
        public $estado_civil;
        public $foto;
        public $correo;

        function __construct($id,$cedula,$nombres,$apellidos,$estado,$fecha_nacimiento,$lugar_nacimiento,$sexo,$estado_civil,$foto,$correo){

            $this->id=$id;
            $this->cedula=$cedula;
            $this->nombres=$nombres;
            $this->apellidos=$apellidos;
            $this->estado=$estado;
            $this->fecha_nacimiento=$fecha_nacimiento;
            $this->lugar_nacimiento=$lugar_nacimiento;
            $this->sexo=$sexo;
            $this->estado_civil=$estado_civil;
            $this->foto=$foto;
            $this->correo=$correo;
        }
    }
?>