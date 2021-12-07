let questionsTable = document.getElementById("questionsTable");
let tr;
let td;


let tableStructure = {
    'id': {
        'label': 'id',
        'editable': 'false'
    },
    'label': {
        'label': 'label',
        'editable': 'true',
        'type': 'input',

    },
    'level': {
        'label': 'level',
        'type': 'select',
        'editable': 'true',
        'value': {
            1: 'niveau cp',
            2: 'facile',
            3: 'normal',
            4: 'difficile',
            5: 'Très difficile',
            6: 'Impossible'
        }
    },
    'answers': {
        'label': 'answers',
        'editable': 'true'
    }
};


tr = document.createElement("TR");


for (const [key, value] of Object.entries(tableStructure)) {
    td = document.createElement("TD");
    td.innerHTML = key;
    tr.appendChild(td);
}
questionsTable.appendChild(tr);


fetch("/GetQuestions", {
        method: "GET",
    })
    .then((response) => response.text())
    .then((res) => {

        res = JSON.parse(res);

        res.forEach(element => {
            tr = document.createElement("TR");


            for (const [key, value] of Object.entries(element)) {

                td = document.createElement("TD");

                if (key === "answers") {
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
                    td.innerHTML = tableStructure[key].value[value];
                } else {
                    td.innerHTML = value;
                }
                tr.appendChild(td);
            }

            questionsTable.appendChild(tr);
        });



    });