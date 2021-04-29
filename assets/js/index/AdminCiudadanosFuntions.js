
var id;
var c;

function Ciudadanos(){
    document.getElementById("adminOpcion").style.display="none";
    window.location.href = "../ciudadanos/ciudadano.php"; 

}
function VolverCiudadano(){
    document.getElementById("adminCiudadano").style.display="none";

}
function VolverCiudadanoToOpcion(){
    window.location.href = "../menu/menu.php"; 
}
function VolverInfoCiudadano(){
    window.location.href = "ciudadano.php";


}
function AgregarCiudadano(){
    document.getElementById("ciudadanos").style.display="none";
    document.getElementById("adminCiudadano").style.display="none";
    document.getElementById("agregarCiudadano").style.display="";


}
function EditarCiudadano(idEdit){
    id=idEdit;
    document.getElementById("ciudadanos").style.display="none";
    document.getElementById("adminCiudadano").style.display="none";
    document.getElementById("actualizarCiudadano").style.display="";


}
function InfoCiudadano(idInfo){
    id=idInfo;

    window.location.href = "ciudadano.php?idInfo="+id+"&action=info";

}
function EliminarCiudadano(idDelete){
    if (confirm("Seguro que desea borrar este ciudadano?")) {
        window.location.href = "ciudadano.php?idDelete="+idDelete+"&action=borrar";           
    }
}
function VolverAgregarCiudadano(){
    document.getElementById("agregarCiudadano").style.display="none";
    document.getElementById("adminCiudadano").style.display="";

    document.getElementById("ciudadanos").style.display="";
}
function VolverActualizarCiudadano(){
    document.getElementById("actualizarCiudadano").style.display="none";
    document.getElementById("adminCiudadano").style.display="";

    document.getElementById("ciudadanos").style.display="";
}
function ValidarCiudadano(){
    
    var cedula= document.getElementById("cedula");
    var estado= document.getElementById("estado");
    var correo= document.getElementById("correo");

    c=cedula.value.split('-').join('');


    if( cedula.value  == null ||cedula.value== "" || cedula.value  == undefined||
    estado.value == "" || estado.value == null || estado.value == undefined||
    correo.value == "" || correo.value  == null || correo.value == undefined)
    {
        alert("Rellene todos los campos");

    }
    else{
        let url=requestURL+c;

        request.open('GET', url);
        request.responseType = 'json';
        request.send();
        request.onload = function() {
            var data = request.response;
            if (!data['ok']){
                alert('Cedula Invalida');
            }
            else{
                let url ="ciudadano.php?cedula="+data['Cedula']+"&nombres="+data['Nombres']+"&apellidos="+data['Apellido1']+" "+data['Apellido2']+
                '&estado='+estado.value+'&fecha_nacimiento='+data['FechaNacimiento']+'&lugar_nacimiento='+data['LugarNacimiento']+'&sexo='+data['IdSexo']+
                "&estado_civil="+data['IdEstadoCivil']+"&foto="+data['foto']+"&correo="+correo.value;

                window.location.href = url.replace('%',' ');
            }
        }
    }
}
function ValidarActualizarCiudadano(){

    cedula= document.getElementById("cedulaAct");
    estado= document.getElementById("estadoAct");
    correo= document.getElementById("correoAct");

    c=cedula.value.split('-').join('');


    if(cedula.value== "" || cedula.value  == null || cedula.value  == undefined||
    estado.value == "" || estado.value == null || estado.value == undefined||
    correo.value == "" || correo.value  == null || correo.value == undefined)
    {
        alert("Rellene todos los campos");

    }
    else{
        let url=requestURL+c;

        request.open('GET', url);
        request.responseType = 'json';
        request.send();
        request.onload = function() {
            var data = request.response;
            if (!data['ok']){
                alert('Cedula Invalida');
            }
            else{
                let url ="ciudadano.php?idAct="+id+"&cedulaAct="+data['Cedula']+"&nombresAct="+data['Nombres']+"&apellidosAct="+data['Apellido1']+" "+data['Apellido2']+
                '&estadoAct='+estado.value+'&fecha_nacimientoAct='+data['FechaNacimiento']+'&lugar_nacimientoAct='+data['LugarNacimiento']+'&sexoAct='+data['IdSexo']+
                "&estado_civilAct="+data['IdEstadoCivil']+"&fotoAct="+data['foto']+"&correoAct="+correo.value;

                window.location.href = url.replace('%',' ');
            }
        }
    }
}