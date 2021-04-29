
var botonTohide;

function verCandidatosVotar(id,puestoElectivo){
    botonTohide=puestoElectivo;
    obj2.forEach(element => {
        document.getElementById(element).style.display="none";
        
    });  
    document.getElementById("end").style.display="none";

    document.getElementById(obj[id]).style.display="";

    document.getElementById("back").style.display="";


    document.getElementById("tituloPuesto").innerHTML=obj2[id];

}
function VolverPuestosVotar(){
    document.getElementById("back").style.display="none";
    document.getElementById("end").style.display="";
    document.getElementById("tituloPuesto").innerHTML="Puestos Electivos";

    obj.forEach(element => {
        document.getElementById(element).style.display="none";

    });
    obj2.forEach(element => {
        document.getElementById(element).style.display="";
        
    }); 





}
function InfoVotarCandidato(idInfo){
    
    window.open("http://localhost/Eleccion/Pages/Admin/candidatos/candidato.php?idInfo="+idInfo+"&action=info", '_blank').focus();
    
    
}
function ActivarBotonVotar(id){
    document.getElementById('boton'+id).disabled =!document.getElementById('boton'+id).disabled;
}

function VotarUserCandidato(idCandidato,idTable){
    if(idCandidato==="Ninguno"){
        $.ajax({
            url: 'http://localhost/Eleccion/Pages/User/menu/subirVotos.php',
            type: 'POST',
            data: {
                'cedulaVotante':window.location.href.replace('http://localhost/Eleccion/Pages/User/menu/votar.php?cedulaVotante=',''),
                'idCandidato': idCandidato,
                'table': "voto_"+idTable.toLowerCase()
            },

        });
        document.getElementById(botonTohide).disabled=true;
        VolverPuestosVotar();
    }
    else{
        $.ajax({
            url: 'http://localhost/Eleccion/Pages/User/menu/subirVotos.php',
            type: 'POST',
            data: {
                'cedulaVotante':window.location.href.replace('http://localhost/Eleccion/Pages/User/menu/votar.php?cedulaVotante=',''),
                'idCandidato': idCandidato.replace('boton',''),
                'table': idTable.toLowerCase()
            },             
        });
        document.getElementById(botonTohide).disabled=true;
        VolverPuestosVotar();
    }


}
function SalirVotar(){
    $.ajax({
        url: 'http://localhost/Eleccion/Pages/User/menu/subirVotos.php',
        type: 'POST',
        data: {
            'cedulaVotante':window.location.href.replace('http://localhost/Eleccion/Pages/User/menu/votar.php?cedulaVotante=',''),
            'estado': "1"
        }           
    });
    $.ajax({
        url: 'http://localhost/Eleccion/Pages/sendEmail.php',
        type: 'POST',
        data: {
            'cedulaVotante':window.location.href.replace('http://localhost/Eleccion/Pages/User/menu/votar.php?cedulaVotante=','')
        }          
    });
    alert("Proceso terminado.\nSe le enviara por correo el resultado de su eleccion");    
    window.location.href ="http://localhost/Eleccion/index.php";
    

}