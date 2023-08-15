<?php require 'functions.php';

checklog();
//delete poooost
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] =='post_delete' ){
  $id = $_GET['id'] ?? 0;
  $user_id=$_SESSION['info']['id'];
  $query ="select * from posts where id ='$id' and user_id='$user_id' limit 1";
  $result = mysqli_query($con,$query);
  if(mysqli_num_rows($result) > 0){
    $row=mysqli_fetch_assoc($result);
  
  if(file_exists($_SESSION['info']['image'])){
   unlink($_SESSION['info']['image']);
 }}
 $query ="delete from posts where id ='$id' && user_id ='$user_id' limit 1";
 $result = mysqli_query($con,$query);
  header("location:profile.php");
  die;
}
// edit post
elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'post_edit')
{
  $id = $_GET['id'] ?? 0;
  $user_id=$_SESSION['info']['id'];
$image_added = false;
if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg"){
//file was uploaded
$folder = "uploads/";
if(!file_exists($folder))
{
mkdir($folder,0777,true);
}

$image = $folder . $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], $image);

 $query ="select * from posts where id ='$id' and user_id='$user_id' limit 1";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result) > 0){
  $row=mysqli_fetch_assoc($result);

if(file_exists($row['image'])){
 unlink($row['image']);
    }   }
$image_added=true;
  }
$post = addslashes($_POST['post']);
//$user_id=$_SESSION['info']['id'];
if($image_added ==  true){
$query = "update posts set post='$post' and image='$image'  where user_id='$user_id' && id='$id' limit 1";
}else{
  $query = "update posts set post='$post' where user_id='$user_id' && id='$id' limit 1";
}

$result = mysqli_query($con,$query);

header("Location: profile.php");
die;
}
//    edit profile

elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['username']))
{
//profile edit
$image_added = false;
if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg"){
//file was uploaded
$folder = "uploads/";
if(!file_exists($folder))
{
mkdir($folder,0777,true);
}

$image = $folder . $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], $image);

if(file_exists($_SESSION['info']['image'])){
unlink($_SESSION['info']['image']);
}

$image_added = true;
}

$username = addslashes($_POST['username']);
$email = addslashes($_POST['email']);
$password = addslashes($_POST['password']);
$id = $_SESSION['info']['id'];

if($image_added == true){
$query = "update users set username = '$username',email = '$email',password = '$password',image = '$image' where id = '$id' limit 1";
}else{
$query = "update users set username = '$username',email = '$email',password = '$password' where id = '$id' limit 1";
}

$result = mysqli_query($con,$query);

$query = "select * from users where id = '$id' limit 1";
$result = mysqli_query($con,$query);

if(mysqli_num_rows($result) > 0){

$_SESSION['info'] = mysqli_fetch_assoc($result);
}

header("Location: profile.php");
die;
}


elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] =='delete' ){
           $id = $_SESSION['info']['id'];
           $query ="delete from users where id ='$id' limit 1";
           $result = mysqli_query($con,$query);
           if(file_exists($_SESSION['info']['image'])){
            unlink($_SESSION['info']['image']);
          }
          $query ="delete from posts where user_id ='$id' limit 1";
          $result = mysqli_query($con,$query);
           header("location: logout.php");
           die;
}
// edit post
elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['post']))
{
  // edit
  $image = "";
  if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg"){
    //file was uploaded
    $folder = "uploads/";
    if(!file_exists($folder))
    {
      mkdir($folder,0777,true);
    }

    $image = $folder . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $image);

  }

  $post = addslashes($_POST['post']);
  $user_id=$_SESSION['info']['id'];
  $date =date('Y/m/d H,i,s');
    $query = "insert into posts (	user_id	,post,	image	,date ) values ( 	'$user_id','$post',	'$image','$date')";
    
  
  $result = mysqli_query($con,$query);

  header("Location: profile.php");
  die;
}
//    edit profile

elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['username']))
	{
		//profile edit
		$image_added = false;
		if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg"){
			//file was uploaded
			$folder = "uploads/";
			if(!file_exists($folder))
			{
				mkdir($folder,0777,true);
			}

			$image = $folder . $_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $image);

			if(file_exists($_SESSION['info']['image'])){
				unlink($_SESSION['info']['image']);
			}

			$image_added = true;
		}

		$username = addslashes($_POST['username']);
		$email = addslashes($_POST['email']);
		$password = addslashes($_POST['password']);
		$id = $_SESSION['info']['id'];

		if($image_added == true){
			$query = "update users set username = '$username',email = '$email',password = '$password',image = '$image' where id = '$id' limit 1";
		}else{
			$query = "update users set username = '$username',email = '$email',password = '$password' where id = '$id' limit 1";
		}

		$result = mysqli_query($con,$query);

		$query = "select * from users where id = '$id' limit 1";
		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) > 0){

			$_SESSION['info'] = mysqli_fetch_assoc($result);
		}

		header("Location: profile.php");
		die;
	}

include ('header.php');?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}


tr:hover {background-color: coral;}
</style>
</head>
<body>
<?php // delete poooooooost
if(!empty($_GET['action']) && $_GET['action'] == 'post_delete' && !empty($_GET['id'])):?>

<?php
  $id=(int)$_GET['id'];
  $query="select * from posts where id ='$id' limit 1";
  $result=mysqli_query($con,$query);
  $query1="delete from posts where id='$id'";
  $result2=mysqli_query($con,$query1);

  ?>
<?php if(mysqli_num_rows($result)> 0):?>
  <?php $row=mysqli_fetch_assoc($result);?>
  <h5>Delete your post : </h5>

<form method='post'  enctype="multipart/form-data"  >
<img src="<?=$row['image']?>"    style="width:377px ;height:266px; "  >
<label for=""><b>image</b></label>
   <input type="file"  placeholder="Enter" name="image" ></br> 
   <textarea  name="post" rows="4" cols="50"><?=$row['post'];?></textarea>
   <input type="hidden" name="action" value="post_delete">
   <a href="profile.php"><button type="button" class="cancelbtn">Cancel</button></a>
<button >Delete</button>
     </form>
     <?php endif;?>

<?php //  edit poooooost  ?>
<?php elseif(!empty($_GET['action']) && $_GET['action'] == 'post_edit' && !empty($_GET['id'])):?>
<?php
  $id=(int)$_GET['id'];
  $query="select * from posts where id ='$id' limit 1";
  $result=mysqli_query($con,$query);
  ?>
<?php if(mysqli_num_rows($result)> 0):?>
  <?php $row=mysqli_fetch_assoc($result);?>
  <h5>Edit a post</h5>

<form method='post'  enctype="multipart/form-data"  >
<img src="<?=$row['image']?>"    style="width:377px ;height:266px; "  >
<label for=""><b>image</b></label>
   <input type="file"  placeholder="Enter" name="image" ></br> 
   <textarea  name="post" rows="4" cols="50"><?=$row['post'];?></textarea>
   <input type="hidden" name="action" value="post_edit">
   <a href="profile.php"><button type="button" class="cancelbtn">Cancel</button></a>
<button >Save</button>
     </form>
<?php endif;?>

  <?php //edit profile
  elseif(!empty($_GET['action']) && $_GET['action'] == 'edit'):?>

    <form method='post'  enctype="multipart/form-data"  style="border:1px solid #ccc">
  <div class="container">
    <h1>EDIT</h1>
    <p></p>
    <hr>
    <img src="<?=$_SESSION['info']['image']?>"    style="width:150px ;height:155px;"  >
    <label for=""><b>image</b></label>
    <input type="file"  placeholder="Enter" name="image" ></br>
    <label ><b>Username</b></label>
    <input value="<?=$_SESSION['info']['username'];?>" type="text" placeholder="Enter name" name="username" required >

    <label ><b>Email</b></label>
    <input value="<?=$_SESSION['info']['email']?>" type="email" placeholder="Enter Email" name="email"required>

    <label ><b>Password</b></label>
    <input value="<?=$_SESSION['info']['password']?>" type="text" placeholder="Enter Password" name="password" required>

    <div class="clearfix">
      <a href="profile.php"><button type="button" class="cancelbtn">Cancel</button></a>
      <button type="submit" name='submit' class="signupbtn">EDIT</button>
    </div>
  </div>
</form>
<?php  //    delete  pageeeeeeeee  ?>
  <?php elseif(!empty($_GET['action']) && $_GET['action'] == 'delete'):?>
    <form method='post'  enctype="multipart/form-data" class ="form-center"  style="border:1px solid #ccc">
  <div class="container">
    <h1>Delete Profile</h1>
    <p> make sure you want to :</p>
    <hr>
    <img src="<?=$_SESSION['info']['image']?>"    style="width:150px ;height:155px;"  ><br>
    
    <label ><b>Username :  <?=$_SESSION['info']['username']?>  </b></label><br>
    <label ><b>Email : <?=$_SESSION['info']['email']?>  </b></label><br>
    <label ><b>Password : <?=$_SESSION['info']['password']?>  </b></label><br>
    <!--<input type="hidden" name="action" value="delete">-->
    <div> <?//=$_SESSION['info']['username']?> </div>
    

    <div class="clearfix">
      <a href="profile.php"><button type="button" class="cancelbtn">Cancel</button></a>
      <button type="submit" name='action' value="delete" class="">Delete</button>
    </div>
  </div>
</form>


    <?php else:?>
<h2>User Profile</h2>
<table>
  <tr>
    <th>First Name</th> <td><img src="<?php echo $_SESSION['info']['image']?>"  style="width:150px ;height:155px;"  ></td>
  </tr>
  <tr>
  <th>User Name</th> <td><?php echo $_SESSION['info']['username'] ;?></td>
    </tr>
  <tr>
  <th>Email</th> <td><?php echo $_SESSION['info']['email'] ;?></td>
  <tr>


</table>
<a href="profile.php?action=edit"><button >EDIT</button></a>
<a href="profile.php?action=delete"><button >delete</button></a>
  
        <h5>Create a post</h5>

     <form method='post'  enctype="multipart/form-data"  >
     <label for=""><b>image</b></label>
        <input type="file"  placeholder="Enter" name="image" ></br>
      <textarea  name="post" rows="4" cols="50">
    </textarea>
    <button >post</button>
          </form>

          <?php
$id=$_SESSION['info']['id'];
$query="select * from posts where user_id= '$id'";
$result = mysqli_query($con,$query);
?>

<?php if(mysqli_num_rows($result) > 0) : ?>
    <?php while($row=mysqli_fetch_assoc($result)):?>

      <?php 
       $user_id=$row['user_id'];
       $query="select username ,image from users where id ='$user_id' limit 1";
         $result2 = mysqli_query($con,$query);
           $user_row=mysqli_fetch_assoc($result2);?> 
            
       <?php //endif;?>

<div class="container">
    <h3>Here is your posts :</h3>
    <hr>
    <div style="text-align:center;">
     <img src="<?=$user_row['image']?>" style=" border-radius:50%; width:150px ;height:155px; margin:10px; "><br>
     <div style="text-align:center;"><?="User :".$user_row['username']?></div>

     <div style="flex:8;" >
      <?php if(file_exists($row['image'])):?>
    <img src="<?=$row['image']?>"    style="width:377px ;height:266px; "  ></div>
    <?php endif;?> <label style="color:#888;"> <?=date("jS M, Y",strtotime($row['date']))?> </label><br>
    <label ><b>Posts :  <?=$row['post']?>  </b></label><br><hr>
    <div class="clearfix">
      <a href="profile.php?action=post_delete&id=<?= $row['id']?>"><button type="button" class="cancelbtn">Delete</button></a>
      <a href="profile.php?action=post_edit&id=<?= $row['id']?>"><button type="submit" name='' value="" class="">Edit</button></a>
    </div>
    </div>
   <?php endwhile;?>
  <?php endif;?></div>
     <?php endif;?>
</body>
</html>
