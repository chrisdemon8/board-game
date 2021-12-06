const buttonDelete = document.querySelectorAll('.delete');
const buttonModify = document.querySelectorAll('.modify');

buttonDelete.forEach(el => el.addEventListener('click', event => {
    let id_user = event.target.id;

    var result = confirm("Voulez vous vraiment supprimer l'utilisateur n°" + id_user + "?");
    if (result) {
        fetch("/deleteUser", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                },
                body: `id_user=${id_user}`,
            })
            .then((response) => response.text())
            .then((res) => location.reload());
    }
}));

let arrayRole = ["admin", "utilisateur"];

//champ editable, le label doit coincidé avec la même écriture que dans la bdd et dans le l'id du tableau

let fieldsEdit = [{
    'field': 'email',
    'type': 'input'
}, {
    'field': 'role',
    'type': 'select',
    'value': {
        1: 'admin',
        2: 'utilisateur'
    }
}, {
    'field': 'firstName',
    'type': 'input'
}, {
    'field': 'lastName',
    'type': 'input'
}];


buttonModify.forEach(el => el.addEventListener('click', event => {

    let id_user = event.target.id;

    let tr = document.getElementById(event.target.id);


    let children = tr.children;

    event.target.style.display = 'none';

    let buttonCancel = document.createElement("BUTTON");
    buttonCancel.innerHTML = "X";
    buttonCancel.classList.add("delete");

    let buttonValid = document.createElement("BUTTON");
    buttonValid.innerHTML = "YES";



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

            for (let i = 0; i < children.length; i++) {

                if (res[children[i].id]) {

                    userValueField = res[children[i].id];
                    fieldsEdit.forEach(field => {

                        if (field.field === children[i].id) {
                            if (field.type === "input") {
                                let x = document.createElement("INPUT");
                                x.setAttribute("type", "text");
                                x.setAttribute("value", userValueField);
                                children[i].innerHTML = "";
                                children[i].appendChild(x);
                            }
                            if (field.type === "select") {
                                let selectList = document.createElement("SELECT");

                                for (let key in field.value) {
                                    let option = document.createElement("option");
                                    console.log(key)
                                    option.value = key;
                                    option.text = field.value[key];
                                    selectList.appendChild(option);
                                }

                                selectList.selectedIndex = userValueField - 1;

                                children[i].innerHTML = "";
                                children[i].appendChild(selectList);
                            }
                        }
                    });
                }

            }

            buttonValid.addEventListener('click', eventValid => {
                eventValid.target.style.display = 'none';
                buttonCancel.style.display = 'none';
                event.target.style.display = "inline";

                let jsonData = {};
                console.log(res);
                for (let i = 0; i < children.length; i++) {
                    console.log(children[i].id);
                    if (res[children[i].id]) {

                        fieldsEdit.forEach(field => {

                            if (field.field === children[i].id) {
                                jsonData[children[i].id] = children[i].children[0].value;
                            }
                        });

                    }
                }

                jsonData["id_user"] = id_user;
                jsonData = JSON.stringify(jsonData);

                fetch("/updateUser", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                        },
                        body: `jsonData=${jsonData}`,
                    })
                    .then((response) => response.text())
                    .then((res) => location.reload());


            });

            buttonCancel.addEventListener('click', eventCancel => {
                eventCancel.target.style.display = 'none';
                buttonValid.style.display = 'none';

                event.target.style.display = "inline";

                for (let i = 0; i < children.length; i++) {
                    if (res[children[i].id]) {
                        fieldsEdit.forEach(field => {
                            if (field.field === children[i].id) {
                                children[i].innerHTML = res[children[i].id];

                            }
                        });
                    }
                }
            });
        });


    children[children.length - 2].appendChild(buttonCancel);
    children[children.length - 2].appendChild(buttonValid);

}));