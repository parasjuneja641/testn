<?php
$signUp=0;
$server ="localhost";
$username ="root";
$password ="";
$con = mysqli_connect($server,$username,$password);
if(!$con)
{
    die("error occured".mysqli_connect_error());
}
else{
    //echo "connected succesfully";
}if(isset($_POST['submit']))
{
$username = $_POST['username'];
$password = $_POST['password'];


$e = "SELECT username FROM `formsl`.`user` WHERE username = '".$username."'";
$ee = $con->query($e);
if(empty($username))
{
    $error['u'] = "enter username";
}
else if($ee){
if($ee->num_rows > 0)
{
    $error['u'] = "username already exist";
}
}
if(empty($password))
{
    $error['p'] = "enter password";
}



if(!empty($username) && !empty($password) && $ee->num_rows==0)
{
$sql = "INSERT INTO `formsl`.`user`(`username`, `password`) VALUES ('$username','$password')";
if($con->query($sql) == true)
{
$signUp=1;
}
else{
    $signUp=2;
//   echo "ERROR: $sql <br> $con->error";
}
}
}
if(isset($_POST['submit1']))
{
$username = $_POST['username'];
$password = $_POST['password'];
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Signup</title>
    <style>
    .danger{
        color : red;
    }
    .col{
        color : blue;
    }
  </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Login Here</h2>
                <form action="signup.php" method="post"></form>
                 <div class="form-group">
                     <label>username</label>
                     <input type="text" name="username" class="form-control">
                 </div>
                   
                       <div class="form-group">
                         <label>password</label>
                         <input type="password" name="password" class="form-control">
                       </div>
                       <input class="btn btn-primary" type="submit" name="submit1" value="Log in" />
                                 
            </div>
            <div class="col-md-6">
                <h2>Signin form</h2>
                <h6 class="col"><?php
                if($signUp==1){
                    echo "you are succesfuly sign up now you can login";
                }
                if($signUp==2){
                    echo "please try again later";
                }
                ?></h6>
                <form action="signup.php" method="post">
                 <div class="form-group">
                     <label>username</label>
                     <input type="text" name="username" class="form-control">
                     <p class="danger"><?php 
                     if(isset($error['u']))
                     {
                         echo $error['u'];
                     }
                     ?>
                     </p>
                 </div>
                   
                       <div class="form-group">
                         <label>password</label>
                         <input type="password" name="password" class="form-control">
                         <p class="danger"><?php 
                     if(isset($error['p']))
                     {
                         echo $error['p'];
                     }
                     ?>
                     </p>
                       </div>
                       <input class="btn btn-primary" type="submit" name="submit" value="Sign Up" />
                       </form>            
                    </div>
        </div>
    </div>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
</html>
