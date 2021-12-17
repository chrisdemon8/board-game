let emailField = document.getElementById("email");
let usernameField = document.getElementById("username");
let firstNameField = document.getElementById("firstname");
let lastNameField = document.getElementById("lastname");

let passwordField = document.getElementById("password");
let passwordFieldBis = document.getElementById("passwordBis");
let registerButton = document.getElementById("register");



passwordField.addEventListener("keyup", changeInput);

passwordFieldBis.addEventListener("keyup", changeInput);

function changeInput(evt) {

    if (evt.currentTarget.id === "passwordBis" || evt.currentTarget.id === "password") {
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
 

    if (password === passwordBis) {

        fetch("addUser", {
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
                                let helperText = emailField.nextElementSibling;
                                console.log(helperText);
                                helperText.textContent = "Email déjà utilisé";
                                helperText.style.display = 'block';
                            } else if (res.includes("INVALID_MAIL")) {
                                let helperText = emailField.nextElementSibling; 
                                helperText.textContent = "Email non conforme";
                                helperText.style.display = 'block';
                            } else {
                                let helperText = emailField.nextElementSibling;
                                helperText.style.display = 'none';
                            }


                            if (res.includes("ERROR_USERNAME")) { 
                                let helperText = usernameField.nextElementSibling;
                                helperText.textContent = "Pseudo déjà utilisé";
                                helperText.style.display = 'block';
                            } else {
                                let helperText = usernameField.nextElementSibling;
                                helperText.style.display = 'none';
                            }

                            if (res.includes("INVALID_FIRST_NAME")) {
                                let helperText = firstNameField.nextElementSibling;
                                helperText.textContent = "Format du prénom : uniquement des lettres";
                                helperText.style.display = 'block';
                            } else {
                                let helperText = firstNameField.nextElementSibling;
                                helperText.style.display = 'none';
                            }

                            if (res.includes("INVALID_LASTNAME")) {
                                let helperText = firstNameField.nextElementSibling;
                                helperText.textContent = "Format du nom de famille : uniquement des lettres";
                                helperText.style.display = 'block';
                            } else {
                                let helperText = firstNameField.nextElementSibling;
                                helperText.style.display = 'none';
                            }
                        }
                    })
            })
            .catch(function (error) {
                console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
            });

    } else {
        let helperText = passwordFieldBis.nextElementSibling;
        helperText.style.display = 'block';
    }

}