function openModal(modalName){
    var modal = document.getElementById(''+modalName+'');
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }else if (event.target != modal){
            modal.style.display="block";
        }
    }
}
