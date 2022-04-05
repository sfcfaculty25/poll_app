<?php
session_start();
$username = $_SESSION["u"] ;
$uid = $_SESSION["uid"];
?>
<?php
// Include the function file
include 'functions.php';
// Connect to MySQL
$pdo = pdo_connect_mysql();
// MySQL query that retrieves all the polls and poll answers
$stmt = $pdo->query('SELECT p.*, GROUP_CONCAT(pa.title ORDER BY pa.id) AS answers FROM polls p LEFT JOIN poll_answers pa ON pa.poll_id = p.id GROUP BY p.id');
$polls = $stmt->fetchAll(PDO::FETCH_ASSOC);



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

<div class="container home">
    <h2>Polls</h2>
    	<p>Welcome to the <?php echo $username ?></p>
	


	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Title</td>
				<td>Answers</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($polls as $poll){ ?>
            <tr>
                <td><?=$poll['id']?></td>
                <td><?=$poll['title']?></td>
				<td><?=$poll['answers']?></td>
                <td class="actions">
                      
				<?php
				$pid =$poll['id'];
				$res = $pdo->query("select * from pollstatus where pollid = $pid and userid=$uid "  );
                $pollstatus = ($res->fetchColumn());
                if($pollstatus > 0){
                    
                }
                else{
                    echo '<a href= "vote.php?id='.$poll["id"].'" class="view" title="Cast Vote"><i class="fas fa-eye fa-xs"></i></a>';
                }
				
			    //foreach($status as $s){
			        
			        
				// if($s['pollid']==$poll['id'] )
				// {
				//     echo 'Vote has been casted successfully.';
				// }
				// else
				// { 
				//     echo '<a href= "vote.php?id='.$poll["id"].'" class="view" title="Cast Vote"><i class="fas fa-eye fa-xs"></i></a>';
				// }
		
			    //}
 	    	    
 	    	    //echo "<pre>".$arr."</pre>";
				?>
					 
                 
                </td>
                
            </tr>
            
            <?php } //endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>