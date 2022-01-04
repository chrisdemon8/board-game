let currentUsername = document.getElementById("fast").innerText;

let conn = new WebSocket('ws://framework.local:8080');

let lobby = document.getElementById("lobby");

let board = document.getElementById("board");

let partyId = document.getElementById("partyId").innerHTML.trim();

conn.onopen = function (e) {
    console.log("Connection established!");
    subscribe(partyId);
};


let createGameButton = document.getElementById("lauchGame");
createGameButton.disabled = true;


conn.onmessage = function (e) {

    let webSockeData = JSON.parse(e.data);



    switch (webSockeData["type"]) {
        case "subcription":
            changeLobby(webSockeData);
            break;
        default:
            break;
    }

};



function changeLobby(jsonData) {
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
    elementHTML.innerHTML = "";
}


function lauchGame(gameObject) {
    cleanElement(lobby);
    createBoard(gameObject);
}


function createBoard(gameObject) {
    let box;

    for (let player = 0; player < gameObject["players"].length; player++) {
        ligne = document.createElement("DIV");

        for (let i = 0; i < 40; i++) {
            box = document.createElement("DIV");
            box.classList.add("square");
            ligne.appendChild(box);
        }

        board.appendChild(ligne);
    }
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
