let select = document.getElementById("number");
let choice = select.selectedIndex;
let snackbar = document.getElementById("snackbar");

let currentUsername = document.getElementById("username").value;

let number = select.options[choice].value;

let playerName = document.getElementById("playerName");


function showSnackBar(time, text, type) {

    snackbar.classList.add(type);

    snackbar.classList.add("show");
    snackbar.textContent = text;
    setTimeout(function () {
        snackbar.className = snackbar.className.replace("show", "");
        snackbar.className = snackbar.className.replace(type, "");
    }, time);
}




/* TEST PROMESSE STOCKE 
url = "/getUsers";
var myHeaders = new Headers();

var myInit = {
    method: 'GET',
    headers: myHeaders,
    mode: 'cors',
    cache: 'default'
};

async function fetchData() {
    let response = await fetch(url, myInit);
    let data = await response.json();
    data = JSON.stringify(data);
    data = JSON.parse(data);
    return data;
}

let abc = fetchData(); // here the data will be return.

abc.then(function (json) {

    if (json.status === "success") {
        console.log(json);
    } else {
        showSnackBar(5000, "Erreur :" + json.exception, "snackerror");
    }
});
console.log("test", abc); // you are using async await then no need of .then().
*/


let listColorObject = {};

let listUserObject = {};
function disableColor() {
    options = document.getElementsByTagName("option");
    for (let item of options) {
        item.disabled = false;
    }
    for (const [key, value] of Object.entries(listColorObject)) {
        colorSelected = document.getElementsByClassName(value);
        for (let item of colorSelected) {
            item.disabled = true;
        }
    }
}


function disableUser() {
    options = document.getElementsByTagName("option");
    for (let item of options) {
        item.disabled = false;
    }
    for (const [key, value] of Object.entries(listUserObject)) {
        userSelected = document.getElementsByClassName(value);
        for (let item of userSelected) {
            item.disabled = true;
        }
    }
}


function changeColor(color) {
    listColorObject[color.id] = color.value;
    disableColor();
}

function changeUser(user) {
    listColorObject[user.id] = user.value;
    disableColor();
}


let listColor = ['noir', 'bleu', 'jaune', 'rouge', 'violet', 'vert'];

function change(val) {
    playerName.innerHTML = "";
    for (let i = 1; i <= val; i++) {
        let div = document.createElement("DIV");
        let label = document.createElement("label");

        let selectColor = document.createElement("SELECT");


        let option = document.createElement("option");
        option.value = "0";
        option.text = "Choisir une couleur";
        selectColor.appendChild(option);


        for (let i = 0; i < listColor.length; i++) {
            let option = document.createElement("option");
            option.value = listColor[i];
            option.text = listColor[i];
            option.classList.add(listColor[i]);
            selectColor.appendChild(option);
        }
        selectColor.id = 'username' + i;
        selectColor.addEventListener(
            'change',
            function () { changeColor(this); },
            false
        );

        label.htmlFor = 'username' + i;
        label.textContent = 'Joeur ' + i;


        let selectUser = document.createElement("SELECT");
        selectUser.id = 'username' + i;
        selectUser.addEventListener(
            'change',
            function () { changeUser(this); },
            false
        );


        var myHeaders = new Headers();

        var myInit = {
            method: 'GET',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default'
        };

        fetch("/getUsers", myInit).then(function (response) {

            var contentType = response.headers.get("content-type");
            if (contentType && contentType.indexOf("application/json") !== -1) {
                return response.json().then(function (json) {

                    if (json.status === "success") {
                        console.log(json.res);
                        dataUsers = json.res;
                        for (let i = 0; i < dataUsers.length; i++) {

                            if (dataUsers[i].username != currentUsername) {

                                let option = document.createElement("option");
                                option.value = dataUsers[i].username;
                                option.text = dataUsers[i].username;
                                option.classList.add(dataUsers[i].username);
                                selectUser.appendChild(option);

                            }
                        }
                    } else {
                        showSnackBar(5000, "Erreur :" + json.exception, "snackerror");
                    }
                });
            } else {
                if (response.ok)
                    response.text().then(function (res) {
                        console.log(res);
                    })
                console.log("Le serveur n'a pas renvoyé le résultat attendu.");
            }
        }).catch(function (error) {
            console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
        });





        let input = document.createElement("input");
        input.type = 'text';
        input.id = 'username' + i;

        div.appendChild(label);
        div.appendChild(selectUser);
        div.appendChild(selectColor);
        playerName.appendChild(div);

        disableColor();
    }
}