var id;
function Partidos(){
    window.location.href = "../partidos/partidos.php"; 

}
function VolverPartido(){
    document.getElementById("adminPartido").style.display="none";

}
function VolverPartidoToOpcion(){
    window.location.href = "../menu/menu.php"; 
}
function AgregarPartido(){
    document.getElementById("partidos").style.display="none";
    document.getElementById("adminPartido").style.display="none";
    document.getElementById("agregarPartido").style.display="";


}
function EditarPartido(idEdit){
    id=idEdit;
    document.getElementById("partidos").style.display="none";
    document.getElementById("adminPartido").style.display="none";
    document.getElementById("actualizarPartido").style.display="";


}
function EliminarPartido(idDelete,nombre){
    if (confirm("Seguro que desea borrar este partido?")) {
        window.location.href = "partidos.php?id="+idDelete+"&action=borrar&nombre="+nombre+"&pathPhoto="+document.getElementById("imgPartido#"+idDelete).src;           
    }
}
function VolverAgregarPartido(){
    document.getElementById("agregarPartido").style.display="none";
    document.getElementById("adminPartido").style.display="";

    document.getElementById("partidos").style.display="";
}
function VolverActualizarPartido(){
    document.getElementById("actualizarPartido").style.display="none";
    document.getElementById("adminPartido").style.display="";

    document.getElementById("partidos").style.display="";
}
function ValidarPartido(){
    
    var nombre= document.getElementById("nombre");
    var estado= document.getElementById("estado");
    var descripcion= document.getElementById("descripcion");
    var logoPartido= document.getElementById("logoPartido");

    if(nombre.value== "" || nombre.value  == null || nombre.value  == undefined||
        logoPartido.value == "" || logoPartido.value == null || logoPartido.value == undefined||
        descripcion.value == "" || descripcion.value  == null || descripcion.value == undefined)
    {
        alert("Rellene todos los campos");

    }
    else{
        document.forms['formPartido'].submit(); 

    }
}
function ValidarActualizarPartido(){

    var nombre= document.getElementById("nombreAct");
    var estado= document.getElementById("estadoAct");
    var descripcion= document.getElementById("descripcionAct");
    var logoPartido= document.getElementById("logoPartidoAct");
    document.getElementById("idPartido").value=id;

    if(nombre.value== "" || nombre.value  == null || nombre.value  == undefined||
        logoPartido.value == "" || logoPartido.value == null || logoPartido.value == undefined||
        descripcion.value == "" || descripcion.value  == null || descripcion.value == undefined)
    {
        alert("Rellene todos los campos");

    }
    else{
        document.forms['formActualizarPartido'].submit(); 
    }
}