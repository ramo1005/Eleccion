const requestURL = 'http://api.adamix.net/apec/cedula/';
const request = new XMLHttpRequest();

var c;
var cedulaRegistro;
var cedulaAdmin;
var estadoDeLaCedula;



//cambios de ventanas
function Registrarse(){
    GetInfoAdmin();
    cedula.value='';
    passwordAdmin.value='';
    document.getElementById('admin').style.display="none";
    document.getElementById('registrarse').style.display="";
    

}

function VolverRegistrarse(){
    document.getElementById('registrarse').style.display="none";
    document.getElementById('admin').style.display="";
}
function VolverAdminPanel(){
    document.getElementById('btn-admin').style.display="";
    document.getElementById("btn-admin-volver").style.display="none";

    document.getElementById('login').style.display="";
    document.getElementById('admin').style.display="none";
}

function AdminPanel(){

    history.pushState(null, '', 'index.php');

    if(obj==1){
        window.location.href = "Pages/Admin/menu/menu.php"; 

    }
    else{
        document.getElementById('btn-admin').style.display="none";
        document.getElementById("btn-admin-volver").style.display="";

        document.getElementById('login').style.display="none";
        document.getElementById('admin').style.display="";
    }

}


//Limpiar campos
function LimpiarVotante(){
    GetInfo();
    cedula.value='';

}
function SalirSession(){
    window.location.href = "closeAdminSession.php";
}


//Validaciones
function ValidarRegistroAdmin(){
    
    GetInfoAdminRegistro();


    if(cedulaRegistro.value == "" || cedulaRegistro.value  == null || cedulaRegistro.value  == undefined||
    passwordAdminRegistro.value == "" || passwordAdminRegistro.value  == null || passwordAdminRegistro.value  == undefined||
    password2AdminRegistro.value == "" || password2AdminRegistro.value  == null || password2AdminRegistro.value  == undefined||
    codigoRegistro.value == "" || codigoRegistro.value  == null || codigoRegistro.value  == undefined){
        alert("Rellene todos los campos")
    }
    else{
        if(passwordAdminRegistro.value == password2AdminRegistro.value){
            if(codigoRegistro.value == "1234" ){

                window.location.href = "index.php" + "?user=" + c + "&password=" + passwordAdminRegistro.value;       
            
            }
            else{
                alert("Codigo de registro incorrecto");
            }
        }
        else{
            alert("Las contraseña no coinciden");
        }
    }

}
function ValidarAdmin(){
    GetInfoAdmin();

    if(cedulaAdmin.value == "" || cedulaAdmin.value  == null || cedulaAdmin.value  == undefined||
    passwordAdmin.value == "" || passwordAdmin.value  == null || passwordAdmin.value  == undefined){
        alert("Rellene todo los campos");
    }
    else{
        document.forms['formAdmin'].submit(); 
        
    }
}
function ValidarVotante(){
    GetInfo();

    if(cedula.value == "" || cedula.value  == null || cedula.value  == undefined){
        alert("Rellene todo los campos")
    }
    else{
        window.location.href = "index.php" + "?cedula=" + c;

    }
}

//chequeo de datos
function checkCedula(c){

    let url=requestURL+c;

    request.open('GET', url);
    request.responseType = 'json';
    request.send();
    request.onload = function() {
        var data = request.response;
        if (!data['ok']){
            alert("Cedula Invalida")
        }
      }

}

//Get infos
function GetInfo(){
    var cedula=document.getElementById('cedula');
    c=cedula.value.split('-').join('');
}



function GetInfoAdmin(){
    cedulaAdmin=document.getElementById('cedulaAdmin');
    var passwordAdmin=document.getElementById('passwordAdmin');
    c=cedula.value.split('-').join('');

}
function GetInfoAdminRegistro(){
    cedulaRegistro=document.getElementById('cedulaAdminRegistro');
    var passwordAdminRegistro=document.getElementById('passwordAdminRegistro');
    var password2AdminRegistro=document.getElementById('password2AdminRegistro');
    var codigoRegistro=document.getElementById('codigoRegistro');
    c=cedulaRegistro.value.split('-').join('');

}