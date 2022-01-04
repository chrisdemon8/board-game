let currentUsername = document.getElementById("fast").innerText;

let conn = new WebSocket('ws://framework.local:8080');

/*
0	CONNECTING	La socket a été créée. La connexion n'est pas encore ouverte.
1	OPEN	La connexion est ouverte et prête pour la communication.
2	CLOSING	La connexion est en cours de fermeture.
3	CLOSED	La connexion est fermée ou n'a pas pu être ouverte.
*/


let partyId = document.getElementById("partyId").innerHTML.trim();

conn.onopen = function (e) {
    console.log("Connection established!");
    subscribe(partyId);
};


conn.onmessage = function (e) {

    let numberPlayer = document.getElementById("numberPlayer");

    let currentNumberPlayer = document.getElementById("currentNumberPlayer");

    let jsonData = JSON.parse(e.data);

    console.log(jsonData);

    let textNumberPlayer = jsonData["numberPlayer"];
    let textCurrentNumberPlayer = jsonData["currentNumberPlayer"];

    numberPlayer.textContent = textNumberPlayer;
    currentNumberPlayer.textContent = textCurrentNumberPlayer;

    /*
    for (var key in jsonData) {
        console.log(jsonData[key]);
    }*/
};

function subscribe(channel) {
    console.log("join : ", channel)
    conn.send(JSON.stringify({ command: "subscribe", channel: channel }));
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
