let currentUsername = document.getElementById("fast").innerText;

let conn = new WebSocket('ws://framework.local:8080');

let lobby = document.getElementById("lobby");

let board = document.getElementById("board");

let boardStatus = document.getElementById("boardStatus");

let scoreboard = document.getElementById("scoreboard");

let info = document.getElementById("info");

let difficulty = document.getElementById("difficulty");

let roundPlayer = document.getElementById("roundPlayer");

let answerForPlayer = document.getElementById("answerForPlayer");
answerForPlayer.style.display = "none";

roundPlayer.style.display = "none";

difficulty.style.display = "none";

let question = document.getElementById("question");

question.style.display = "none";

let possibleAnswer = document.getElementById("possibleAnswer");

possibleAnswer.style.display = "none";

let answer = document.getElementById("answer");

let difficultyPseudo = document.getElementById("pseudo");

let score = document.getElementById("score");
score.style.display = "none";

let spanCurrentPlayer = document.getElementById("currentPlayer");



let goodButton = document.getElementById("good");
let badButton = document.getElementById("bad");
let showAnswer = document.getElementById("showAnswer");

showAnswer.addEventListener("click", () => { showAnswerFunction() });

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
        case "showAnswer":
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

    info.innerHTML = "";
    board.innerHTML = "";
    roundPlayer.style.display = "block";

    spanCurrentPlayer.textContent = gameObject["currentPlayer"]["username"];

    score.style.display = "block";

    score.textContent = "";


    if (gameObject["winners"].length > 0) {
        console.log("Le gagnant est : " + gameObject["winners"][0]["username"]);
    }


    divTitle = document.createElement("DIV");

    if (gameObject["Master"]["username"] == currentUsername) {

        // ajout du master
        let divMaster = document.createElement("DIV");
        divMaster.classList.add("circle");

        let pMaster = document.createElement("P");
        pMaster.classList.add("circle-inner");

        pMaster.textContent = currentUsername.substring(0, 2);

        divMaster.style.backgroundColor = "blue";
        divMaster.style.border = "6px solid red";
        divMaster.id = "divMaster";
        divMaster.appendChild(pMaster);
        divTitle.appendChild(divMaster);

        // Ajout des joueurs
        gameObject["players"].forEach(element => {
            let divPlayer = document.createElement("DIV");
            divPlayer.classList.add("circle");
            divPlayer.style.backgroundColor = "grey";
            divPlayer.id = element["username"];
            let pPlayer = document.createElement("P");
            pPlayer.classList.add("circle-inner");
            pPlayer.textContent = element["username"].substring(0, 2);

            if (gameObject["currentPlayer"]["username"] == element["username"]) {
                divPlayer.style.border = "6px solid #58a700";
            } else {
                divPlayer.style.border = "";
            }

            divPlayer.appendChild(pPlayer);
            divTitle.appendChild(divPlayer);
        });

        if (gameObject["currentQuestion"] != null) {
            difficulty.style.display = "none";
            dataObject = {};
            dataObject["type"] = "question";
            dataObject["games"] = gameObject;
            changeBoard(dataObject);
        }
    } else {


        // ajout du master
        let divMaster = document.createElement("DIV");
        divMaster.classList.add("circle");

        let pMaster = document.createElement("P");
        pMaster.classList.add("circle-inner");

        pMaster.textContent = gameObject["Master"]["username"].substring(0, 2);
        divMaster.style.backgroundColor = "grey";
        divMaster.style.border = "6px solid red";
        divMaster.id = "divMaster";
        divMaster.appendChild(pMaster);
        divTitle.appendChild(divMaster);



        gameObject["players"].forEach(element => {

            // ajout joueurs interface
            let divPlayer = document.createElement("DIV");
            divPlayer.classList.add("circle");
            divPlayer.id = element["username"];

            let pPlayer = document.createElement("P");
            pPlayer.classList.add("circle-inner");



            if (element["username"] == currentUsername) {
                pPlayer.textContent = currentUsername.substring(0, 2);
                divPlayer.style.backgroundColor = "blue";
            } else {
                pPlayer.textContent = element["username"].substring(0, 2);
                divPlayer.style.backgroundColor = "grey";
            }

            if (gameObject["currentPlayer"]["username"] == element["username"]) {
                divPlayer.style.border = "6px solid #58a700";
            } else {
                divPlayer.style.border = "";
            }

            divPlayer.appendChild(pPlayer);
            divTitle.appendChild(divPlayer);
            // fin ajout

            //chargement de la partie 

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

    scoreboard.innerHTML = "";
    for (const [key, value] of Object.entries(gameObject["scores"])) {

        let scoreDiv = document.createElement("DIV");
        scoreDiv.classList.add("scoreboard");


        let playerP = document.createElement("P");
        playerP.textContent = key;
        let scoreP = document.createElement("P");
        scoreP.textContent = value;

        scoreDiv.appendChild(playerP);
        scoreDiv.appendChild(scoreP);

        scoreboard.appendChild(scoreDiv);


        score.textContent += key + " : " + value + " / ";


        if (gameObject["Master"]["username"] != key) {
            let boxPosition = document.getElementById(key + "&" + value);
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

                answer.textContent = "Réponse(s) : ";
                gameObject["currentQuestion"]['answers'].forEach(element => {
                    answer.textContent += element["label_answer"] + " / ";
                });

            }

            console.log(gameObject["currentQuestion"]['answers'].length);

            if (gameObject["currentQuestion"]['answers'].length > 1) {

                possibleAnswer.style.display = "block";
                possibleAnswer.textContent = "Réponse possible : ";
                gameObject["currentQuestion"]['answers'].forEach(element => {
                    possibleAnswer.textContent += element["label_answer"] + " / ";
                });
            }
            break;
        case 'showAnswer':
            console.log("ici");
            if (currentUsername != gameObject["Master"]["username"]) {

                answerForPlayer.style.display = "block";
                answerForPlayer.textContent = "Réponse : ";
                gameObject["currentQuestion"]['answers'].forEach(element => {
                    if (element["valid"])
                        answerForPlayer.textContent += element["label_answer"];
                });
            }
            break;
        case 'next':

            if (gameObject["winners"].length == 0) {
                if (currentUsername == gameObject["currentPlayer"]["username"]) {

                    if (typeof gameObject["currentQuestion"] === 'undefined') {
                        difficulty.style.display = "block";
                        difficultyPseudo.textContent = currentUsername;
                    } else
                        console.log("pas de question courante");
                }

                score.textContent = "";

                let allBox = document.getElementsByClassName("square");

                let allProfilPlayer = document.getElementsByClassName("circle");

                for (let profil of allProfilPlayer) {
                    profil.style.border = "";
                }


                let boxMaster = document.getElementById("divMaster");
                boxMaster.style.border = "6px solid red";

                let currentBox = document.getElementById(gameObject["currentPlayer"]["username"]);
                currentBox.style.border = "6px solid #58a700";

                for (let box of allBox) {
                    box.textContent = "";
                }

                scoreboard.innerHTML = "";
                for (const [key, value] of Object.entries(gameObject["scores"])) {

                    let scoreDiv = document.createElement("DIV");
                    scoreDiv.classList.add("scoreboard");


                    let playerP = document.createElement("P");
                    playerP.textContent = key;
                    let scoreP = document.createElement("P");
                    scoreP.textContent = value;

                    scoreDiv.appendChild(playerP);
                    scoreDiv.appendChild(scoreP);

                    scoreboard.appendChild(scoreDiv);

                    score.textContent += key + " : " + value + " / ";
                    if (gameObject["Master"]["username"] != key) {
                        let boxPosition = document.getElementById(key + "&" + value);
                        boxPosition.textContent = "LA";
                    }
                }

                if (currentUsername == gameObject["Master"]["username"]) {
                    master.style.display = "none";
                }
            } else {
                console.log(gameObject)
                boardStatus.innerHTML = "";

                boardStatus.textContent = "Le gagnant est : " + gameObject["winners"][0];
                console.log("Il y a un gagnant");
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

function showAnswerFunction() {
    conn.send(JSON.stringify({ command: "showAnswer", channel: partyId }));
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