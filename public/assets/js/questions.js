let questionsTable = document.getElementById("questionsTable");
let tr;
let td;


let tableStructure = {
    'id_question': {
        'label': 'id_question',
        'header': 'ID',
        'editable': 'false'
    },
    'label_question': {
        'label': 'label_question',
        'header': 'Question',
        'editable': 'true',
        'type': 'input',

    },
    'level': {
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
        'label': 'answers',
        'header': 'Réponse',
        'editable': 'true'
    },
    'editer': {
        'label': 'false',
        'header': 'Editer'
    },
    'supprimer': {
        'label': 'false',
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




        headerTable = table.children[0].children;

        for (let i = 0; i < headerTable.length; i++) {
            td = document.createElement("TD");
            let field = headerTable[i].id; 
            if (field != 'false') {
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
                    td.innerHTML = dataCell;
                } else {
                    td.innerHTML = dataCell;
                }
            } else { 
                console.log(field); 
                if (field['header'] === "Supprimer")
                    td.appendChild(buttonDelete);
                else if (field['header'] === "Editer")
                    td.appendChild(buttonEdit);
            }
            tr.appendChild(td);
        }

        tr.appendChild(td);
        table.appendChild(tr);
    });
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
    })
    /*
           .catch(function (error) {
               console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
           });*/


    fetch("/GetQuestions", {
            method: "GET",
        })
        .then((response) => response.text())
        .then((res) => {

            const startTime = performance.now();



            res = JSON.parse(res);

            res.forEach(element => {
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

                for (const [key, value] of Object.entries(element)) {

                    td = document.createElement("TD");
                    if (key === "answers") {
                        td.id = key;
                        value.forEach(element => {

                            button = document.createElement("BUTTON");
                            for (const [key, value] of Object.entries(element)) {

                                if (key === 'id_answer') {
                                    button.id = value;

                                }

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

                    } else if (key === "level") {
                        td.id = key;
                        td.innerHTML = tableStructure[key].value[value];
                    } else if (key === "id_question") {
                        tr.id = "id_question" + value;
                        buttonEdit.id = value;
                        buttonCancel.id = value;
                        buttonValid.id = value;
                        buttonDelete.id = value;
                        td.id = key;
                        td.innerHTML = value;
                    } else {
                        td.id = key;
                        td.innerHTML = value;
                    }
                    tr.appendChild(td);
                }

                tdEdit = document.createElement("TD");

                buttonEdit.addEventListener('click', event => {
                    event.target.style.display = 'none';
                    buttonValid.style.display = "block";
                    buttonCancel.style.display = "block";
 
                    trSelect = document.getElementById("id_question" + event.target.id);
                    children = trSelect.children;


                    for (let i = 0; i < children.length; i++) {
 
                        currentStructure = tableStructure[children[i].id];
                        if (children[i].id) {


                            if (currentStructure.type === "input") {
                                let x = document.createElement("INPUT");
                                x.setAttribute("type", "text");
                                x.setAttribute("value", "");

                                children[i].innerHTML = "";
                                children[i].appendChild(x);
                            }
                            if (currentStructure.type === "select") {
                                let selectList = document.createElement("SELECT");

                                for (let key in currentStructure.value) {
                                    let option = document.createElement("option");
                                    //console.log(key)
                                    option.currentStructure = key;
                                    option.text = currentStructure.value[key];
                                    selectList.appendChild(option);
                                }

                                //selectList.selectedIndex = userValueField - 1;

                                children[i].innerHTML = "";
                                children[i].appendChild(selectList);
                            }

                        }


                    }

                });

                buttonCancel.addEventListener('click', event => {
                    event.target.style.display = 'none';
                    buttonValid.style.display = "none";
                    buttonEdit.style.display = "block";
                    loadData();
                });



                tdEdit.appendChild(buttonEdit);
                tdEdit.appendChild(buttonValid);
                tdEdit.appendChild(buttonCancel);

                tr.appendChild(tdEdit);

                td = document.createElement("TD");

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


                td.appendChild(buttonDelete);


                tr.appendChild(td);
                questionsTable.appendChild(tr);
            });


            // Do the normal stuff for this function

            const duration = performance.now() - startTime;
            console.log(`someMethodIThinkMightBeSlow took ${duration}ms`);

        });


}


loadData();