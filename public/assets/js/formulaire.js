function checkChangePassword() {
    var checkBox = document.getElementById("changePassword");

    var fieldChangePassword = document.getElementById("changePasswordArea");

    if (checkBox.checked == true) {
        fieldChangePassword.style.display = "block";
    } else {
        fieldChangePassword.style.display = "none";
    }
}