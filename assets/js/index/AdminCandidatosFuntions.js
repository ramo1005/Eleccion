

var id;
var c;

function Candidatos(){
    window.location.href = "../candidatos/candidato.php"; 

}
function VolverCandidato(){
    document.getElementById("adminCandidato").style.display="none";

}
function VolverCandidatoToOpcion(){
    window.location.href = "../menu/menu.php"; 

}
function VolverInfoCandidato(){
    close();


}
function AgregarCandidato(){
    document.getElementById("candidatos").style.display="none";
    document.getElementById("adminCandidato").style.display="none";
    document.getElementById("agregarCandidato").style.display="";


}
function EditarCandidato(idEdit){
    id=idEdit;
    document.getElementById("candidatos").style.display="none";
    document.getElementById("adminCandidato").style.display="none";
    document.getElementById("actualizarCandidato").style.display="";


}
function InfoCandidato(idInfo){
    id=idInfo;

    window.open("candidato.php?idInfo="+idInfo+"&action=info", '_blank').focus();

}
function EliminarCandidato(idDelete){
    if (confirm("Seguro que desea borrar este ciudadano?")) {
        window.location.href = "candidato.php?idDelete="+idDelete+"&action=borrar";           
    }
}
function VolverAgregarCandidato(){
    document.getElementById("agregarCandidato").style.display="none";
    document.getElementById("adminCandidato").style.display="";

    document.getElementById("candidatos").style.display="";
}
function VolverActualizarCandidato(){
    document.getElementById("actualizarCandidato").style.display="none";
    document.getElementById("adminCandidato").style.display="";

    document.getElementById("candidatos").style.display="";
}
function ValidarCandidato(){
    
    var cedula= document.getElementById("cedula");
    var partido= document.getElementById("partido");
    var puesto= document.getElementById("puesto");

    var estado= document.getElementById("estado");

    c=cedula.value.split('-').join('');


    if( cedula.value  == null ||cedula.value== "" || cedula.value  == undefined||
    partido.value == "Seleccione una opcion:" ||puesto.value == "Seleccione una opcion:"||
    estado.value == "" || estado.value == null || estado.value == undefined)
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
                let url ="candidato.php?cedula="+data['Cedula']+"&nombres="+data['Nombres']+"&apellidos="+data['Apellido1']+" "+data['Apellido2']+
                '&estado='+estado.value+'&partido='+partido.value+'&puesto='+puesto.value+"&foto="+data['foto'];

                window.location.href = url.replace('%',' ');
            }
        }
    }
}
function ValidarActualizarCandidato(){

    cedula= document.getElementById("cedulaAct");
    partido= document.getElementById("partidoAct");
    puesto= document.getElementById("puestoAct");

    estado= document.getElementById("estadoAct");

    c=cedula.value.split('-').join('');


    if( cedula.value  == null ||cedula.value== "" || cedula.value  == undefined||
    partido.value == "Seleccione una opcion:" ||puesto.value == "Seleccione una opcion:"||
    estado.value == "" || estado.value == null || estado.value == undefined)
    {
        console.log(cedula.value)
        console.log(partido.value)
        console.log(estado.value)
        console.log(puesto.value)

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
                let url ="candidato.php?idAct="+id+"&cedulaAct="+data['Cedula']+"&nombresAct="+data['Nombres']+"&apellidosAct="+data['Apellido1']+" "+data['Apellido2']+
                '&estadoAct='+estado.value+'&partidoAct='+partido.value+'&puestoAct='+puesto.value+"&fotoAct="+data['foto'];

                window.location.href = url.replace('%',' ');
            }
        }
    }
}