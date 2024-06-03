function showPassword(element) {
    var x = document.getElementsByName(element)[0];
    var y = document.getElementById(element);

    if (x) {
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    } else if (y) {
        if (y.type === "password") {
            y.type = "text";
        } else {
            y.type = "password";
        }
    }
}
