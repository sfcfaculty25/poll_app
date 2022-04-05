<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the poll ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([ $_GET['id'] ]);
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$poll) {
        exit('Poll doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM pollstatus WHERE pollid = ?');
            $stmt->execute([ $_GET['id'] ]);
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM polls WHERE id = ?');
            $stmt->execute([ $_GET['id'] ]);
            // We also need to delete the answers for that poll
            $stmt = $pdo->prepare('DELETE FROM poll_answers WHERE poll_id = ?');
            $stmt->execute([ $_GET['id'] ]);
            
              
            // Output msg
            $msg = 'You have deleted the poll!';
        } else {
            // User clicked the "No" button, redirect them back to the home/index page
            header('Location: adminpoll.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
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
	<h2>Delete Poll #<?=$poll['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete poll #<?=$poll['id']?>?</p>
    <div class="yesno">
        <a class="btn btn-danger" href="delete.php?id=<?=$poll['id']?>&confirm=yes">Yes</a>
        <a class="btn btn-primary"  href="delete.php?id=<?=$poll['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

</body>
</html>