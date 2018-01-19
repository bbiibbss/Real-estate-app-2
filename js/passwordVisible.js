function passwordVisible($passWordID) {
    var x = document.getElementById($passWordID);
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}