<?php
session_start();
$conn = mysqli_connect('localhost','id14776005_pollinguser','Icqr2@f_puIKUWw]','id14776005_db_polling');
$msg="";
if(isset($_POST['x']))
{
$email = $_POST['user'];
$pass = $_POST['pass'];

$q = "select * from tbladmin where user = '$email' and pass = '$pass' ";

$check = mysqli_query($conn,$q);
if($row = mysqli_num_rows($check)>0)
{
    $_SESSION["admin"] = $email;
	header("Location:adminpoll.php");
}
else{
	$msg= "invalid username or password";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Admin</h5>
            <form action="adminlogin.php" method="post">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="user" id="floatingInput" placeholder="Username">
                <label for="floatingInput">Username</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="pass" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>

              
              <div class="d-grid"> 
                <input type="submit" name="x" class="btn btn-primary btn-login text-uppercase fw-bold" value="Sign in"/>
              </div>
              <hr class="my-4">
            
           <h2><?php echo $msg ?></h2>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>




</body>
</html>