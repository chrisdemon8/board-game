let currentUsername = document.getElementById("fast").innerText;

let conn = new WebSocket('ws://framework.local:8080');

let lobby = document.getElementById("lobby");

let board = document.getElementById("board");

let info = document.getElementById("info");

let difficulty = document.getElementById("difficulty");

difficulty.style.display = "none";

let question = document.getElementById("question");

question.style.display = "none";

let difficultyPseudo = document.getElementById("pseudo");

let score = document.getElementById("score");
score.style.display = "none";

let spanCurrentPlayer = document.getElementById("currentPlayer");



let goodButton = document.getElementById("good");
let badButton = document.getElementById("bad");

goodButton.addEventListener("click", () => { evalAnswer(true) });
badButton.addEventListener("click", () => { evalAnswer(false) });

let master = document.getElementById("master");

master.style.display = "none";


let difficulty1 = document.getElementById("1");
let difficulty2 = document.getElementById("2");
let difficulty3 = document.getElementById("3");
let difficulty4 = document.getElementById("4");
let difficulty5 = document.getElementById("5");
let difficulty6 = document.getElementById("6");



let partyId = document.getElementById("partyId").innerHTML.trim();

difficulty1.addEventListener("click", () => { difficultyQuestion(1) });
difficulty2.addEventListener("click", () => { difficultyQuestion(2) });
difficulty3.addEventListener("click", () => { difficultyQuestion(3) });
difficulty4.addEventListener("click", () => { difficultyQuestion(4) });
difficulty5.addEventListener("click", () => { difficultyQuestion(5) });
difficulty6.addEventListener("click", () => { difficultyQuestion(6) });

let listColor = { 'noir': "#00131a", 'bleu': '#4dd2ff', 'jaune': '#ffc107', 'rouge': '#b23c17', 'violet': '#8561c5', 'vert': ' #357a38' };

conn.onopen = function(e) {
    console.log("Connection established!");
    subscribe(partyId);
};


let createGameButton = document.getElementById("lauchGame");
createGameButton.disabled = true;



conn.onmessage = function(e) {

    let webSockeData = JSON.parse(e.data);
    console.log(webSockeData);
    switch (webSockeData["type"]) {
        case "subcription":
            changeLobby(webSockeData);
            break;
        case "question":
            changeBoard(webSockeData);
            break;
        case "next":
            changeBoard(webSockeData);
            break;
        default:
            break;
    }

};

function changeLobby(jsonData) {

    let currentNumberPlayer = document.getElementById("currentNumberPlayer");
    let numberPlayer = document.getElementById("numberPlayer");

    let textNumberPlayer = jsonData["numberPlayer"];
    let textCurrentNumberPlayer = jsonData["currentNumberPlayer"];

    console.log(jsonData);
    let gameObject = jsonData['games'];

    numberPlayer.textContent = textNumberPlayer;
    currentNumberPlayer.textContent = textCurrentNumberPlayer;

    if (textNumberPlayer == textCurrentNumberPlayer) {
        createGameButton.disabled = false;
        createGameButton.addEventListener("click", lauchGame(gameObject));
    }
}


function cleanElement(elementHTML) {
    elementHTML.style.display = "none";
}


function lauchGame(gameObject) {
    cleanElement(lobby);
    createBoard(gameObject);
}


function createBoard(gameObject) {

    console.log(gameObject);
    info.innerHTML = "";
    board.innerHTML = "";


    spanCurrentPlayer.textContent = gameObject["currentPlayer"]["username"];

    score.style.display = "block";

    score.textContent = "";



    divTitle = document.createElement("DIV");

    if (gameObject["Master"]["username"] == currentUsername) {
        pMaster = document.createElement("P");
        pMaster.textContent += "Vous (" + currentUsername + ") êtes le maître du jeu ! ";

        gameObject["players"].forEach(element => {
            pMaster.textContent += "Autre joueurs :" + element["username"] + " ";
        });

        divTitle.appendChild(pMaster);

        if (gameObject["currentQuestion"] != null) {
            difficulty.style.display = "none";
            dataObject = {};
            dataObject["type"] = "question";
            dataObject["games"] = gameObject;
            changeBoard(dataObject);
        }
    } else {
        pPlayer = document.createElement("P");
        pPlayer.textContent = gameObject["Master"]["username"] + " est le maître du jeu.";
        gameObject["players"].forEach(element => {
            if (element["username"] == currentUsername) {
                pPlayer.textContent += " Connecté en tant que : " + currentUsername + ".";
            } else
                pPlayer.textContent += "Autre joueurs :" + element["username"];


            if (typeof gameObject["currentQuestion"] !== 'undefined') {
                difficulty.style.display = "none";
                dataObject = {};
                dataObject["type"] = "question";
                dataObject["games"] = gameObject;
                changeBoard(dataObject);
            }

            if (currentUsername == gameObject["currentPlayer"]["username"]) {

                if (typeof gameObject["currentQuestion"] === 'undefined') {
                    difficulty.style.display = "block";
                    difficultyPseudo.textContent = currentUsername;
                } else
                    console.log("pas de question courante");
            }
        });

        divTitle.appendChild(pPlayer);
    }

    info.appendChild(divTitle);

    let box;
    for (let player = 0; player < gameObject["players"].length; player++) {
        let username = gameObject["players"][player]["username"];
        let colorPlayer = listColor[gameObject["players"][player]["color"]];
        ligne = document.createElement("DIV");
        ligne.classList.add("player");
        for (let i = 0; i < 48; i++) {
            box = document.createElement("DIV");
            box.classList.add("square");
            box.id = username + "&" + i;
            box.style.backgroundColor = colorPlayer;
            ligne.appendChild(box);
        }

        board.appendChild(ligne);
    }

    for (const [key, value] of Object.entries(gameObject["scores"])) {

        score.textContent += key + " : " + value + " / ";
        if (gameObject["Master"]["username"] != key) {
            let boxPosition = document.getElementById(key + "&" + value);
            console.log(key + "&" + value)
            boxPosition.textContent = "LA";
        }
    }
}

function changeBoard(dataObject) {
    let gameObject = dataObject["games"];

    switch (dataObject["type"]) {
        case 'question':
            difficulty.style.display = "none";
            question.style.display = "block";
            question.textContent = gameObject["currentQuestion"]['label_question'];

            if (currentUsername == gameObject["Master"]["username"]) {
                master.style.display = "block";
            }
            break;
        case 'next':
            if (currentUsername == gameObject["currentPlayer"]["username"]) {

                if (typeof gameObject["currentQuestion"] === 'undefined') {
                    difficulty.style.display = "block";
                    difficultyPseudo.textContent = currentUsername;
                } else
                    console.log("pas de question courante");
            }

            score.textContent = "";

            let allBox = document.getElementsByClassName("square");

            for (let box of allBox) {
                box.textContent = "";
            }

            for (const [key, value] of Object.entries(gameObject["scores"])) {

                score.textContent += key + " : " + value + " / ";
                if (gameObject["Master"]["username"] != key) {
                    let boxPosition = document.getElementById(key + "&" + value);
                    console.log(key + "&" + value)
                    boxPosition.textContent = "LA";
                }
            }

            if (currentUsername == gameObject["Master"]["username"]) {
                master.style.display = "none";
            }
            break;
        default:
            break;
    }
}

function difficultyQuestion(level) {
    conn.send(JSON.stringify({ command: "question", channel: partyId, level: level }));
    console.log(level)
}

function evalAnswer(response) {
    conn.send(JSON.stringify({ command: "eval", channel: partyId, response: response }));
    console.log(response)
}




function subscribe(channel) {
    console.log("join : ", channel)
    conn.send(JSON.stringify({ command: "subscribe", channel: channel, username: currentUsername }));
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