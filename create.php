<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Check if POST variable "title" exists, if not default the value to blank, basically the same for all variables
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    // Insert new record into the "polls" table
    $stmt = $pdo->prepare('INSERT INTO polls (title, description) VALUES (?, ?)');
    $stmt->execute([ $title, $description ]);
    // Below will get the last insert ID, this will be the poll id
    $poll_id = $pdo->lastInsertId();
    // Get the answers and convert the multiline string to an array, so we can add each answer to the "poll_answers" table
    $answers = isset($_POST['answers']) ? explode(PHP_EOL, $_POST['answers']) : '';
    foreach($answers as $answer) {
        // If the answer is empty there is no need to insert
        if (empty($answer)) continue;
        // Add answer to the "poll_answers" table
        $stmt = $pdo->prepare('INSERT INTO poll_answers (poll_id, title) VALUES (?, ?)');
        $stmt->execute([ $poll_id, $answer ]);
    }
    // Output message
    $msg = 'Created Successfully!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php

adminheader();

?>

<div class="container">
	<h2>Create Poll</h2>
    <form action="create.php" method="post" >
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
        <p></p>
        <label for="description">Description</label>
        <input type="text" name="description" class="form-control" id="description" placeholder="Description">
        <p></p>
        <label for="answers">Answers (per line)</label>
        <textarea name="answers" rows="10" id="answers" class="form-control" placeholder="Description" required></textarea>
        <p></p>
        <input type="submit" value="Create" class="btn btn-success">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
</body>

</html>