<?php require 'functions.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){


  $email=addslashes($_POST['email']); 
  $password=addslashes($_POST['password']);


  $query="select * from users where email ='$email'	and password='$password' limit 1 ";
  $result=mysqli_query($con,$query);

//print_r($result);
    if (mysqli_num_rows($result) > 0){
  $row =mysqli_fetch_assoc($result);
   $_SESSION['info']=$row;
   //print_r($SESSION['info']);
  header("location:profile.php");
  die;
}$error='wrong email or password';
}
?>
<link rel='stylesheet' type="text/css" href="main.css"><?php
include ('header.php');?>
<?php //include 'datbase.php';?>
<form  method="post">
  <div>
</div>
<h1></h1>

<?php  if(!empty($error)){
      echo $error;
}
?>
    <p></p>
    <hr>
  <div class="container">
    <label for="uname"><b>email</b></label>
    <input type="email" placeholder="Enter " name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form> 
<?php //require ('footer.php');?>