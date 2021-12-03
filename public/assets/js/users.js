const buttonDelete = document.querySelectorAll('.delete');
const buttonModify = document.querySelectorAll('.modify');


buttonDelete.forEach(el => el.addEventListener('click', event => {

    let id_user = event.target.id;

    fetch("/deleteUser", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
            },
            body: `id_user=${id_user}`,
        })
        .then((response) => response.text())
        .then((res) => location.reload());
}));

buttonModify.forEach(el => el.addEventListener('click', event => {

    let id_user = event.target.id;

    let tr = document.getElementById(event.target.id);

    event.target.style.display = 'none';


    var children = tr.children;

    for (let i = 1; i < children.length - 3; i++) {

        var x = document.createElement("INPUT");
        x.setAttribute("type", "text");
        x.setAttribute("value", children[i].innerHTML);
        children[i].innerHTML = "";
        children[i].appendChild(x);
    }

    function cancelAction() {
        event.target.style.display = "inline";

        fetch("/GetUser", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                },
                body: `id_user=${id_user}`,
            })
            .then((response) => response.text())
            .then((res) => {
                res = JSON.parse(res);
                for (let i = 0; i < children.length - 3; i++) {

                    /*        console.log(children[i].id);
                           console.log((res));

                           console.log(res[children[i].id]); */
                    let dataText
                    if (children[i].id == "createdAt")
                        dataText = res[children[i].id].date;
                    else
                        dataText = res[children[i].id];

                    children[i].innerHTML = dataText;
                }

            });


    }

    function validAction() {
        event.target.style.display = "inline";

        let jsonData = {};

        for (let i = 0; i < children.length - 3; i++) {
            jsonData[children[i].id] = children[i].children[0].value;
        }

        jsonData["id_user"] = id_user; 
        jsonData = JSON.stringify(jsonData);

        console.log(jsonData);
        fetch("/updateUser", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                },
                body: `jsonData=${jsonData}`,
            })
            .then((response) => response.text())
            .then((res) => location.reload());
        /*location.reload()*/

    }

    let buttonCancel = document.createElement("BUTTON");
    buttonCancel.innerHTML = "X";
    buttonCancel.addEventListener('click', eventCancel => {
        eventCancel.target.style.display = 'none';
        buttonValid.style.display = 'none';
        cancelAction();

    });

    let buttonValid = document.createElement("BUTTON");
    buttonValid.innerHTML = "YES";
    buttonValid.addEventListener('click', eventValid => {
        eventValid.target.style.display = 'none';
        buttonCancel.style.display = 'none';
        validAction();

    });



    children[children.length - 2].appendChild(buttonCancel);
    children[children.length - 2].appendChild(buttonValid);



}));