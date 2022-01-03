let conn = new WebSocket('ws://framework.local:8080',
[],
{
    'headers': {
        'Cookie': getCookie('PHPSESSID')
    }
}); 




let partyId = document.getElementById("partyId").innerHTML.trim();

conn.onopen = function (e) {
    console.log("Connection established!");
    subscribe(partyId);
};

conn.onmessage = function (e) {

    let numberPlayer = document.getElementById("numberPlayer");

    let currentNumberPlayer = document.getElementById("currentNumberPlayer");

    let jsonData = JSON.parse(e.data);

    console.log( jsonData);
    console.log("game" + jsonData["game"]);

    let textNumberPlayer = jsonData["numberPlayer"];
    let textCurrentNumberPlayer = jsonData["currentNumberPlayer"];

    numberPlayer.textContent = textNumberPlayer;
    currentNumberPlayer.textContent = textCurrentNumberPlayer;

    for (var key in jsonData) {
        console.log(jsonData[key]);
    }
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
