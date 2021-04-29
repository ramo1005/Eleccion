<?php
require_once 'layout/layout.php';
require_once 'layout/Menu.php';
require_once 'database/Conect.php';


include 'Eleccion/addAdmin.php';
include 'Eleccion/UserService.php';



    $layout = new Layout(true);
    $menu = new Menu(true);

    $conect =new Conect();
    $checkAdmin= new AdminService($conect->db);

    

?>

<?php echo $layout->printHeader(); ?>

<?php if(isset($_SESSION['admin']['login'])){

    header("Location: Pages/Admin/menu/menu.php");

    

}?>

<?php if(isset($_SESSION['votante']['cedula'])){

    $cedula=$_SESSION['votante']['cedula'];
    session_destroy();
    header("Location: Pages/User/menu/votar.php?cedulaVotante=".$cedula);

}?>
  
    <?php if(empty($_POST['action'])){
        echo $menu->printVotante(); 
        echo $menu->printAdmin(); 
        echo $menu->printRegistro();}?>
    
    <?php if(isset($_POST['cedulaAdmin'])&&isset($_POST['passwordAdmin'])){
        $data=$checkAdmin->CheckAdmin($_POST['cedulaAdmin'],$_POST['passwordAdmin']);

        if($data->num_rows>0){
            $_SESSION['admin']['login']=true;
            
            echo'
            <script type="text/javascript">
                window.location.href = "Pages/Admin/menu/menu.php"; 
            </script>';
        }
        else{
            echo'
            <script type="text/javascript">
                alert("Datos Incorrectos");
            </script>';       
         }
    }
 
    ?>
        <script type="text/javascript">
            var obj = <?php if(!isset($_SESSION['admin']['login'])){
                echo 0;
            }
            else{
                echo'1';
            }; ?>;
        </script>
    </main>


<?php echo $layout->printFooter(); ?>




