document.getElementById("quizForm").addEventListener("submit", function(event) {

    let unanswered = [];

    for (let counter = 1; counter <= 10; counter++) {

        let answer = document.querySelector('input[name="q' + counter + '"]:checked');

        if (!answer) {
            unanswered.push(counter);
        }
    }

    if (unanswered.length > 0) {
        event.preventDefault();

        alert("Please answer all questions before submitting.\nUnanswered questions: " + unanswered.join(", "));
    }

});
