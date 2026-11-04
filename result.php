<?php

$questions = [
    1 => [
        "question" => "What does HTML stand for?",
        "options" => [
            "A" => "Hyper Text Markup Language",
            "B" => "High Text Machine Language",
            "C" => "Hyperlinks Text Management Language",
            "D" => "Home Tool Markup Language"
        ],
        "answer" => "A"
    ],

    2 => [
        "question" => "Which language is used to style web pages?",
        "options" => [
            "A" => "Python",
            "B" => "HTML",
            "C" => "CSS",
            "D" => "Java"
        ],
        "answer" => "C"
    ],

    3 => [
        "question" => "Which HTML tag is used to create a hyperlink?",
        "options" => [
            "A" => "<link>",
            "B" => "<a>",
            "C" => "<href>",
            "D" => "<url>"
        ],
        "answer" => "B"
    ],

    4 => [
        "question" => "What is the full form of CSS?",
        "options" => [
            "A" => "Computer Style Sheets",
            "B" => "Creative Style System",
            "C" => "Cascading Style Sheets",
            "D" => "Colorful Style Sheets"
        ],
        "answer" => "C"
    ],

    5 => [
        "question" => "Which tag is used to insert an image in HTML?",
        "options" => [
            "A" => "<image>",
            "B" => "<img>",
            "C" => "<pic>",
            "D" => "<src>"
        ],
        "answer" => "B"
    ],

    6 => [
        "question" => "Which language adds interactivity to web pages?",
        "options" => [
            "A" => "JavaScript",
            "B" => "HTML",
            "C" => "CSS",
            "D" => "SQL"
        ],
        "answer" => "A"
    ],

    7 => [
        "question" => "Which tag is used to create a paragraph in HTML?",
        "options" => [
            "A" => "<h1>",
            "B" => "<p>",
            "C" => "<br>",
            "D" => "<text>"
        ],
        "answer" => "B"
    ],

    8 => [
        "question" => "What does URL stand for?",
        "options" => [
            "A" => "Uniform Resource Locator",
            "B" => "Universal Reference Link",
            "C" => "Uniform Readable Language",
            "D" => "User Resource Location"
        ],
        "answer" => "A"
    ],

    9 => [
        "question" => "Which of the following is a web browser?",
        "options" => [
            "A" => "MS Word",
            "B" => "Google Chrome",
            "C" => "Photoshop",
            "D" => "Excel"
        ],
        "answer" => "B"
    ],

    10 => [
        "question" => "Which HTML tag is used to create a table row?",
        "options" => [
            "A" => "<td>",
            "B" => "<table>",
            "C" => "<tr>",
            "D" => "<th>"
        ],
        "answer" => "C"
    ]
];

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("Please submit the quiz first.");
}

$score = 0;
$answers = [];
$valid = true;

foreach ($questions as $number => $question) {

    $selected = $_POST["q" . $number] ?? "";

    if (!is_string($selected) ||
        !array_key_exists($selected, $question["options"])) {

        $valid = false;
        break;
    }

    $answers[$number] = $selected;

    if ($selected  ==$question["answer"]) {
        $score++;
    }
}

if (!$valid) {
    exit("Invalid or missing answers. Please go back and complete the quiz.");
}

$total = count($questions);
$percentage = ($score / $total) * 100;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <header>
        <h1>Quiz Result</h1>
        <p>Your quiz has been submitted successfully!</p>
    </header>

    <div class="result">
        <h2>Your Score: <?php echo $score; ?> / <?php echo $total; ?></h2>

        <h3>Percentage: <?php echo $percentage; ?>%</h3>

        <?php if ($score >= 5) { ?>
            <h3>Congratulations! You passed the quiz.</h3>
        <?php } else { ?>
            <h3>Keep Practicing! Better luck next time.</h3>
        <?php } ?>
    </div>

    <h2>Answer Review</h2>

    <?php foreach ($questions as $number => $question) { ?>

        <fieldset>
            <legend>
                Q<?php echo $number . ". " . htmlspecialchars($question["question"]); ?>
            </legend>

            <p>
                Your Answer:
                <?php
                echo htmlspecialchars($answers[$number]) . ") " .
                htmlspecialchars($question["options"][$answers[$number]]);
                ?>
            </p>

            <p>
                Correct Answer:
                <?php
                echo htmlspecialchars($question["answer"]) . ") " .
                htmlspecialchars($question["options"][$question["answer"]]);
                ?>
            </p>

            <?php if ($answers[$number]  ==$question["answer"]) { ?>
                <p style="color: green;">Correct Answer!</p>
            <?php } else { ?>
                <p style="color: red;">Wrong Answer!</p>
            <?php } ?>

        </fieldset>

    <?php } ?>

    <button onclick="window.location.href='index.html'">
        Try Again
    </button>

</div>

</body>
</html>
