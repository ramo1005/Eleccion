<?php
    require_once 'database/Conect.php';
    require_once 'AdminService.php';

    $conect =new Conect();

    $admin=new AdminService($conect->db);


    if(isset($_GET['user'])&&isset($_GET['password'])){
        $admin->CreateAdmin();
    }

?>