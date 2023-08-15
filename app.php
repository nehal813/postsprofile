<?php require 'functions.php';
//echo "<pre>";
//print_r( $_FILES['image']['tmp_name']);die;
//echo $_SESSION['info']['image'];
checklog();
if($_SERVER['REQUEST_METHOD'] == 'POST'  && !empty($_POST['usernsme'])){

     $img_added=false;
  if(!empty($_FILES['image']['name'])  && $_FILES['image']['error'] == 0  ){
         $folder="upload/";
         if(!file_exists($folder)){
          mkdir($folder,0777,true);
         }
         $image=$folders .$_FILES['image']['name'];
         move_uploaded_file($_FILES['image']['tmp_name'] ,$image);
         $img_added=true;
  }
  $username=addslashes($_POST['username']);
  $email=addslashes($_POST['email']); 
  $password=addslashes($_POST['password']);
   $id =$_SESSION['info']['id'];

   if($img_added ==true){
  $query="update users set username ='$username' ,	email='$email' 	,password	= '$password'	,image='$image' where id='$id' limit 1  ";
   }else{
    $query="update users set username ='$username' ,	email='$email' 	,password	= '$password'	 where id='$id' limit 1  ";
  $result=mysqli_query($con,$query);
  $query= "select * from users where id='$id' limit 1";
  $result=mysqli_query($con,$query);
  if (mysqli_num_rows($result) > 0){
    $row =mysqli_fetch_assoc($result);
     $_SESSION['info']=$row;

  }

  header("location:profile.php");
  die;
}}