var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();
if(dd<10){
    dd='0'+dd
} 
if(mm<10){
    mm='0'+mm
}
var maxDay = yyyy+'-11-30';
var minDay = yyyy+'-'+mm+'-'+(dd+2);
document.getElementById("visitDateInput").setAttribute('max', maxDay);
document.getElementById("visitDateInput").setAttribute('min', minDay);