let usersTable = document.getElementById("usersTable");
let tr;
let td;
let snackbar = document.getElementById("snackbar");

function showSnackBar(time, text, type) {

    snackbar.classList.add(type);

    snackbar.classList.add("show");
    snackbar.textContent = text;
    setTimeout(function () {
        snackbar.className = snackbar.className.replace("show", "");
        snackbar.className = snackbar.className.replace(type, "");
    }, time);
}


let tableStructure = {
    'id_user': {
        'data': 'true',
        'label': 'id_user',
        'header': 'ID',
        'editable': 'false'
    },
    'username': {
        'data': 'true',
        'label': 'username',
        'header': 'Pseudo',
        'editable': 'false',
    },
    'email': {
        'data': 'true',
        'label': 'email',
        'header': 'email',
        'type': 'input',
        'editable': 'true',
    },
    'role': {
        'data': 'true',
        'label': 'role',
        'header': 'Rôle',
        'type': 'select',
        'editable': 'true',
        'value': {
            1: 'admin',
            2: 'utilisateur'
        }
    },
    'firstName': {
        'data': 'true',
        'label': 'firstName',
        'header': 'Prénom',
        'type': 'input',
        'editable': 'true',
    },
    'lastName': {
        'data': 'true',
        'label': 'lastName',
        'header': 'Nom',
        'type': 'input',
        'editable': 'true',
    },
    'createdAt': {
        'data': 'true',
        'label': 'createdAt',
        'header': 'Création',
        'editable': 'false',
    },
    'edit': {
        'data': 'false',
        'label': 'edit',
        'header': 'Editer'
    },
    'delete': {
        'data': 'false',
        'label': 'delete',
        'header': 'Supprimer'
    }
};


function clearTable(table) {

    /*
    if ($.fn.dataTable.isDataTable(table)) {
        $(table).DataTable().clear().destroy();
    }*/


    table.innerHTML = "";



}

function createHeaderTable(table) {

    th = document.createElement("THEAD");
    tr = document.createElement("TR");
    for (const [key, value] of Object.entries(tableStructure)) {
        td = document.createElement("TD");
        td.innerHTML = value.header;
        td.id = value.label;
        tr.appendChild(td);
    }

    th.appendChild(tr);
    table.appendChild(th);
}



function insertData(table, data) {

    tbody = document.createElement("TBODY");


    data.forEach(row => {

        tr = document.createElement("TR");

        let buttonEdit = document.createElement("BUTTON");
        buttonEdit.innerHTML = "Edit";
        buttonEdit.classList.add("modify");

        let buttonCancel = document.createElement("BUTTON");
        buttonCancel.innerHTML = "X";
        buttonCancel.classList.add("delete");
        buttonCancel.style.display = "none";

        let buttonValid = document.createElement("BUTTON");
        buttonValid.innerHTML = "✓";
        buttonValid.style.display = "none";


        let buttonDelete = document.createElement("BUTTON");
        buttonDelete.innerHTML = "Supprimer";
        buttonDelete.classList.add("delete");

        let currentId;
        let trSelect;



        headerTable = table.children[0].firstChild.children;


        for (let i = 0; i < headerTable.length; i++) {
            td = document.createElement("TD");
            let field = headerTable[i].id;
            td.id = field;

            if (tableStructure[field].data != 'false') {
                dataCell = row[field];
                if (field === "role") {
                    td.innerHTML = tableStructure[field].value[dataCell];
                } else if (field === "createdAt") {
                    td.innerHTML = dataCell;
                } else if (field === "id_user") {
                    tr.id = "id_user" + dataCell;
                    currentId = dataCell;
                    td.innerHTML = dataCell;
                } else {
                    td.innerHTML = dataCell;
                }
            } else {
                if (field === "delete")
                    td.appendChild(buttonDelete);
                else if (field === "edit") {
                    td.appendChild(buttonEdit);
                    td.appendChild(buttonValid);
                    td.appendChild(buttonCancel);
                }
            }
            tr.appendChild(td);
        }

        buttonDelete.addEventListener('click', () => {

            var result = confirm("Voulez vous vraiment supprimer l'utilisateur n°" + currentId + "?");
            if (result) {

                fetch("/deleteUser", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                        },
                        body: `id_user=${currentId}`,
                    }).then(function (response) {

                        var contentType = response.headers.get("content-type");
                        if (contentType && contentType.indexOf("application/json") !== -1) {
                            return response.json().then(function (json) {

                                if (json.status === "success") {
                                    showSnackBar(3000, "L'utilisateur a été supprimé avec succès", "snacksuccess");
                                    loadData();
                                } else {
                                    showSnackBar(5000, "Erreur :" + json.exception, "snackerror");
                                    loadData();
                                }

                            });
                        } else {
                            console.log("Le serveur n'a pas renvoyé le résultat attendu.");
                        }

                    })
                    .catch(function (error) {
                        console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
                    });
            }
        });




        buttonEdit.addEventListener('click', event => {
            event.target.style.display = 'none';
            buttonValid.style.display = "block";
            buttonCancel.style.display = "block";

            trSelect = document.getElementById("id_user" + currentId);
            children = trSelect.children;

            let allButtonModify = document.querySelectorAll(".modify");

            for (var i = 0, len = allButtonModify.length; i < len; i++) {
                allButtonModify[i].disabled = true;
            }



            url = "/getUser";

            data = {
                'id_user': currentId
            };

            fetch(url, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        data
                    }),
                    mode: 'cors',
                    cache: 'default'
                }).then(function (response) {
                    var contentType = response.headers.get("content-type");
                    if (contentType && contentType.indexOf("application/json") !== -1) {
                        return response.json().then(function (json) {

                            if (json.status === "success") {

                                json = json.res;

                                trSelect = document.getElementById("id_user" + currentId);
                                children = trSelect.children;
                                for (let i = 0; i < children.length; i++) {

                                    currentStructure = tableStructure[children[i].id];
                                    if (children[i].id) {
                                        if (currentStructure.type === "input") {
                                            let x = document.createElement("INPUT");
                                            x.setAttribute("type", "text");
                                            x.setAttribute("value", json[children[i].id]);

                                            children[i].innerHTML = "";
                                            children[i].appendChild(x);
                                        }
                                        if (currentStructure.type === "select") {
                                            let selectList = document.createElement("SELECT");

                                            for (let key in currentStructure.value) {
                                                let option = document.createElement("option");
                                                option.currentStructure = key;
                                                option.value = key;
                                                option.text = currentStructure.value[key];
                                                selectList.appendChild(option);
                                            }

                                            selectList.selectedIndex = json[children[i].id] - 1;

                                            children[i].innerHTML = "";
                                            children[i].appendChild(selectList);
                                        }

                                    }


                                }


                                buttonValid.addEventListener('click', eventValid => {
                                    eventValid.target.style.display = 'none';
                                    buttonCancel.style.display = 'none';
                                    event.target.style.display = "inline";

                                    let allButtonModify = document.querySelectorAll(".modify");

                                    for (var i = 0, len = allButtonModify.length; i < len; i++) {
                                        allButtonModify[i].disabled = false;
                                    }


                                    let jsonData = {};

                                    for (let i = 0; i < children.length; i++) {

                                        if (tableStructure[children[i].id].editable == "true") {

                                            jsonData[children[i].id] = children[i].children[0].value;
                                        }



                                    }

                                    jsonData["id_user"] = currentId;

                                    fetch("/updateUserAdmin", {
                                            method: 'POST',
                                            headers: {
                                                "Content-Type": "application/json"
                                            },
                                            body: JSON.stringify({
                                                jsonData
                                            }),
                                            mode: 'cors',
                                            cache: 'default'
                                        }).then(function (response) {

                                            var contentType = response.headers.get("content-type");
                                            if (contentType && contentType.indexOf("application/json") !== -1) {
                                                return response.json().then(function (json) {

                                                    if (json.status === "success") {
                                                        showSnackBar(3000, "Question mise à jour avec succès", "snacksuccess");

                                                        loadData();
                                                    } else {
                                                        showSnackBar(5000, "Erreur :" + json.exception, "snackerror");
                                                        loadData();
                                                    }

                                                });
                                            } else {
                                                console.log("Le serveur n'a pas renvoyé le résultat attendu.");
                                            }

                                        })
                                        .catch(function (error) {
                                            console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
                                        });

                                });



                                buttonCancel.addEventListener('click', event => {
                                    event.target.style.display = 'none';
                                    buttonValid.style.display = "none";
                                    buttonEdit.style.display = "block";
                                    loadData();

                                });

                            } else
                                alert(json.exception);
                        });
                    } else {
                        console.log("Le serveur n'a pas renvoyé le résultat attendu.");
                    }
                })
                .catch(function (error) {
                    console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
                });

        });
        tr.appendChild(td);
        tbody.appendChild(tr);

    });


    table.appendChild(tbody);
    /*
        let customTable = new DataTable(table, {});*/

}





function loadData() {

    clearTable(usersTable);
    createHeaderTable(usersTable);

    url = "/getUsers";

    var myHeaders = new Headers();

    var myInit = {
        method: 'GET',
        headers: myHeaders,
        mode: 'cors',
        cache: 'default'
    };

    fetch(url, myInit).then(function (response) {

        var contentType = response.headers.get("content-type");
        if (contentType && contentType.indexOf("application/json") !== -1) {
            return response.json().then(function (json) {

                if (json.status === "success") {
                    console.log(json.res);
                    insertData(usersTable, json.res);
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


}

loadData();