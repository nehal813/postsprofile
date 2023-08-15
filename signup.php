<?php require 'functions.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $username=addslashes($_POST['username']);
  $email=addslashes($_POST['email']); 
  $password=addslashes($_POST['password']);
  $date =date('Y/m/d H,i,s');

  $query="insert into users (username,	email	,password	,date	 ) 
  values ('$username',	'$email'	,'$password'	,'$date') ";
  $result=mysqli_query($con,$query);
  header("location:login.php");
  die;
}
include ('header.php');
 //include 'database.php';?>
<link rel='stylesheet' type="text/css" href="main.css">
<form method='post' style="border:1px solid #ccc">
  <div class="container">
    <h1>Sign Up</h1>
    <p></p>
    <hr>

    <label for=""><b>Username</b></label>
    <input type="text" placeholder="Enter name" name="username" >

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" >

    <label for=""><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" >

    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" name='submit' class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>
<?php require ('footer.php');?>