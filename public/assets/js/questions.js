let questionsTable = document.getElementById("questionsTable");
let tr;
let td;


let tableStructure = {
    'id_question': {
        'data': 'true',
        'label': 'id_question',
        'header': 'ID',
        'editable': 'false'
    },
    'label_question': {
        'data': 'true',
        'label': 'label_question',
        'header': 'Question',
        'editable': 'true',
        'type': 'input',

    },
    'level': {
        'data': 'true',
        'label': 'level',
        'header': 'Difficulté',
        'type': 'select',
        'editable': 'true',
        'value': {
            1: 'Très facile',
            2: 'facile',
            3: 'normal',
            4: 'difficile',
            5: 'Très difficile',
            6: 'Impossible'
        }
    },
    'answers': {
        'data': 'true',
        'label': 'answers',
        'header': 'Réponse',
        'editable': 'true'
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
    table.innerHTML = "";
}


function createHeaderTable(table) {
    tr = document.createElement("TR");
    for (const [key, value] of Object.entries(tableStructure)) {
        td = document.createElement("TD");
        td.innerHTML = value.header;
        td.id = value.label;
        tr.appendChild(td);
    }
    table.appendChild(tr);
}

function insertData(table, data) {

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
        buttonValid.innerHTML = "YES";
        buttonValid.style.display = "none";


        let buttonDelete = document.createElement("BUTTON");
        buttonDelete.innerHTML = "Supprimer";
        buttonDelete.classList.add("delete");

        let currentId;
        let trSelect;


        headerTable = table.children[0].children;

        for (let i = 0; i < headerTable.length; i++) {
            td = document.createElement("TD");
            let field = headerTable[i].id;
            td.id = field;

            if (tableStructure[field].data != 'false') {
                dataCell = row[field];

                if (field === "answers") {
                    dataCell.forEach(element => {

                        button = document.createElement("BUTTON");
                        for (const [key, value] of Object.entries(element)) {


                            if (key === 'label_answer') {
                                button.innerHTML = value;
                            }

                            if (key === 'valid') {

                                if (value)
                                    button.style.backgroundColor = "lightgreen";
                                else
                                    button.style.backgroundColor = "lightCoral";
                            }

                        }

                        td.appendChild(button);
                    });


                    button = document.createElement("BUTTON");
                    button.innerHTML = "+";
                    td.appendChild(button);

                } else if (field === "level") {
                    td.innerHTML = tableStructure[field].value[dataCell];
                } else if (field === "id_question") {
                    tr.id = "id_question" + dataCell;
                    currentId = dataCell;
                    console.log(currentId);
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




        buttonDelete.addEventListener('click', event => {
            let id_question = event.target.id;

            console.log(id_question)
            var result = confirm("Voulez vous vraiment supprimer la question n°" + id_question + "?");
            if (result) {
                fetch("/DeleteQuestion", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                        },
                        body: `id_question=${id_question}`,
                    })
                    .then((response) => response.text())
                    .then((res) => loadData());
            }
        });




        buttonEdit.addEventListener('click', event => {
            event.target.style.display = 'none';
            buttonValid.style.display = "block";
            buttonCancel.style.display = "block";

            trSelect = document.getElementById("id_question" + currentId);
            children = trSelect.children;

            let allButtonModify = document.querySelectorAll(".modify");

            for (var i = 0, len = allButtonModify.length; i < len; i++) {
                allButtonModify[i].disabled = true;
            }


            url = "/GetQuestion";


            data = {
                'id_question': currentId
            };

            let myInit = {
                method: 'GET',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    data
                }),
                mode: 'cors',
                cache: 'default'
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

                            trSelect = document.getElementById("id_question" + currentId);
                            children = trSelect.children;
                            console.log(trSelect);
                            console.log(children);
                            console.log(json);
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
                                            option.text = currentStructure.value[key];
                                            selectList.appendChild(option);
                                        }

                                        selectList.selectedIndex = json[children[i].id] - 1;

                                        children[i].innerHTML = "";
                                        children[i].appendChild(selectList);
                                    }

                                }


                            }

                            buttonCancel.addEventListener('click', event => {
                                event.target.style.display = 'none';
                                buttonValid.style.display = "none";
                                buttonEdit.style.display = "block";

                                loadDataOneRow(tr, json);

                            });
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
        table.appendChild(tr);
    });
}



function loadDataOneRow(row, data) {
    loadData();
    console.log(row, data);
}


function loadData() {

    clearTable(questionsTable);
    createHeaderTable(questionsTable);

    tr = document.createElement("TR");

    url = "/GetQuestions";

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
                insertData(questionsTable, json);
            });
        } else {
            console.log("Le serveur n'a pas renvoyé le résultat attendu.");
        }
    }).catch(function (error) {
        console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
    });

}


loadData();