<?php

require "helpers.php";

// from the $_SERVER global variable, check if the HTTP method used is POST, if its not POST, redirect to the index.php page
// Reference: https://www.php.net/manual/en/reserved.variables.server.php

// Supply the missing code
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
$answers = $_POST['answers'] ?? []; // Ensure $answers is an array

$questions_data = retrieve_questions();
$questions = $questions_data['questions'];

?>

<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
</head>

<body>
    <section class="section">
        <h1 class="title">Quiz</h1>
        <h2 class="subtitle">Answer the questions below.</h2>

        <form id="quizForm" method="POST" action="result.php">
            <input type="hidden" name="complete_name" value="<?php echo htmlspecialchars($complete_name); ?>" />
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
            <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" />
            <input type="hidden" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>" />
            <input type="hidden" name="agree" value="<?php echo htmlspecialchars($agree); ?>" />
            <input type="hidden" name="answers" value="<?php echo htmlspecialchars(json_encode($answers)); ?>" />

            <!-- Display the options -->
            <?php foreach ($questions as $question_number => $question): ?>
                <h3 class="title is-4"><?php echo htmlspecialchars($question['question']); ?></h3>
                <?php foreach ($question['options'] as $option): ?>
                    <div class="field">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="answers[<?php echo $question_number; ?>]"
                                    value="<?php echo htmlspecialchars($option['key']); ?>" <?php echo (isset($answers[$question_number]) && $answers[$question_number] === $option['key']) ? 'checked' : ''; ?> />
                                <?php echo htmlspecialchars($option['value']); ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <!-- Start Quiz Button -->
            <button type="submit" class="button">Submit</button>
        </form>
    </section>
    <script>
        function autoSubmit() {
            setTimeout(function () {
                document.getElementById('quizForm').submit();
            }, 60000);
        }
        window.onload = autoSubmit;
    </script>
</body>
</html>
<?php

require "helpers.php";

// from the $_SERVER global variable, check if the HTTP method used is POST, if its not POST, redirect to the index.php page
// Reference: https://www.php.net/manual/en/reserved.variables.server.php

// Supply the missing code
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
$answers = $_POST['answers'] ?? [];

$questions_data = retrieve_questions();
$questions = $questions_data['questions'];

?>

<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
</head>

<body>
    <section class="section">
        <h1 class="title">Quiz</h1>
        <h2 class="subtitle">Answer the questions below.</h2>

        <form id="quizForm" method="POST" action="result.php">
            <input type="hidden" name="complete_name" value="<?php echo htmlspecialchars($complete_name); ?>" />
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
            <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" />
            <input type="hidden" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>" />
            <input type="hidden" name="agree" value="<?php echo htmlspecialchars($agree); ?>" />
            <input type="hidden" name="answers" value="<?php echo htmlspecialchars(json_encode($answers)); ?>" />

            <!-- Display the options -->
            <?php foreach ($questions as $question_number => $question): ?>
                <h3 class="title is-4"><?php echo htmlspecialchars($question['question']); ?></h3>
                <?php foreach ($question['options'] as $option): ?>
                    <div class="field">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="answers[<?php echo $question_number; ?>]"
                                    value="<?php echo htmlspecialchars($option['key']); ?>" <?php echo (isset($answers[$question_number]) && $answers[$question_number] === $option['key']) ? 'checked' : ''; ?> />
                                <?php echo htmlspecialchars($option['value']); ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <!-- Start Quiz Button -->
            <button type="submit" class="button">Submit</button>
        </form>
    </section>
    <script>
        function autoSubmit() {
            setTimeout(function () {
                document.getElementById('quizForm').submit();
            }, 60000);
        }
        window.onload = autoSubmit;
    </script>
</body>
</html>
