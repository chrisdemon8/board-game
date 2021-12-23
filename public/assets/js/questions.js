let questionsTable = document.getElementById("questionsTable");
let tr;
let td;
let snackbar = document.getElementById("snackbar");

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
            2: 'Facile',
            3: 'Normal',
            4: 'Difficile',
            5: 'Très difficile',
            6: 'Impossible'
        }
    },
    'answers': {
        'data': 'true',
        'label': 'answers',
        'header': 'Réponse',
        'editable': 'false'
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


function showSnackBar(time, text, type) {

    snackbar.classList.add(type);

    snackbar.classList.add("show");
    snackbar.textContent = text;
    setTimeout(function () {
        snackbar.className = snackbar.className.replace("show", "");
        snackbar.className = snackbar.className.replace(type, "");
    }, time);
}

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
    let buttonAddQuestion = document.getElementById('addQuestion');
    buttonAddQuestion.onclick = () => {
        newModalQuestion();
    }
    //table.after(buttonAddQuestion);
}

function newModal(response, id) {
    document.getElementById('myModal').style.display = 'block';
    let modalContent = document.getElementById('modalContent');
    modalContent.innerHTML = '';
    let label = document.createElement('label');
    label.for = 'txtReponse';
    label.innerHTML = 'Réponse';

    let input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'Entrer votre réponse';
    input.name = 'txtReponse';
    input.id = 'txtReponse';
    if (response)
        input.value = response.label_answer;


    let input2 = document.createElement('input');
    input2.name = 'cbboxValide';
    input2.id = 'cbboxValide';
    input2.type = 'checkbox';
    if (response)
        input2.checked = response.valid;

    let label2 = document.createElement('label');
    label2.for = 'cbboxValide';
    label2.innerHTML = 'Valide';

    let buttonCancel = document.createElement("button");
    buttonCancel.classList.add("delete");
    buttonCancel.name = 'Annuler';
    buttonCancel.textContent = 'Annuler'
    buttonCancel.onclick = () => {
        document.getElementById('myModal').style.display = 'none'
    }

    let buttonDelete = document.createElement("button");
    buttonDelete.textContent = 'Supprimer'
    buttonDelete.classList.add("delete");
    buttonDelete.onclick = () => {
        document.getElementById('myModal').style.display = 'none'

        let jsonData;

        jsonData = {
            'id_answer': response.id_answer
        }

        fetch("/deleteAnswer", {
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
                            loadData();
                            showSnackBar(3000, "Réponse supprimée avec succès", "snacksuccess");
                        } else {
                            showSnackBar(3000, "Erreur :" + json.exception, "snackerror");
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


    let buttonValidate = document.createElement("button");
    buttonValidate.textContent = 'Valider'
    buttonValidate.onclick = () => {
        let valueInput = input.value;
        let valide = input2.checked;
        document.getElementById('myModal').style.display = 'none'

        let jsonData;

        if (response) {
            // update de la réponse  
            jsonData = {
                'id_answer': response.id_answer,
                'valid': valide,
                'label_answer': valueInput
            }


            fetch("/updateAnswer", {
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
                                showSnackBar(3000, "Réponse mise à jour avec succès", "snacksuccess");
                                loadData(); 
                            } else {
                                showSnackBar(5000, "Erreur :" + json.exception, "snackerror");
                                loadData();
                            }

                        });
                    } else {
                        console.log("Le serveur n'a pas renvoyé le résultat attendu.");
                    }
                    /* if (response.ok)
                         response.text().then(function (res) {
                             loadData();
                         })*/
                })
                .catch(function (error) {
                    console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
                });
        } else {
            // ajout de la réponse 
            jsonData = {
                'id_question': id,
                'valid': valide,
                'label_answer': valueInput
            }



            fetch("/addAnswer", {
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
                                showSnackBar(3000, "Réponse ajoutée avec succès", "snacksuccess");
                                loadData();
                            } else {
                                if (json.exception.includes("ERROR_LABEL"))
                                    showSnackBar(5000, "Erreur : La réponse existe déjà", "snackerror");
                                else
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
    }

    modalContent.append(label, input, label2, input2, buttonCancel, buttonValidate, buttonDelete);



}

function newModalQuestion() {
    document.getElementById('myModal').style.display = 'block';
    let modalContent = document.getElementById('modalContent');
    modalContent.innerHTML = '';
    let label = document.createElement('label');
    label.for = 'txtQuestion';
    label.innerHTML = 'Question :';

    let input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'Entrer votre question';
    input.name = 'txtQuestion';
    input.id = 'txtQuestion';

    let input2 = document.createElement('select');
    input2.name = 'Levels';
    input2.id = 'Levels';
    input2.type = 'select';


    for (const [key, value] of Object.entries(tableStructure['level']['value'])) {
        let opt = document.createElement("option");
        opt.value = key;
        opt.text = value;
        input2.add(opt);
    }

    let label2 = document.createElement('label');
    label2.for = 'Levels';
    label2.innerHTML = 'Niveau de difficulté';

    let buttonCancel = document.createElement("button");
    buttonCancel.classList.add("delete");
    buttonCancel.name = 'Annuler';
    buttonCancel.textContent = 'Annuler'
    buttonCancel.onclick = () => {
        document.getElementById('myModal').style.display = 'none'
    }

    let buttonValidate = document.createElement("button");
    buttonValidate.textContent = 'Valider'
    buttonValidate.onclick = () => {
        let valueInput = input.value;
        let level = input2.value;
        if (valueInput === '')
            alert('Veuiller rentrer un label ou annuler .')
        else {
            document.getElementById('myModal').style.display = 'none';
            jsonData = {
                'label_question': valueInput,
                'level': level,
            }
            fetch("addQuestion", {
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
                                showSnackBar(3000, "Question ajoutée avec succès", "snacksuccess");
                                loadData();
                            } else {
                                showSnackBar(5000, "Erreur :" + json.exception, "snackerror");
                                loadData();
                            }

                        });
                    } else {
                        console.log("Le serveur n'a pas renvoyé le résultat attendu.");
                    }


                    /*if (response.ok)
                        response.text().then(function (res) {
                            loadData();
                        })*/
                })
                .catch(function (error) {
                    console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
                });
        }

    }

    modalContent.append(label, input, label2, input2, buttonCancel, buttonValidate);


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

                if (field === "answers") {
                    dataCell.forEach(element => {

                        button = document.createElement("BUTTON");

                        for (const [key, value] of Object.entries(element)) {
                            if (key === 'label_answer') {
                                button.innerHTML = value;
                            }

                            if (key === 'valid') {

                                if (value)
                                    button.classList.add("valid");
                                else
                                    button.classList.add("false");
                            }

                        }
                        button.onclick = () => {
                            newModal(element);
                        }
                        td.appendChild(button);
                    });


                    button = document.createElement("BUTTON");
                    button.innerHTML = "+";
                    button.onclick = () => {
                        newModal(false, currentId);
                    }
                    td.appendChild(button);

                } else if (field === "level") {
                    td.innerHTML = tableStructure[field].value[dataCell];
                } else
                if (field === "id_question") {
                    tr.id = "id_question" + dataCell;
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

            var result = confirm("Voulez vous vraiment supprimer la question n°" + currentId + "?");
            if (result) {
                fetch("/deleteQuestion", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                        },
                        body: `id_question=${currentId}`,
                    }).then(function (response) {

                        var contentType = response.headers.get("content-type");
                        if (contentType && contentType.indexOf("application/json") !== -1) {
                            return response.json().then(function (json) {

                                if (json.status === "success") {
                                    showSnackBar(3000, "Question supprimée avec succès", "snacksuccess");
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

            trSelect = document.getElementById("id_question" + currentId);
            children = trSelect.children;

            let allButtonModify = document.querySelectorAll(".modify");

            for (var i = 0, len = allButtonModify.length; i < len; i++) {
                allButtonModify[i].disabled = true;
            }


            url = "/getQuestion";


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

                            if (json.status === "success") {

                                json = json.res;

                                trSelect = document.getElementById("id_question" + currentId);
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

                                    jsonData["id_question"] = currentId;

                                    fetch("/updateQuestion", {
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

    clearTable(questionsTable);
    createHeaderTable(questionsTable);

    url = "/getQuestions";

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

                if (json.status === "success")
                    insertData(questionsTable, json.res);
                else {
                    showSnackBar(5000, "Erreur :" + json.exception, "snackerror");
                }
            });
        } else {
            console.log("Le serveur n'a pas renvoyé le résultat attendu.");
        }
    }).catch(function (error) {
        console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
    });


}





loadData();