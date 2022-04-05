<?php


function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'id14776005_pollinguser';
    $DATABASE_PASS = 'Icqr2@f_puIKUWw]';
    $DATABASE_NAME = 'id14776005_db_polling';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('error');
    }
}


function adminheader()
{
      echo '
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <div class="container-fluid text-white bg-success p-2 text-center">
    	<div>
    		<h1>Voting & Poll System</h1>
        <a href="adminpoll.php" class="btn btn-dark" ><i class="  fas fa-poll-h"></i>Polls</a>

             <a href="adminlogout.php" class="btn btn-dark"><i class="fas fa-poll-h"></i>Logout</a>
    	</div>
    </div>';
}


function userheader()
{
      echo '
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <div class="container-fluid text-white bg-success p-2 text-center">
    	<div>
    		<h1>Voting & Poll System</h1>
        <a href="poll.php" class="btn btn-dark" ><i class="  fas fa-poll-h"></i>Polls</a>

             <a href="logout.php" class="btn btn-dark"><i class="fas fa-poll-h"></i>Logout</a>
    	</div>
    </div>';
}


// Template header, feel free to customize it, but DO NOT INDENT THE PHP CODE
function template_header($title) {
// DO NOT INDENT THE BELOW PHP CODE OR YOU WILL ENCOUNTER ISSUES

    echo '
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Voting & Poll System</h1>
        <a href="poll.php"><i class="fas fa-poll-h"></i>Polls</a>

             <a href="logout.php"><i class="fas fa-poll-h"></i>Logout</a>
    	</div>
    </nav>';


}

// Template footer
function template_footer() {
// DO NOT INDENT THE PHP CODE
echo ' </body></html>';
}

?>