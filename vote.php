<?php
session_start();
$uid = $_SESSION["uid"];

include 'functions.php';
// Connect to MySQL
$pdo = pdo_connect_mysql();
// If the GET request "id" exists (poll id)...
if (isset($_GET['id'])) {
    // MySQL query that selects the poll records by the GET request "id"
    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([ $_GET['id'] ]);
    // Fetch the record
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the poll record exists with the id specified
  // $pollstatus = $_POST['status'];
    $pid = $_GET['id'];
    if ($poll) {
        // MySQL query that selects all the poll answers
        $stmt = $pdo->prepare('SELECT * FROM poll_answers WHERE poll_id = ?');
        $stmt->execute([ $_GET['id'] ]);
        // Fetch all the poll anwsers
        $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // If the user clicked the "Vote" button...
        if (isset($_POST['poll_answer'])) {
            // Update and increase the vote for the answer the user voted for
            $stmt = $pdo->prepare('UPDATE poll_answers SET votes = votes + 1 WHERE id = ?');
            $stmt->execute([ $_POST['poll_answer'] ]);
            
            $ins = $pdo->prepare(' insert into pollstatus values(null,?,?, "done")' );
             $ins->execute([$uid, $pid ]);
            // Redirect user to the result page
            // header('Location: result.php?id=' . $_GET['id']);
           header('Location: poll.php?id=' . $_GET['id']);

            exit;
        }
    } else {
        exit('Poll with that ID does not exist.');
    }
} else {
    exit('No poll ID specified.');
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

userheader();

?>

<div class="container poll-vote">
	<h2><?=$poll['title']?></h2>
	<p><?=$poll['description']?></p>
    <form action="vote.php?id=<?=$_GET['id']?>" method="post" >
        <?php for ($i = 0; $i < count($poll_answers); $i++): ?>
        <label>
            <input type="radio" name="poll_answer" value="<?=$poll_answers[$i]['id']?>"<?=$i == 0 ? ' checked' : ''?>>
            <?=$poll_answers[$i]['title']?>
          
        </label>
        <?php endfor; ?>
        <div>
              <input type="hidden" class="form-control" name="status" value="done"/>
            <input type="submit" value="Vote" class="btn btn-info">
          
        </div>
    </form>
</div>

</body>
</html>