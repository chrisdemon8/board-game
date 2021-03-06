let select = document.getElementById("number");
let choice = select.selectedIndex;
let snackbar = document.getElementById("snackbar");

let currentUsername = document.getElementById("username").value;

let number = select.options[choice].value;
let users;
let playerName = document.getElementById("playerName");


function showSnackBar(time, text, type) {

    snackbar.classList.add(type);

    snackbar.classList.add("show");
    snackbar.textContent = text;
    setTimeout(function() {
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

let listColor = ['rose', 'bleu', 'jaune', 'rouge', 'violet', 'vert'];

function disableOption() {
    options = document.getElementsByTagName("option");
    for (let item of options) {
        item.disabled = false;
    }
    for (const [key, value] of Object.entries(listColorObject)) {
        colorSelected = document.getElementsByTagName("option");


        for (let item of colorSelected) {
            if (item.value == value)
                item.disabled = true;
        }
    }
}

function changeColor(color) {
    listColorObject[color.id] = color.value;
    disableOption();
}

function changeUser(user) {
    listColorObject[user.id] = user.value;
    disableOption();
}

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

        selectColor.setAttribute('name', 'color' + i);


        for (let i = 0; i < listColor.length; i++) {
            let option = document.createElement("option");
            option.value = listColor[i];
            option.text = listColor[i];
            option.classList.add(listColor[i]);
            selectColor.appendChild(option);
        }

        selectColor.id = 'color' + i;
        selectColor.addEventListener(
            'change',
            function() { changeColor(this); },
            false
        );

        //label.htmlFor = 'player' + i;
        label.textContent = 'Joueur ' + i;


        let selectUser = document.createElement("input");
        selectUser.type = 'text';
        selectUser.id = 'username' + i;
        selectUser.addEventListener(
            'change',
            function() { changeUser(this); },
            false
        );




        var myHeaders = new Headers();

        var myInit = {
            method: 'GET',
            headers: myHeaders,
            mode: 'cors',
            cache: 'default'
        };

        fetch("/getUsers", myInit).then(function(response) {

            var contentType = response.headers.get("content-type");
            if (contentType && contentType.indexOf("application/json") !== -1) {
                return response.json().then(function(json) {

                    if (json.status === "success") {
                        //console.log(json.res);
                        dataUsers = json.res;
                        users = json.res;

                        let option = document.createElement("ul");
                        //option.value = "0";
                        //option.text = "Choisir un joueur";
                        //selectUser.appendChild(option);

                        selectUser.addEventListener(
                            'keyup',
                            () => {
                                option.innerHTML = '';
                                dataUsers.forEach(element => {
                                    if (element.username.includes(selectUser.value)) {
                                        li = document.createElement("li");
                                        li.textContent = element.username;
                                        li.addEventListener('click', () => {
                                            selectUser.value = element.username;
                                            option.innerHTML = '';
                                        });
                                        li.style.cursor = 'pointer';
                                        option.append(li);
                                    }
                                });
                                selectUser.after(option);
                                if (selectUser.value == '') {
                                    option.innerHTML = '';
                                }
                            },
                            false
                        );



                        /* for (let i = 0; i < dataUsers.length; i++) {

                             if (dataUsers[i].username != currentUsername) {

                                 let option = document.createElement("option");
                                 option.value = dataUsers[i].username;
                                 option.text = dataUsers[i].username;
                                 option.classList.add(dataUsers[i].username);
                                 selectUser.appendChild(option);

                             }
                         }*/
                    } else {
                        showSnackBar(5000, "Erreur :" + json.exception, "snackerror");
                    }
                });
            } else {
                if (response.ok)
                    response.text().then(function(res) {
                        console.log(res);
                    })
                console.log("Le serveur n'a pas renvoy?? le r??sultat attendu.");
            }
        }).catch(function(error) {
            console.log('Il y a eu un probl??me avec l\'op??ration fetch: ' + error.message);
        });





        let input = document.createElement("input");
        input.type = 'text';
        input.id = 'username' + i;

        div.appendChild(label);
        div.appendChild(selectUser);
        div.appendChild(selectColor);
        playerName.appendChild(div);

        disableOption();
    }
}

let createGameButton = document.getElementById("createGame");
createGameButton.addEventListener("click", submitForm);

let inPlayers = (dataUsers, username) => {
    test = false;
    dataUsers.forEach(user => {
        if (user.username == username)
            test = true;
    })
    return test;
}

let alreadyPlayers = (AlreadyUser, username) => {
    test = false;
    AlreadyUser.forEach(user => {
        if (user == username)
            test = true;
    })
    return test;
}

function submitForm() {


    let selectColor0 = document.getElementById("color0");
    let choice0 = selectColor0.selectedIndex;
    let color0 = selectColor0.options[choice0].value;

    let valid = true;
    let choice = select.selectedIndex;
    let number = select.options[choice].value;

    let jsonPlayer = {};
    jsonPlayer[0] = currentUsername;

    let already = [];

    let jsonColor = {};
    jsonColor[0] = color0;

    for (let i = 1; i <= number; i++) {
        let player = document.getElementById("username" + i);
        let color = document.getElementById("color" + i);
        if (!inPlayers(users, player.value) || alreadyPlayers(already, player.value)) {
            showSnackBar(3000, "Veuillez s??lectionner chaques joueurs correctement.", "snackerror");
            valid = false;
        } else {
            jsonPlayer[i] = player.value;
            already[i] = player.value;
        }

        if (color.value == "0") {
            showSnackBar(3000, "Veuillez s??lectionner chaques couleurs.", "snackerror");
            valid = false;
        } else {
            jsonColor[i] = color.value;
        }

    }



    jsonData = {
        'numberPlayer': number,
        'players': jsonPlayer,
        'colors': jsonColor
    }

    console.log(jsonData);

    if (valid) {


        fetch("/createGame", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    jsonData
                }),
                mode: 'cors',
                cache: 'default'
            }).then(function(response) {

                var contentType = response.headers.get("content-type");
                if (contentType && contentType.indexOf("application/json") !== -1) {

                    /*
                    return response.text().then(function (res) {
                        console.log(res);
                        //window.location.href = "/game?partyId=" + res[partyId];
                    })*/
                    return response.json().then(function(json) {

                        if (json.status === "success") {
                            showSnackBar(3000, "Partie cr????e avec succ??s", "snacksuccess");

                            let conn = new WebSocket('ws://framework.local:8080');

                            console.log(getCookie('PHPSESSID'));
                            console.log(json);

                            conn.onopen = function(e) {
                                console.log("Connection established!");

                                let jsonDataGame = json.res;

                                conn.send(JSON.stringify({
                                    command: "create",
                                    message: JSON.stringify({
                                        jsonDataGame
                                    })
                                }));

                                window.location.href = "/game/" + json.res.partyId;
                            };


                        } else {
                            showSnackBar(3000, "Erreur :" + json.exception, "snackerror");
                        }

                    });
                } else {
                    /*return response.text().then(function (res) {
                        console.log(res);
                    })*/
                    console.log("Le serveur n'a pas renvoy?? le r??sultat attendu.");
                }

            })
            /*.catch(function (error) {
                    console.log('Il y a eu un probl??me avec l\'op??ration fetch: ' + error.message);
                });*/


    }


}


function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}