function Eleccion(){
    window.location.href = "../eleccion/eleccion.php"; 

}
function chequearCandidatos(){

    let asd=[];
    
    if(elec==+asd||elec.includes(0)){
        alert("Agrege mas candidatos a los puestos");

    }
    else{
        $('#empezar-eleccion-modal').modal('toggle');
        $('#empezar-eleccion-modal').modal('show');
        $('#empezar-eleccion-modal').modal('hide');
    }
}
