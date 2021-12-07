fetch("/GetQuestions", {
        method: "GET",
    })
    .then((response) => response.text())
    .then((res) => {

        console.log(res);
        res = JSON.parse(res);

        res.forEach(element => {
            console.log(element);
        });


    });