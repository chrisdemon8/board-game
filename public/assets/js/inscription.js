let emailField = document.getElementById("email");
let usernameField = document.getElementById("username");
let firstNameField = document.getElementById("firstname");
let lastNameField = document.getElementById("lastname");

let passwordField = document.getElementById("password");
let passwordFieldBis = document.getElementById("passwordBis");
let registerButton = document.getElementById("register");


passwordFieldBis.addEventListener("keyup", changeInput);

function changeInput(evt) {

    if (evt.currentTarget.id === "passwordBis") {
        let password = passwordField.value;
        let passwordBis = passwordFieldBis.value;
        let helperText = passwordFieldBis.nextElementSibling;
        if (passwordBis !== password) {
            helperText.style.display = 'block';
        } else {
            helperText.style.display = 'none';
        }
    }

}

registerButton.addEventListener("click", submitForm);

function submitForm() {

    let email = emailField.value;
    let username = usernameField.value;
    let firstname = firstNameField.value;
    let lastname = lastNameField.value;

    let password = passwordField.value;
    let passwordBis = passwordFieldBis.value;

    jsonData = {
        'username': username,
        'lastname': lastname,
        'firstname': firstname,
        'email': email,
        'password': password
    }

    console.log('test', jsonData);


    fetch("AddUser", {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                jsonData
            }),
            mode: 'cors',
            cache: 'default'
        }).then(function (response) {

            if (response.ok)
                response.text().then(function (res) {
                    if (res === 1)
                        window.location.href = "/connexion";
                    else {
                        console.log(res);
                        if (res.includes("ERROR_MAIL")) {
                            console.log("ERROR_MAIL");
                            let helperText = emailField.nextElementSibling;
                            console.log(helperText);
                            helperText.textContent = "Email déjà utilisé";
                            helperText.style.display = 'block';
                        } else if (res.includes("INVALID_MAIL")) {
                            let helperText = emailField.nextElementSibling;
                            console.log(helperText);
                            helperText.textContent = "Email non conforme";
                            helperText.style.display = 'block';
                        } else {
                            let helperText = emailField.nextElementSibling;
                            helperText.style.display = 'none';
                        }


                        if (res.includes("ERROR_USERNAME")) {
                            console.log("ERROR_USERNAME");
                            let helperText = usernameField.nextElementSibling;
                            helperText.textContent = "Pseudo déjà utilisé";
                            helperText.style.display = 'block';
                        } else {
                            let helperText = usernameField.nextElementSibling;
                            helperText.style.display = 'none';
                        }
                    }
                })
        })
        .catch(function (error) {
            console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
        });

}