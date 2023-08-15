<?php require 'functions.php';

checklog();

require ('header.php');?>

   <h3 style="text-align:center;">Timeline</h3>

        <?php

$query="select * from posts order by id desc limit 10";
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
  <div style="text-align:center; border-padding:22px;">
   <img src="<?=$user_row['image']?>" style=" border-radius:50%; width:150px ;height:155px; margin:10px; "><br>
   <div style="text-align:center;"><?="User :".$user_row['username']?></div>

   <div style="flex:8;" >
    <?php if(file_exists($row['image'])):?>
  <img src="<?=$row['image']?>"    style="width:377px ;height:266px; "  ></div>
  <?php endif;?><label style="color:#888;"> <?=date("jS M, Y",strtotime($row['date']))?> </label><br>
  <label ><b>Posts :  <?=$row['post']?>  </b></label><br><hr>
    
  
 <?php endwhile;?>  </div>
<?php endif;?>
   <?php //endif;?></div>
</body>
</html>



   <?php require ('footer.php');?>