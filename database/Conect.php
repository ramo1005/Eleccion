  
<?php

class Conect{

    public $db;

    public function __construct()
    {

        $this->db = new mysqli("localhost","root","4321","elecion");
                
        if($this->db->connect_error){
            exit('Error connecting to database');
        }


        
    }

}


?>