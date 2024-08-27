<?php

require "helpers.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

// Supply the missing code
$complete_name = $_POST['complete_name'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';
$agree = $_POST['agree'] ?? null;
$answer = $_POST['answer'] ?? null;
$answers = $_POST['answers'] ?? [];

// Append the new answer if it's not null
if (!is_null($answer)) {
    $answers[] = $answer;
}

// Use the compute_score() function from helpers.php
$score = compute_score($answers);
$formatted_birthdate = date("F j, Y", strtotime($birthdate));

$questions_data = retrieve_questions();
$questions = $questions_data['questions'];
$correct_answers = $questions_data['answers']; // Ensure this key exists in your JSON

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/site/site.min.css">
    <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>
</head>

<body>
    <section class="hero <?php echo ($score > 2) ? 'is-success' : 'is-danger'; ?>">
        <div class="hero-body">
            <p class="title">Your Score: <?php echo htmlspecialchars($score); ?></p>
            <p class="subtitle">This is the IPT10 PHP Quiz Web Application Laboratory Activity.</p>
        </div>
    </section>
    <section class="section">
        <div class="table-container">
            <table class="table is-bordered is-hoverable is-fullwidth">
                <tbody>
                    <tr>
                        <th>Input Field</th>
                        <th>Value</th>
                    </tr>
                    <tr>
                        <td>Complete Name</td>
                        <td><?php echo htmlspecialchars($complete_name); ?></td>
                    </tr>
                    <tr class="is-selected">
                        <td>Email</td>
                        <td><?php echo htmlspecialchars($email); ?></td>
                    </tr>
                    <tr>
                        <td>Birthdate</td>
                        <td><?php echo htmlspecialchars($formatted_birthdate); ?></td>
                    </tr>
                    <tr>
                        <td>Contact Number</td>
                        <td><?php echo htmlspecialchars($contact_number); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php if ($score === 5): ?>
            <canvas id="confetti-canvas"></canvas>
        <?php endif; ?>

        <h2 class="title is-4">Quiz Review</h2>
        <div class="table-container">
            <table class="table is-bordered is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Correct Answer</th>
                        <th>Your Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($questions as $index => $question): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($question['question'] ?? ''); ?></td>
                            <td>
                                <?php 
                                $correct_answer_key = $correct_answers[$index] ?? ''; 
                                $options = $question['options'] ?? [];
                                $correct_answer = '';
                                foreach ($options as $option) {
                                    if ($option['key'] === $correct_answer_key) {
                                        $correct_answer = $option['value'];
                                        break;
                                    }
                                }
                                echo htmlspecialchars($correct_answer);
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($answers[$index] ?? 'Not answered'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <script>
        <?php if ($score === 5): ?>
            var confettiSettings = {
                target: 'confetti-canvas'
            };
            var confetti = new ConfettiGenerator(confettiSettings);
            confetti.render();
        <?php endif; ?>
    </script>
</body>
</html>
