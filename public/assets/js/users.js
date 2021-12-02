const buttonDelete = document.querySelectorAll('.delete');


const buttonModify = document.querySelectorAll('.modify');


buttonDelete.forEach(el => el.addEventListener('click', event => {

    let idUser = event.target.id;

    fetch("/deleteUser", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
            },
            body: `idUser=${idUser}`,
        })
        .then((response) => response.text())
        .then((res) => location.reload());
}));

buttonModify.forEach(el => el.addEventListener('click', event => {

    let tr = document.getElementById(event.target.id);


    event.target.style.display = 'none';


    var children = tr.children;
    for (let i = 0; i < children.length - 2; i++) {
        console.log(children[i].innerHTML);


        var x = document.createElement("INPUT");
        x.setAttribute("type", "text");
        x.setAttribute("value", children[i].innerHTML);
        children[i].innerHTML = "";
        children[i].appendChild(x);
        console.log(children[i].innerHTML);
    }

    function cancelAction() {
        event.target.style.display = "inline";


        for (let i = 0; i < children.length - 2; i++) {
            console.log(children[i].innerHTML);


            children[i].innerHTML = "DATA AVANT(pas encore fait)";
        }
    }

    function validAction() {
        event.target.style.display = "inline";


        for (let i = 0; i < children.length - 2; i++) {
            console.log(children[i].innerHTML);


            children[i].innerHTML = "DATA APRES(pas encore fait)";
        }
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

        fetch("updateUser.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                },
                body: `idUser=${idUser}`,
            })
            .then((response) => response.text())
            .then((res) => location.reload());

    });



    children[children.length - 2].appendChild(buttonCancel);
    children[children.length - 2].appendChild(buttonValid);



}));